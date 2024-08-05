<?php

namespace App\Composers;

use App\Models\CustomDeals;
use App\Models\Packages;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class DealsListDataComposer {

    public function compose(View $view) {

        $session_user = session()->get('userData');

        if (in_array($session_user->role, [1, 2])) {
            $custom_deals= CustomDeals::with('default_deals','package_detail')->get();


        } else {
            $custom_deals= CustomDeals::with('default_deals','package_detail')->where('user_id', $session_user->user_id)->get();
        }
        $view->with('custom_deals', $custom_deals);
    }

}
