<?php

namespace App\Composers;

use App\Models\Company;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class CompanyPreFIlterDataComposer {

    public function compose(View $view) {

        $session_user = session()->get('userData');

        $all_companies = Company::
            when((!in_array($session_user->role, [1, 2])  && $session_user->package_id != 2), function ($q) use ($session_user) {
                return $q->where('user_id', $session_user->user_id);
            })->get();

        $first_char_array = [];

        foreach ($all_companies as $companyName) {
            $firstChar = strtoupper(substr($companyName['company_name'], 0, 1));

            if (!in_array($firstChar, $first_char_array)) {
                $first_char_array[] = strtoupper($firstChar);
            }
        }

        $view->with('first_char_array', $first_char_array);
    }

}
