<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use Illuminate\View\View;
use DB;

class AuthorListingDataComposer {

    public function compose(View $view) {

       $author_users = User::with('user_details.loctitle')->where('role', 4)->get();
        // dd($author_users->toArray());
        $view->with('author_users', $author_users);

    }

}
