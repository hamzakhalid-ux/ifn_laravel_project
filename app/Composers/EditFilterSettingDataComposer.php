<?php

namespace App\Composers;

use App\Models\Domains;
use App\Models\FilterSetting;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\View\View;
use App\Models\Tag;
class EditFilterSettingDataComposer {

    public function compose(View $view) {

        $filter_setting_id = request('filter_setting_id');
        $setting = FilterSetting::where('filter_setting_id',$filter_setting_id)->first();

        $setting = (!empty($setting)) ? $setting->toArray() : [];
        $view->with('setting', $setting);
    }

}
