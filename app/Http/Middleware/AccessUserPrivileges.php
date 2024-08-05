<?php

namespace App\Http\Middleware;

use Closure;

class AccessUserPrivileges {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$privs) {

        $userData = session()->get('userData');
        $privilesges = explode(',',$userData->privileges);

        $priv_exists = array_intersect($privilesges, $privs);
        
        if(empty($priv_exists)){
            abort(403, 'Unauthorized');
        }
        return $next($request);

    }

}
