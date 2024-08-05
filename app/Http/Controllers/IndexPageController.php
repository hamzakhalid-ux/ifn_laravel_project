<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;

use Illuminate\Http\Request;

class IndexPageController extends ViewComposingController
{
    //
    public function indexPage(Request $request) {

        $this->viewData['main_class'] = 'landing-page';
        $this->viewData['title'] = 'IFN Investor - Home Page';
        return $this->buildTemplate('indexpage');
    }

}
