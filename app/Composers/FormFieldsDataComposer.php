<?php

namespace App\Composers;

use App\Models\Formfields;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class FormFieldsDataComposer {

    public function compose(View $view) {

        $form_fields = Formfields::get();
        
        $view->with('form_fields', $form_fields);
    }

}
