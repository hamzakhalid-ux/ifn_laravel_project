<?php

namespace App\Composers;

use App\Models\Packages;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class PackageListDataComposer {

    public function compose(View $view) {

        $session_user = session()->get('userData');

        if (!empty($session_user) && in_array($session_user->role, [1, 2])) {
            $all_packages= Packages::with('default_deals')->get();

        } else {
            $all_packages= Packages::with('default_deals')->get();
        }
        foreach ($all_packages as $key => $package) {
            $dropdown_roles[$package->package_id] = $package->package_name;
            if($key==0)
            {
                break;
            }
        }
        $view->with('all_packages', $all_packages)->with('dropdown_roles',$dropdown_roles);
    }

}
