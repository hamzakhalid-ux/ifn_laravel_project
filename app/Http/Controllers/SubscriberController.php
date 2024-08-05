<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Page;
use App\Models\Subscriber;
use App\Models\User;
use Exception;

class SubscriberController extends ViewComposingController
{
    //
    public function addSubscriber(Request $request) {
        return $this->buildTemplate('addsubscriber');
    }

    public function listSubscriber(Request $request) {
        return $this->buildTemplate('subscriberlisting');
    }

    public function changeStatus(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['id']))
            {
                User::where('user_id',$data['userid'])->update(['subscriber' => $data['status']]);
                Subscriber::where('id',$data['id'])->update(['status'=>$data['status']]);
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Subscriber Payment Status Changed Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Unable to Change Status."]);
            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong".$e->getMessage()]);

        }
    }
}
