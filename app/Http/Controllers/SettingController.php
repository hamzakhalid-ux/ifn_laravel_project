<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\FilterSetting;
use App\Models\Setting;
use Illuminate\Http\Request;
use Exception;

class SettingController extends ViewComposingController
{
    //
    public function addSetting(Request $request) {
        return $this->buildTemplate('addsetting');
    }

    public function addFilterSetting(Request $request) {
        return $this->buildTemplate('addFilterSetting');
    }

    public function listFilterSetting(Request $request) {
        return $this->buildTemplate('listFilterSetting');
    }

    public function storeSetting(Request $request)
    {
        $input =$request->all();
        if(isset($input['setting']))
        {
            $responce = (new Setting)->storeSetting($input['setting']);

            return $responce;

        }
        return redirect('admin/setting/add-setting')->with('message', "danger=Something Went Wrong");

    }

    public function storeFilterSetting(Request $request)
    {
        $input =$request->all();

        if(empty($input['listing_filter']['filter_setting_id']))
        {
            $request->validate([
                'listing_filter.template' => 'required|unique:ifn_filter_setting,template',
            ], [
                'listing_filter.template.required' => 'The Template field is required.',
                'listing_filter.template.unique' => 'This Template has already been taken.',
            ]);
        }
        if(isset($input['listing_filter']))
        {
            $responce = (new FilterSetting)->storeSetting($input['listing_filter']);

            return $responce;
        }
        return redirect('admin/setting/add-filter')->with('message', "danger=Something Went Wrong");

    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                FilterSetting::where('filter_setting_id',$data['data_id'])->delete();

                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Filter Setting Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Filter Setting id is required"]);
            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong".$e->getMessage()]);

        }
    }
}
