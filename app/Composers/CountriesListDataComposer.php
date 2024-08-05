<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;
use DB;

class CountriesListDataComposer {

    public function compose(View $view) {

        $all_countries = DB::table('ifn_country')->get();
        $uniqueRegions = DB::table('ifn_country')->whereNotNull('region')->distinct('region')->pluck('region');

        $view->with('all_countries', $all_countries)->with('uniqueRegions',$uniqueRegions);
    }

}
