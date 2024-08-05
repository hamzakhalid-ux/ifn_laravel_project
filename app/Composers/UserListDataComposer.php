<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use Illuminate\View\View;
use DB;
use Session;


class UserListDataComposer {

    public function compose(View $view) {

    // Get the logged-in user's data from the session
    $loginUserData = Session::get('userData');

    if ($loginUserData->role == 1 || $loginUserData->role == 2) {
        $users = User::with('subscribe_package')->get();

    } else {
        $users = User::with('subscribe_package')->where('user_id', $loginUserData->user_id)->get();
    }

        $view->with('users', $users)->with('loginUserData',$loginUserData);

    }

}
