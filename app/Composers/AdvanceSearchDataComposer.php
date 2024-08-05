<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;
use DB;

class AdvanceSearchDataComposer {

    public function compose(View $view) {

        $all_tags = DB::table('ifn_tags as t')->get();
        $all_cats = DB::table('ifn_categories as c')->get();
        $all_sector = DB::table('ifn_posts as p')->select('p.sector')->groupBy('p.sector')->where('p.sector' , '<>' , null)->get();


        $view
        ->with('all_tags', $all_tags)
        ->with('all_cats', $all_cats)
        ->with('all_sector',$all_sector);
    }

}
