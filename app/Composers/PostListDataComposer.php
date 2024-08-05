<?php

namespace App\Composers;

use App\Models\Post;
use Illuminate\View\View;
use App\Models\Tag;
class PostListDataComposer {

    public function compose(View $view) {


        $session_user = session()->get('userData');
        $post_query = Post::where('web_id',env("Web_id", 1))
        ->when(!empty(request()->get('search_title')), function($q){
            return $q->where('post_title', 'like' , '%'. request()->get('search_title') . '%');
        });

        if (in_array($session_user->role, [1, 2])) {
            $all_posts = $post_query ->paginate(10);
        } else {
            $all_posts = $post_query->where('user_id', $session_user->user_id)->paginate(10);
        }
        // $all_posts =(!empty($all_posts) && count($all_posts) > 0) ? $all_posts->toArray() : [];
        $view->with('all_posts', $all_posts);
    }

}
