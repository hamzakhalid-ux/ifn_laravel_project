<?php

namespace App\Composers;

use Illuminate\View\View;
use App\Models\Category;
class CaregoryDataComposer {

    public function compose(View $view) {

        $cat_id = request('cat_id');
        $category = (!empty($cat_id)) ? (new Category)->getCategory($cat_id) : '';
        $allcategories =(new Category)->getAllCategory();

        $view->with('allcategories', $allcategories)->with('cat_data',$category);
    }

}
