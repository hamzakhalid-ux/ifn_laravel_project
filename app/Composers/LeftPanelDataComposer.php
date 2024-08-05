<?php

namespace App\Composers;

use Illuminate\View\View;

class LeftPanelDataComposer {

    public function compose(View $view) {

        $config_navigation = config('admin_navigation');
        $segments = implode('/', request()->segments());
        $userData = session()->get('userData');

        $view->with('config_navigations', $config_navigation)
                ->with('user_privs', explode(',',$userData->privileges))
                ->with('userData', $userData)
                ->with('segments', $segments);
    }

}
