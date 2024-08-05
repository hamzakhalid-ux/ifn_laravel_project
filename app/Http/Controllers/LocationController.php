<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\FilterSetting;
use App\Models\Locations;
use Illuminate\Http\Request;
use Validator;
use Exception;

class LocationController extends ViewComposingController
{
    //
    public function addLocation(Request $request) {
        return $this->buildTemplate('addlocation');
    }

    public function listLocations(Request $request) {
        return $this->buildTemplate('listlocation');
    }

    public function editLocation(Request $request)
    {
        return $this->buildTemplate('editlocation');
    }

    public function storelocation(Request $request)
    {
        $rules = [
            'location.location_title' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }

        $input =$request->all();
        if(isset($input['location']))
        {

            $responce = (new Locations)->storeLocation($input['location']);
            return $responce;

        }
        return redirect('admin/location/add-location')->with('message', "danger=Something Went Wrong");

    }

    public function updatelocation(Request $request)
    {
        $rules = [
            'location.location_title' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }

        $input =$request->all();
        if(isset($input['location']))
        {

            $responce = (new Locations)->updateLocation($input['location']);
            return $responce;

        }
        return redirect('admin/location/add-location')->with('message', "danger=Something Went Wrong");

    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                Locations::where('loc_id',$data['data_id'])->update(['status'=> 0]);
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Location Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Location id is required"]);

            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
