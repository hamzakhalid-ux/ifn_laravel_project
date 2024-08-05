<?php

namespace App\Composers;

use App\Models\CustomDeals;
use App\Models\Packages;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class EditDealDataComposer {

    public function compose(View $view) {

        $deal_id = request('deal_id');
        $package_id = request('package_id');
        if(!empty($deal_id))
        {
            $deal = CustomDeals::with('package_detail','default_deals')->where('deal_id',$deal_id)->first();
        }else if(!empty($package_id)){
            $deal = CustomDeals::with('package_detail','default_deals')->where('package_id',$package_id)->first();
        }

        $view->with('deal', $deal);
    }

}
