<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use DB;

class CheckLoggedInSubscriber  {

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
        $user = !empty($value) ?  DB::table('ifn_users')->where(['remember_me' => $value,'active' => '1'])->first() : '';
        $privs = !empty($user) ? DB::table('ifn_user_privileges')->where('user_id', $user->user_id )->get()->pluck('priv_id')->toArray() : [];

        if(!empty($user )){
            $user->privileges = implode(',', $privs);
        }

        switch(request()->segment(1)){
            case 'category':
                return $next($request);
            break;
            case 'tag':
                return $next($request);
            break;
            case 'location':
                return $next($request);
            break;
            case 'region':
                return $next($request);
            break;
            case 'detail':
                return $next($request);
            break;
        }

        if(!empty($value) && !empty($user))
        {
            if(empty($userdata))
            {
                session(['userData' => $user]);
            }
            return $next($request);
        }
        
        if (!empty($userdata)) {
            return $next($request);
        } else {
            return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'getFrontUserLogin']);
        }
    }

}
