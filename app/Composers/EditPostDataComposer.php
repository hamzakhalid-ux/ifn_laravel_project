<?php

namespace App\Composers;

use App\Models\Post;
use Illuminate\View\View;
use App\Models\Tag;
class EditPostDataComposer {

    public function compose(View $view) {

        $post_id = request('post_id');
        $edit_post = (!empty($post_id)) ? (new Post)->getPost($post_id) : '';
        
        $view->with('edit_post', $edit_post);
    }

}
