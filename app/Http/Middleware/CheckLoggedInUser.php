<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use DB;

class CheckLoggedInUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $userdata = session()->get('userData');

        $value = Cache::get('ifn_auth_key');
        $user = DB::table('ifn_users')->where(['remember_me' => $value,'active' => '1'])->first();
        $privs = DB::table('ifn_user_privileges')->where('user_id', $user->user_id )->get()->pluck('priv_id')->toArray();
        $user->privileges = implode(',', $privs);

        if(!empty($value) && !empty($user))
        {
            if(empty($userdata))
            {
                session(['userData' => $user]);
            }
            return $next($request);
        }
        if (!empty($userdata) && $userdata->role != 6) {
            return $next($request);
        } elseif (!empty($userdata) && $userdata->role == 6) {
            return redirect()->action([\App\Http\Controllers\IndexPageController::class, 'indexPage']);
        } else {
            return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'getUserLogin']);
        }
    }

}
