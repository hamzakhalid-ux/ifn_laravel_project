<?php

namespace App\Composers;

use App\Models\ContactForm;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class EditFormDataComposer {

    public function compose(View $view) {


        $form_id = request('form_id');

        $form_data = ContactForm::with('form_fields')->where('form_id',$form_id)->first();
        $form_data = (!empty($form_data)) ? $form_data->toArray() : [];
        $view->with('form_data', $form_data);
    }

}
