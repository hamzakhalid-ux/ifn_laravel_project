<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;
use DB;

class CurrencyListDataComposer {

    public function compose(View $view) {

        $all_currencies= DB::table('ifn_currency')->get();

        $view->with('all_currencies', $all_currencies);
    }

}
