<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;
use DB;

class TimezoneListDataComposer {

    public function compose(View $view) {

        $timezone= DB::table('ifn_timezone')->get();

        $view->with('timezone', $timezone);
    }

}
