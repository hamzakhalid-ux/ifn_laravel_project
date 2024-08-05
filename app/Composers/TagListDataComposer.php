<?php

namespace App\Composers;

use Illuminate\View\View;
use App\Models\Tag;
class TagListDataComposer {

    public function compose(View $view) {

        $alltags =(new Tag)->getAlltags();
        $view->with('alltags', $alltags);
    }

}
