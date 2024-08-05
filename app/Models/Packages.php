<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class Packages extends Model
{
    use HasFactory;
    protected $table = 'ifn_packages';
    protected $fillable = [
        'package_name',
        'package_description','web_id', 'user_id'
        ];

        public function default_deals()
        {
            return $this->hasMany(DefaultDeals::class, 'package_id','package_id')->where('step','1');
        }

        public function storePackages($data)
        {
            try {
                if (!empty($data)) {
                    DB::beginTransaction();
                    $make_dic = self::makeDictionary($data);
                    $package =Packages::create($make_dic);
                    $deals_data = self::makeDicDefaultDeals($data['defult_deal'], $package->id);
                    $result = (count($deals_data)>0) ? DefaultDeals::insert($deals_data) : '';

                    DB::commit();
                    return redirect('admin/package/list-packages')->with('message', 'success=Package Save Successfully');

                }
            } catch (Exception $e) {
                DB::rollBack();
                return redirect('admin/package/list-packages')->with('message', 'danger=Something went Wrong'.$e->getMessage());
            }
        }

        public function makeDictionary($data)
        {
            $session_user = session()->get('userData');

            $data_dic['package_name'] = $data['package_title'] ?? '';
            $data_dic['package_description'] = $data['package_description'];
            $data_dic['web_id'] = env("Web_id", 1);
            $data_dic['user_id'] = $session_user->user_id;
            return $data_dic;
        }

        public function makeDicDefaultDeals($data , $package_id)
        {
            $data_dic = [];
            foreach($data as $index=>$deals)
            {
                $data_dic[$index]['deal_name'] = $deals['deal_name'];
                $data_dic[$index]['package_id'] = $package_id;
            }
            return $data_dic;
        }

        public function updatePackage($data, $package_id)
        {
            try {
                if (!empty($data)) {
                    DB::beginTransaction();
                    $make_dic = self::makeDictionary($data);
                    $post =Packages::where('package_id',$package_id)->update($make_dic);
                    DefaultDeals::where('package_id',$package_id)->where('step',1)->delete();
                    $deals_data = self::makeDicDefaultDeals($data['defult_deal'], $package_id);
                    $result = (count($deals_data)>0) ? DefaultDeals::insert($deals_data) : '';

                    DB::commit();
                    return redirect('admin/package/list-packages')->with('message', 'success=Package Updated Successfully');

                }
            } catch (Exception $e) {
                DB::rollBack();
                return  redirect('admin/package/list-packages')->with('message', 'danger='.$e->getMessage());

            }
        }
}
