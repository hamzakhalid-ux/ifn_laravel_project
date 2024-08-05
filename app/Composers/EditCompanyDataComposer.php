<?php

namespace App\Composers;

use App\Models\Company;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class EditCompanyDataComposer {

    public function compose(View $view) {


        $company_id = request('company_id');
        $company = Company::with('funds')->where('company_id',$company_id)->first();

        $view->with('company', $company);
    }

}
