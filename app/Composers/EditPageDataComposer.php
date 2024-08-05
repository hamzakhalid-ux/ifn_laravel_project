<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;
use App\Models\Tag;
class EditPageDataComposer {

    public function compose(View $view) {

        $page_id = request('page_id');
        $page_data = (!empty($page_id)) ? (new Page)->getPage($page_id) : '';

        $view->with('page_data', $page_data);
    }

}
