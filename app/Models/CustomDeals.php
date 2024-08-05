<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class CustomDeals extends Model
{
    use HasFactory;

    protected $table = 'ifn_custom_deals';
    protected $fillable = [ 'package_id','user_id','web_id' ];

    public function default_deals()
    {
        return $this->hasMany(DefaultDeals::class, 'package_id','deal_id')->where('step','2');
    }


    public function package_detail()
    {
        return $this->hasone(Packages::class, 'package_id','package_id');
    }


    public function storedeals($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                $make_dic = self::makeDictionary($data);
                $package =CustomDeals::create($make_dic);
                $deals_data = self::makeDicDefaultDeals($data['custom_deals'], $package->id);
                $result = (count($deals_data)>0) ? DefaultDeals::insert($deals_data) : '';

                DB::commit();
                return redirect('admin/deal/list-deals')->with('message', 'success=Custom Deal Save Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/deal/list-deals')->with('message', 'danger=Something went Wrong'.$e->getMessage());
        }
    }

    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');

        $data_dic['package_id'] = $data['package_id'] ?? '';
        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;
        return $data_dic;
    }

    public function makeDicDefaultDeals($data , $package_id)
    {
        $data_dic = [];
        $index=0;
        foreach($data as $deal_name=>$deals)
        {
            $data_dic[$index]['deal_name'] = $deal_name;
            $data_dic[$index]['package_id'] = $package_id;
            $data_dic[$index]['deal_description'] = $deals['description'];
            $data_dic[$index]['step'] = 2;
            $index++;
        }
        return $data_dic;
    }

    public function updateDeal($data, $deal_id)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                $make_dic = self::makeDictionary($data);
                $post =CustomDeals::where('deal_id',$deal_id)->update($make_dic);
                DefaultDeals::where('package_id',$deal_id)->where('step',2)->delete();
                $deals_data = self::makeDicDefaultDeals($data['custom_deals'], $deal_id);
                $result = (count($deals_data)>0) ? DefaultDeals::insert($deals_data) : '';

                DB::commit();
                return redirect('admin/deal/list-deals')->with('message', 'success=Custom Deal Updated Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return  redirect('admin/deal/list-deals')->with('message', 'danger='.$e->getMessage());

        }
    }
}
