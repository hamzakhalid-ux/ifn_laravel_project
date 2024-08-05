<?php

namespace App\Composers;

use Illuminate\View\View;
use App\Models\Tag;
class EditTagDataComposer {

    public function compose(View $view) {

        $tag_id = request('tag_id');
        $tag = (!empty($tag_id)) ? (new Tag)->getAlltags($tag_id) : '';

        $view->with('tag', $tag);
    }

}
