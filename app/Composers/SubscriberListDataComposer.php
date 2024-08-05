<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use Illuminate\View\View;
use DB;
use Session;


class SubscriberListDataComposer {

    public function compose(View $view) {

        $users = User::with('Package_detail','subscribe_package_price')->whereNotNull('package_id')->get();
        $view->with('users', $users);
    }

}
