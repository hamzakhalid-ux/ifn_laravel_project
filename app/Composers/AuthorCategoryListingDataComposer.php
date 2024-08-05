<?php

namespace App\Composers;

use App\Models\Category;
use App\Models\Locations;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostLocations;
use App\Models\PostTag;
use Illuminate\View\View;
use App\Models\Tag;
use App\Models\User;

class AuthorCategoryListingDataComposer {

    public function compose(View $view) {

        $slug = request('slug');
        $filter = request('filter');
        $routeName = \Route::currentRouteName();
        $parts = explode("-", $slug);
        $user_id = request()->segment(2);
        $post_details =Post::with('post_category','post_tag','userdetail')
        ->where('post_status', 'published')
        ->where('user_id',$user_id)->get();
        $user_detail = User::where('user_id',$user_id)->first();
        $total_count = count($post_details);

        $view
        ->with('post_details', $post_details)
        ->with('user_detail', $user_detail)
        ->with('total_count',$total_count);
    }

}
