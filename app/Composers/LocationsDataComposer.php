<?php

namespace App\Composers;

use App\Models\Locations;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class LocationsDataComposer {

    public function compose(View $view) {

        $locations = Locations::where(['level'=> 1,'status'=>1])->get();
        
        $view->with('locations', $locations);
    }

}
