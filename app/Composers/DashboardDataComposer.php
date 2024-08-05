<?php

namespace App\Composers;

use App\Models\Company;
use App\Models\Domains;
use App\Models\Funds;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use DB;

class DashboardDataComposer {

    public function compose(View $view) {

        $login_user = session()->get('userData');
        if(in_array($login_user->role,[1]))
        {
            $postsCount = Post::where('web_id',1)->count();
            $pagesCount = Page::where('web_id',1)->count();
            $fundscount = Funds::where('web_id',1)->count();
            $CompanyCount = Company::where('web_id',1)->count();
            $domainCount = Domains::count();
        }
        else{
            $postsCount = Post::where('user_id',$login_user->user_id)->count();
            $pagesCount = Page::where('user_id',$login_user->user_id)->count();
            $fundscount = Funds::where('user_id',$login_user->user_id)->count();
            $CompanyCount = Company::where('user_id',$login_user->user_id)->count();


            $domainCount = 1;
        }
        $UsersCount = DB::table('ifn_users')->count();
        $subscriber= User::where('role',6)->count();

        $data = [
            'postsCount' => $postsCount,
            'pagesCount' => $pagesCount,
            'UsersCount' => $UsersCount,
            'domainCount' => $domainCount,
            'login_user' => $login_user,
            'subscriber' => $subscriber,
            'CompanyCount' => $CompanyCount,
            'fundscount' => $fundscount,
        ];

        $view->with($data);

    }

}
