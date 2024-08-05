<?php

namespace App\Composers;

use App\Models\Domains;
use App\Models\FilterSetting;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\View\View;
use App\Models\Tag;
class ListFilterSettingDataComposer {

    public function compose(View $view) {

        $settings = FilterSetting::with('category_detail','tag_detail','loc_detail')->where('web_id','1')->get();

        $settings = (!empty($settings)) ? $settings->toArray() : [];
        $view->with('settings', $settings);
    }

}
