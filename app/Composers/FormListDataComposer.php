<?php

namespace App\Composers;

use App\Models\Page;
use Illuminate\View\View;
use DB;

class FormListDataComposer {

    public function compose(View $view) {

        $session_user = session()->get('userData');

        if (in_array($session_user->role, [1, 2])) {
            $all_forms= DB::table('ifn_contact_form')->get();
        } else {
            $all_forms= DB::table('ifn_contact_form')->where('user_id', $session_user->user_id)->get();
        }

        $view->with('all_forms', $all_forms);
    }

}
