<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Company;
use Illuminate\Http\Request;
use Exception;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompaniesExport;
use App\Imports\CompaniesImport;
class CompanyController extends ViewComposingController
{
    //
    public function addCompany(Request $request)
    {
        return $this->buildTemplate('addcompany');

    }

    public function listCompanies(Request $request) {
        return $this->buildTemplate('listcompanies');
    }

    public function editCompany(Request $request)
    {
        return $this->buildTemplate('editcompany');
    }

    public function storeCompany(Request $request)
    {


        $request->validate([
            'company.company_name' => 'required',
        ]);

        $input =$request->all();
        if(isset($input['company']))
        {
            $responce = (new Company)->storeCompany($input['company']);
            return $responce;

        }
        return redirect('admin/company/add-company')->with('message', "danger=Something Went Wrong");

    }

    public function updateCompany(Request $request)
    {
        $request->validate([
            'company.company_name' => 'required',
        ]);

        $input =$request->all();
        if(isset($input['company']))
        {
            $responce = (new Company)->updateCompany($input['company'],$input['company']['company_id']);

            return $responce;
        }
        return redirect('admin/company/add-company')->with('message', "danger=Something Went Wrong");

    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                Company::where('Company_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Company Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Company id is required"]);
            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }

    public function export()
    {
        return Excel::download(new CompaniesExport, 'companies.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new CompaniesImport, $request->file('file')->store('file'));

        return redirect('admin/company/list-companies')->with('message', "success=Companies imported successfully!");

    }
}
