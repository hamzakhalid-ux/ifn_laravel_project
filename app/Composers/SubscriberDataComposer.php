<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class SubscriberDataComposer {

    public function compose(View $view) {

        $user_data =session()->get('userData');
        $ifn_subscriber = DB::table('ifn_subscriber')->where('user_id',$user_data->user_id ?? '')->first();
        // dd($ifn_subscriber->status);
        $view->with('ifn_subscriber', $ifn_subscriber);

    }

}
