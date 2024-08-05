<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Exception;

class FilterSetting extends Model
{
    use HasFactory;

    protected $table = 'ifn_filter_setting';
    protected $fillable = ['category_id','loc_id','template','yearly','category','tag','location','web_id','user_id','tag_id'];
    protected $primaryKey = 'web_id';


    public function category_detail()
    {
        return $this->hasone(Category::class, 'category_id','category_id');
    }

    public function tag_detail()
    {
        return $this->hasOne(Tag::class, 'id' , 'tag_id');
    }
    public function loc_detail()
    {
        return $this->hasOne(Locations::class, 'loc_id' , 'loc_id');
    }
    public function storeSetting($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                    $make_dic = self::makeDictionary($data);
                    if(!empty($data['filter_setting_id']))
                    {
                        $setting = FilterSetting::where('filter_setting_id' ,$data['filter_setting_id'])->update($make_dic);
                    }
                    else{
                        $setting = FilterSetting::create($make_dic);

                    }
                    DB::commit();
                return redirect('admin/setting/filter-setting')->with('message', 'success=Setting Updated Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/setting/filter-setting')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');

        $data_dic['category_id'] = $data['category_id'] ?? null;
        $data_dic['tag_id'] = $data['tag_id'] ?? null;
        $data_dic['loc_id'] = $data['loc_id'] ?? null;
        if(empty($data['filter_setting_id']))
        $data_dic['template'] = $data['template'] ?? '';
        $data_dic['yearly'] = $data['yearly'] ?? '0';
        $data_dic['category'] = $data['category'] ?? '0';
        $data_dic['tag'] = $data['tag'] ?? '0';
        $data_dic['location'] = $data['location'] ?? '0';
        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;
        return $data_dic;
    }
}
