<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class UserDataComposer {

    public function compose(View $view) {

        $roles = DB::table('ifn_roles')->get();
        
        $dropdown_roles = [];
        foreach ($roles as $key => $role) {
            if($role->role_id !=6)
            {
                $dropdown_roles[$role->role_id] = $role->title;
            }
        }

        $view->with('roles', $dropdown_roles);

    }

}
