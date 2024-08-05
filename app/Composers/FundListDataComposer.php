<?php

namespace App\Composers;

use App\Models\Funds;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class FundListDataComposer {

    public function compose(View $view) {

        $session_user = session()->get('userData');
        $fund_country = request('fund_country');
        $fund_region = request('fund_region');
        $type_of_fund = request('type_of_fund');
        $investor_risk = request('investor_risk');
        $fund_name = request('fund_name');
        $fund_date = request('fund_date');
        $fund_expense_ratio = request('fund_expense_ratio');
        $open_closed = request('open_closed');
        $asset_class = request('asset_class');
        $domiciled = request('domiciled');
        $requestUrl = request()->url();
        $status = (strpos($requestUrl, 'subscriber-fund-list') !== false);

        if (in_array($session_user->role, [1, 2]) || ($session_user->package_id ==2 && $status == true)) {
            $query= Funds::with('companydetail', 'userDetail','loctitle')
            ->when(!empty($fund_country) , function($q) use($fund_country){
                return $q->where('fund_country', 'like',  '%' . $fund_country . '%');
            })
            ->when(!empty($fund_region) , function($q) use($fund_region){
                return $q->where('fund_region', 'like', '%' .  $fund_region . '%');
            })
            ->when(!empty($type_of_fund) , function($q) use($type_of_fund){
                return $q->where('type_of_fund', 'like', '%' .  $type_of_fund . '%');
            })
            ->when(!empty($investor_risk) , function($q) use($investor_risk){
                return $q->where('investor_risk', 'like', '%' .  $investor_risk . '%');
            })
            ->when(!empty($fund_name) , function($q) use($fund_name){
                return $q->where('fund_name', 'like', '%' .  $fund_name . '%');
            })
            ->when(!empty($fund_date) , function($q) use($fund_date){
                return $q->where('created_at', 'like', '%' .  $fund_date . '%');
            })
            ->when(!empty($fund_expense_ratio) , function($q) use($fund_expense_ratio){
                return $q->where('fund_expense_ratio', 'like', '%' .  $fund_expense_ratio . '%');
            })
            ->when(($status == true) , function($q) {
                return $q->where('fund_status', 'like', '%' .  'confirmed' . '%');
            })
            ->when(($open_closed) , function($q) use($open_closed){
                return $q->where('open_closed', 'like', '%' . $open_closed . '%');
            })
            ->when(($asset_class) , function($q) use($asset_class){
                return $q->where('asset_class', 'like', '%' . $asset_class . '%');
            })
            ->when(($domiciled) , function($q) use($domiciled){
                return $q->where('domiciled', 'like', '%' . $domiciled . '%');
            })
            ->when(!empty(request()->get('search_title')), function($q){
                return $q->where('fund_name', 'like' , '%'. request()->get('search_title') . '%');
            });
            $ifn_funds =$query->orderBy('fund_id', 'DESC')->get();

        } else {
            $query= Funds::with('companydetail', 'userDetail','loctitle')->where('user_id', $session_user->user_id)
            ->when(!empty($fund_country) , function($q) use($fund_country){
                return $q->where('fund_country', 'like',  '%' . $fund_country . '%');
            })
            ->when(!empty($fund_region) , function($q) use($fund_region){
                return $q->where('fund_region', 'like', '%' .  $fund_region . '%');
            })
            ->when(!empty($type_of_fund) , function($q) use($type_of_fund){
                return $q->where('type_of_fund', 'like', '%' .  $type_of_fund . '%');
            })
            ->when(!empty($investor_risk) , function($q) use($investor_risk){
                return $q->where('investor_risk', 'like', '%' .  $investor_risk . '%');
            })
            ->when(($open_closed) , function($q) use($open_closed){
                return $q->where('open_closed', 'like', '%' . $open_closed . '%');
            })
            ->when(($asset_class) , function($q) use($asset_class){
                return $q->where('asset_class', 'like', '%' . $asset_class . '%');
            })
            ->when(($domiciled) , function($q) use($domiciled){
                return $q->where('domiciled', 'like', '%' . $domiciled . '%');
            })
            ->when(($status == true) , function($q) {
                return $q->where('fund_status', 'like', '%' .  'confirmed' . '%');
            })
            ->when(!empty(request()->get('search_title')), function($q){
                return $q->where('fund_name', 'like' , '%'. request()->get('search_title') . '%');
            });
            $ifn_funds =$query->orderBy('fund_id', 'DESC')->get();
        }

        $view->with('ifn_funds', $ifn_funds);
    }

}
