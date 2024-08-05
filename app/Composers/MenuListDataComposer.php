<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class MenuListDataComposer {

    public function compose(View $view) {

        $all_menus =(new Menu)->getAllMenus();

        $view->with('all_menus', $all_menus);
    }

}
