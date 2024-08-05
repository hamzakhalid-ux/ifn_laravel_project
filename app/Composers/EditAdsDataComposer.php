<?php

namespace App\Composers;

use App\Models\Ads;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class EditAdsDataComposer {

    public function compose(View $view) {


        $ad_id = request('ads_id');
        $ads = Ads::where('ad_id',$ad_id)->first();
        
        $view->with('ads', $ads);
    }

}
