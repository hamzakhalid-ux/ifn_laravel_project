<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Funds;
use Illuminate\Http\Request;
use Exception;
use App\Imports\FundsImport;
use App\Exports\FundsExport;
use Maatwebsite\Excel\Facades\Excel;
class FundController extends ViewComposingController
{
    //
    public function addFund(Request $request)
    {
        return $this->buildTemplate('addfund');

    }

    public function listFunds(Request $request) {
        return $this->buildTemplate('listfunds');
    }

    public function editFund(Request $request)
    {
        return $this->buildTemplate('editfund');
    }

    public function storeFund(Request $request)
    {
        $request->validate([
            'fund.fund_name' => 'required',
            'fund.fund_country' => 'required',
            'fund.fund_company' => 'required',
            'fund.type_of_fund' => 'required',
            // 'fund.anum_usd' => 'required',
            'fund.launched_date' => 'required',
            'fund.fund_currency' => 'required',
            'fund.fund_person_designation' => 'required',
            'fund.contact_person_name' => 'required',
            'fund.contact_person_email' => 'required',
            'fund.management_fee' => 'required',
            'fund.return_1y' => 'required',
            'fund.return_3y' => 'required',
            'fund.return_5y' => 'required',
            'fund.return_ytd' => 'required',
            'fund.fund_expense_ratio' => 'required'
        ], [
            'fund.fund_name.required' => 'The Fund name field is required.',
            'fund.fund_country.required' => 'The Fund country field is required.',
            'fund.fund_company.required' => 'The Fund company field is required.',
            'fund.type_of_fund.required' => 'The type of Fund field is required.',
            // 'fund.anum_usd.required' => 'The annual USD field is required.',
            'fund.launched_date.required' => 'The launched date field is required.',
            'fund.fund_currency.required' => 'The Fund currency field is required.',
            'fund.fund_person_designation.required' => 'The Fund person designation field is required.',
            'fund.contact_person_name.required' => 'The contact person name field is required.',
            'fund.contact_person_email.required' => 'The contact person email field is required.',
            'fund.contact_person_email.email' => 'Please provide a valid email address for the contact person email field.',
            'fund.management_fee.required' => 'The management fee field is required.',
            'fund.return_1y.required' => 'The return 1 year field is required.',
            'fund.return_3y.required' => 'The return 3 year field is required.',
            'fund.return_5y.required' => 'The return 5 year field is required.',
            'fund.return_ytd.required' => 'The return YTD field is required.',
            'fund.fund_expense_ratio.required' => 'The Local Aum field is required.',
        ]);
        $input =$request->all();

        if(isset($input['fund']))
        {
            $responce = (new Funds)->storeFund($input['fund']);

            return $responce;

        }
        return redirect('admin/fund/add-fund')->with('message', "danger=Something Went Wrong");

    }

    public function updateFund(Request $request)
    {
        $request->validate([
            'fund.fund_name' => 'required',
            'fund.fund_country' => 'required',
            'fund.fund_company' => 'required',
            'fund.type_of_fund' => 'required',
            // 'fund.anum_usd' => 'required',
            'fund.launched_date' => 'required',
            'fund.fund_currency' => 'required',
            'fund.fund_person_designation' => 'required',
            'fund.contact_person_name' => 'required',
            'fund.contact_person_email' => 'required',
            'fund.management_fee' => 'required',
            'fund.return_1y' => 'required',
            'fund.return_3y' => 'required',
            'fund.return_5y' => 'required',
            'fund.return_ytd' => 'required',
            'fund.fund_expense_ratio' => 'required'
        ], [
            'fund.fund_name.required' => 'The Fund name field is required.',
            'fund.fund_country.required' => 'The Fund country field is required.',
            'fund.fund_company.required' => 'The Fund company field is required.',
            'fund.type_of_fund.required' => 'The type of Fund field is required.',
            // 'fund.anum_usd.required' => 'The annual USD field is required.',
            'fund.launched_date.required' => 'The launched date field is required.',
            'fund.fund_currency.required' => 'The Fund currency field is required.',
            'fund.fund_person_designation.required' => 'The Fund person designation field is required.',
            'fund.contact_person_name.required' => 'The contact person name field is required.',
            'fund.contact_person_email.required' => 'The contact person email field is required.',
            'fund.contact_person_email.email' => 'Please provide a valid email address for the contact person email field.',
            'fund.management_fee.required' => 'The management fee field is required.',
            'fund.return_1y.required' => 'The return 1 year field is required.',
            'fund.return_3y.required' => 'The return 3 year field is required.',
            'fund.return_5y.required' => 'The return 5 year field is required.',
            'fund.return_ytd.required' => 'The return YTD field is required.',
            'fund.fund_expense_ratio.required' => 'The Local Aum field is required.',
        ]);
        $input =$request->all();
        if(isset($input['fund']))
        {
            $responce = (new Funds)->updateFund($input['fund'],$input['fund']['fund_id']);

            return $responce;
        }
        return redirect('admin/fund/add-fund')->with('message', "danger=Something Went Wrong");

    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                Funds::where('fund_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Fund Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Fund id is required"]);
            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }

    public function changeStatus(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['id']))
            {
                Funds::where('fund_id',$data['id'])->update(['fund_status'=>$data['status']]);
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Fund Status Changed Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Unable to Change Status."]);
            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong".$e->getMessage()]);

        }
    }

    public function export()
    {
        return Excel::download(new FundsExport, 'funds.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new FundsImport, $request->file('file')->store('file'));

        return redirect('admin/fund/list-funds')->with('message', "success=Funds imported successfully!");

    }

}
