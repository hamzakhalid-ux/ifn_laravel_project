<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use Illuminate\View\View;
use DB;

class EditUserDataComposer {

    public function compose(View $view) {

        $user_id = request('user_id');
        $user = User::with('user_details')->where('user_id',$user_id)->get();

        $view->with('user', $user);

    }

}
