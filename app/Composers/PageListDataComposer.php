<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;

class PageListDataComposer {

    public function compose(View $view) {

        $all_pages =(new Page)->getAllPages();
        $view->with('all_pages', $all_pages);
    }

}
