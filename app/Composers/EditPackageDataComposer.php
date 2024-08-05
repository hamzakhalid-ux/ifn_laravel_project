<?php

namespace App\Composers;

use App\Models\Packages;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class EditPackageDataComposer {

    public function compose(View $view) {

        $package_id = request('package_id');
        $package = Packages::with('default_deals')->where('package_id',$package_id)->first();

        $view->with('package', $package);
    }

}
