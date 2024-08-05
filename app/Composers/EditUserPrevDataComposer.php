<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class EditUserPrevDataComposer {

    public function compose(View $view) {

        $user_id = request('user_id');
        $user_prev = DB::table('ifn_user_privileges')->where('user_id',$user_id)->get();
        $ifn_privileges = DB::table('ifn_privileges')->get();
        $user_record = session()->get('userData');
        $ifn_privileges = !empty($ifn_privileges) ? $ifn_privileges->toArray() : [];
        $new_ifn_privileges = [];
        foreach($ifn_privileges as $privilege)
        {
            $new_ifn_privileges[$privilege->group_title][] = $privilege;
        }
        $data = [
            'user_prev' => $user_prev,
            'ifn_privileges' => $new_ifn_privileges,
            'user_id' => $user_id,
            'user_record' => $user_record
        ];

        $view->with($data);
    }

}
