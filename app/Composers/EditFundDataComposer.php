<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;
use DB;

class EditFundDataComposer {

    public function compose(View $view) {


        $fund_id = request('fund_id');
        $fund = DB::table('ifn_funds')->where('fund_id',$fund_id)->first();

        $view->with('fund', $fund);
    }

}
