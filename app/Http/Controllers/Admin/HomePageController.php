<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ViewComposingController;

class HomePageController extends ViewComposingController
{
    public function getHomePage(){
        // dd('s');
        return $this->buildTemplate('home');
    }
}