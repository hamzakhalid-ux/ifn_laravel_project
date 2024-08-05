<?php

namespace App\Composers;

use App\Models\Packages;
use App\Models\Page;
use Illuminate\View\View;
use App\Models\Locations;

use DB;

class EditLocationDataComposer {

    public function compose(View $view) {

        $location_id = request('location_id');
        $location = Locations::where('loc_id',$location_id)->first();

        $view->with('location', $location);
    }

}
