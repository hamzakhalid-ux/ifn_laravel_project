<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\CustomDeals;
use App\Models\DefaultDeals;
use App\Models\Packages;
use Exception;
use Illuminate\Http\Request;

class PackageController extends ViewComposingController
{
    //

    public function addPackage(Request $request) {
        return $this->buildTemplate('addpackage');
    }

    public function listPackages(Request $request) {
        return $this->buildTemplate('listpackages');
    }

    public function editPackage(Request $request)
    {
        return $this->buildTemplate('editpackage');
    }

    public function storePackage(Request $request)
    {

        $request->validate([
            'package.package_title' => 'required',
            'package.package_description' => 'required',
            'package.defult_deal' => 'required',
        ]);

        $input = $request->all();
        if(isset($input['package']))
        {
            $responce = (new Packages)->storePackages($input['package']);
            return $responce;

        }
        return redirect('admin/package/add-package')->with('message', "danger=Something Went Wrong");

    }

    public function updatePackage(Request $request)
    {

        $request->validate([
            'package.package_title' => 'required',
            'package.package_description' => 'required',
            'package.defult_deal' => 'required',
        ]);

        $input = $request->all();
        if(isset($input['package']))
        {
            $responce = (new Packages)->updatePackage($input['package'], $input['package']['package_id']);
            return $responce;

        }
        return redirect('admin/package/list-packages')->with('message', "danger=Something Went Wrong");

    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {

                Packages::where('package_id',$data['data_id'])->delete();
                DefaultDeals::where('package_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Package Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Package id is required"]);
            }
        }catch(Exception $e){
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);
        }
    }

    public function addDeal(Request $request) {
        return $this->buildTemplate('adddeals');
    }

    public function listDeals(Request $request) {
        return $this->buildTemplate('listdeals');
    }

    public function editDeal(Request $request)
    {
        return $this->buildTemplate('editdeal');
    }

    public function storeDeals(Request $request)
    {

        $request->validate([
            'deal.package_id' => 'required',
            'deal.custom_deals' => 'required',
        ]);

        $input = $request->all();
        if(isset($input['deal']))
        {
            $responce = (new CustomDeals)->storedeals($input['deal']);
            return $responce;


        }
        return redirect('admin/deal/add-deal')->with('message', "danger=Something Went Wrong");

    }

    public function updateDeal(Request $request)
    {

        $request->validate([
            'deal.package_id' => 'required',
            'deal.custom_deals' => 'required',
        ]);

        $input = $request->all();
        if(isset($input['deal']))
        {
            $responce = (new CustomDeals)->updateDeal($input['deal'],$input['deal']['deal_id']);
            return $responce;


        }
        return redirect('admin/deal/add-deal')->with('message', "danger=Something Went Wrong");

    }
}
