<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;
use DB;

class LangListDataComposer {

    public function compose(View $view) {

        $user_id = request('user_id');

        $all_languages = DB::table('ifn_languages')->get();

        $view->with('all_languages', $all_languages);
    }

}
