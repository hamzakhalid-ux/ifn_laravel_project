<?php

namespace App\Composers;

use App\Models\Company;
use App\Models\Page;
use Illuminate\View\View;
use DB;
use GuzzleHttp\Psr7\Request;

class CompanyListDataComposer {

    public function compose(View $view,) {

        $session_user = session()->get('userData');
        $slug = request('slug');
        $company_name = request('company_name');
        $company_country = request('company_country');
        $company_region = request('company_region');
        $company_city = '';


        if (in_array($session_user->role, [1, 2]) || $session_user->package_id == 2) {
            $query= Company::with('funds','company_country')
            ->when((!empty($company_name)  || !empty($slug)) , function($q) use($company_name, $slug){
                if(!empty($company_name)){
                    return $q->where('company_name', 'like',  '%' . $company_name . '%')
                    ->where(function($qe) use ($slug){
                        return  $qe->where('company_name', 'like',   $slug . '%');
                    });
                }else{
                    return  $q->where('company_name', 'like',   $slug . '%');
                }

            })
            ->when(!empty($company_region), function ($query) use ($company_region) {
                $query->whereHas('company_country', function ($q) use ($company_region) {
                    $q->where('region', 'like', '%' . $company_region . '%');
                });
            })
            ->when(!empty($company_country) , function($q) use($company_country){
                return $q->where('company_country', 'like',  '%' . $company_country . '%');
            })
            ->when(!empty($company_city) , function($q) use($company_city){
                return $q->where('company_city', 'like', '%' .  $company_city . '%');
            })->when(!empty(request()->get('search_title')), function($q){
                return $q->where('company_name', 'like' , '%'. request()->get('search_title') . '%');
            });

           $ifn_companies = $query->get();
        } else {
            $query= Company::with('funds','company_country')->where('user_id', $session_user->user_id)
            ->when((!empty($company_name)  || !empty($slug)) , function($q) use($company_name, $slug){
                if(!empty($company_name)){
                    return $q->where('company_name', 'like',  '%' . $company_name . '%')
                    ->where(function($qe) use ($slug){
                        return  $qe->where('company_name', 'like',   $slug . '%');
                    });
                }else{
                    return  $q->where('company_name', 'like',   $slug . '%');
                }

            })->when(!empty($company_region), function ($query) use ($company_region) {
                $query->whereHas('company_country', function ($q) use ($company_region) {
                    $q->where('region', 'like', '%' . $company_region . '%');
                });
            })
            ->when(!empty($company_country) , function($q) use($company_country){
                return $q->where('company_country', 'like',  '%' . $company_country . '%');
            })
            ->when(!empty($company_city) , function($q) use($company_city){
                return $q->where('company_city', 'like', '%' .  $company_city . '%');
            })->when(!empty(request()->get('search_title')), function($q){
                return $q->where('company_name', 'like' , '%'. request()->get('search_title') . '%');
            });
           $ifn_companies = $query->get();

        }

        $view->with('ifn_companies', $ifn_companies)->with('slug', $slug);
    }

}
