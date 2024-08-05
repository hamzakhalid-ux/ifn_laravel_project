<?php

namespace App\Composers;

use App\Models\Post;
use Illuminate\View\View;
use App\Models\User;
use DB;

class AuthorHomeListingDataComposer {

    public function compose(View $view) {


        $authors = DB::table('ifn_users as u')->select('u.*')->join('ifn_roles as r' , 'r.role_id', 'u.role')->where('r.title_key', 'author')->get();
        // dd('asd',$authors);

        $view
        ->with('total_count', []);
    }

}
