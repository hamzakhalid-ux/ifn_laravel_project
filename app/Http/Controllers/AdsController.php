<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Ads;
use App\Models\FilterSetting;
use App\Models\Locations;
use Illuminate\Http\Request;
use Validator;
use Exception;

class AdsController extends ViewComposingController
{
    //
    public function addAds(Request $request) {
        return $this->buildTemplate('addads');
    }

    public function listAds(Request $request) {
        return $this->buildTemplate('listads');
    }

    public function editads(Request $request)
    {
        return $this->buildTemplate('editads');
    }

    public function storeads(Request $request)
    {
        $rules = [
            'ad.ad_title' => 'required',
            'ad.ad_image' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }

        $input =$request->all();
        if(isset($input['ad']))
        {

            $responce = (new Ads())->storeAds($input['ad']);
            return $responce;

        }
        return redirect('admin/ads/add-ads')->with('message', "danger=Something Went Wrong");

    }

    public function updateads(Request $request)
    {
        $rules = [
            'ad.ad_title' => 'required',
            // 'ad.ad_image' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }

        $input =$request->all();
        if(isset($input['ad']))
        {

            $responce = (new Ads)->updateAds($input['ad']);
            return $responce;

        }
        return redirect('admin/ads/add-ads')->with('message', "danger=Something Went Wrong");

    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                Ads::where('ad_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Ads Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Ads id is required"]);

            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
