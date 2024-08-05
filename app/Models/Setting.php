<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'ifn_home_setting';
    protected $fillable = [
    'top_menu_1',
    'top_menu_2', 'footer_menu_1','web_id','user_id','footer_menu_2','footer_menu_3'
    ];
    protected $primaryKey = 'web_id';

    public function topmenu1()
    {
        return $this->hasMany(Menu::class, 'menu_id' , 'top_menu_1');

    }
    public function topmenu2()
    {
        return $this->hasMany(Menu::class, 'menu_id' , 'top_menu_2');
    }
    public function footermenu1()
    {
        return $this->hasMany(Menu::class, 'menu_id' , 'footer_menu_1');
    }
    public function footermenu2()
    {
        return $this->hasMany(Menu::class, 'menu_id' , 'footer_menu_2');
    }
    public function footermenu3()
    {
        return $this->hasMany(Menu::class, 'menu_id' , 'footer_menu_3');
    }
    public function settingmapper()
    {

        return $this->hasMany(SettingMapper::class, 'setting_id' , 'setting_id');
    }

    public function storeSetting($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                    $make_dic = self::makeDictionary($data);
                    $setting = Setting::updateOrCreate(['web_id' => $make_dic['web_id']], $make_dic);
                    $setting_mapper = (!empty($data)) ? self::postDictionary($data, $setting->setting_id , env('Web_id',1)) : [];
                    SettingMapper::where('setting_id',$setting->setting_id)->delete();
                    if(count($setting_mapper)>0)
                    {
                        SettingMapper::insert($setting_mapper);
                    }

                    DB::commit();
                return redirect('admin/setting/add-setting')->with('message', 'success=Setting Updated Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/setting/add-setting')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');

        $data_dic['top_menu_1'] = $data['top_menu_1'] ?? null;
        $data_dic['top_menu_2'] = $data['top_menu_2'] ?? null;
        $data_dic['footer_menu_1'] = $data['footer_menu_1'] ?? null;
        $data_dic['footer_menu_2'] = $data['footer_menu_2'] ?? null;
        $data_dic['footer_menu_3'] = $data['footer_menu_3'] ?? null;
        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;
        return $data_dic;
    }

    public function postDictionary($sessions,$setting_id,$web_id)
    {
        $session_user = session()->get('userData');
        if(!empty($sessions['session_data']))
        {
            $post_setting=[];
            $count = 0;
            foreach($sessions['session_data'] as $s_index=> $session)
            {
                foreach($session as $index=>$post)
                {
                    $post_setting[$count]['object_id'] = $post;
                    $post_setting[$count]['session'] = $s_index;
                    $post_setting[$count]['object_type'] = ($s_index =='last_session') ? 'post' : 'category';
                    $post_setting[$count]['setting_id'] = $setting_id;
                    $post_setting[$count]['web_id'] = $web_id;
                    $post_setting[$count]['user_id'] = $session_user->user_id;
                    $post_setting[$count]['status'] = (!empty($sessions[$s_index.'_status']) && $sessions[$s_index.'_status'] == 'on') ? 1 : 0;
                    $count++;
                }
            }

        }
        return (!empty($post_setting)) ? $post_setting : [];
    }
}
