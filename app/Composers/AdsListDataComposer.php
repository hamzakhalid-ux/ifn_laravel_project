<?php

namespace App\Composers;

use App\Models\Ads;
use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use Illuminate\View\View;
use DB;
use Session;


class AdsListDataComposer {

    public function compose(View $view) {

        $session_user = session()->get('userData');

        if (in_array($session_user->role, [1, 2])) {
            $all_ads= Ads::where('web_id',env("Web_id", 1))->get();


        } else {
            $all_ads= Ads::where('user_id', $session_user->user_id)->get();
        }
        $view->with('all_ads', $all_ads);
    }

}
