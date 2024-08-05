<?php

namespace App\Composers;

use App\Models\Ads;
use App\Models\Domains;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\View\View;
use App\Models\Tag;
class EditSettingDataComposer {

    public function compose(View $view) {

        $setting = Setting::with([
            'topmenu1.menu_objects.categorydata',
            'topmenu2.menu_objects.categorydata',
            'footermenu1.menu_objects.categorydata',
            'footermenu2.menu_objects.categorydata',
            'footermenu3.menu_objects.categorydata',
            'topmenu1.menu_objects.tagdata',
            'topmenu2.menu_objects.tagdata',
            'footermenu1.menu_objects.tagdata',
            'footermenu2.menu_objects.tagdata',
            'footermenu3.menu_objects.tagdata',
            'topmenu1.menu_objects.locdata',
            'topmenu2.menu_objects.locdata',
            'footermenu1.menu_objects.locdata',
            'footermenu2.menu_objects.locdata',
            'footermenu3.menu_objects.locdata',
            'topmenu1.menu_objects.pagedata',
            'topmenu2.menu_objects.pagedata',
            'footermenu1.menu_objects.pagedata',
            'footermenu2.menu_objects.pagedata',
            'footermenu3.menu_objects.pagedata',
            'settingmapper' => function ($query) {
                $query->with([
                    'settingpost' => function ($query) {
                        $query->when(true, function ($query) {
                            $query->with('post_category.categorytitle');
                            $query->with('postform.form_fields');
                        });
                    },
                    'settingcategory' => function ($query) {
                        $query->when(true, function ($query) {
                            $query->with('postmapper.postdetail');
                        });
                    },
                ]);
            },
        ])->where('web_id', '1')->first();
        $adssection =Ads::where('web_id',env('Web_id',1))->where('ad_status','show')->get();
        $setting = (!empty($setting)) ? $setting->toArray() : [];
        foreach($setting['settingmapper'] as $set)
        {
            if($set['status'] == 1) {
                $setting['settingmappersession'][$set['session']][] = $set;
            }

        }
        $admapper = [];
        if(count($adssection) > 0)
        {

            foreach($adssection as $adsection)
            {
                $admapper[$adsection['ad_type']][] =$adsection;
            }
        }
        $view->with('setting', $setting)->with('admapper',$admapper);
    }

}
