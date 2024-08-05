<?php

namespace App\Composers;

use App\Models\ImagesSizes;
use Illuminate\View\View;

class LibraryDataComposer {

    public function compose(View $view) {

        $all_images =(new ImagesSizes)->getAllImages();
        $new_images =[];
        foreach($all_images as $image)
        {
            $new_images[$image['image_number']][] = $image;
        }
        $view->with('all_images', $new_images);
    }

}
