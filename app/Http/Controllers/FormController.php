<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\ContactForm;
use App\Models\ContactFormFields;
use Exception;
use Validator;
use Illuminate\Http\Request;

class FormController extends ViewComposingController
{
    //
    public function addForm(Request $request)
    {
        return $this->buildTemplate('addform');

    }

    public function listForms(Request $request) {
        return $this->buildTemplate('listforms');
    }

    public function editForm(Request $request)
    {
        return $this->buildTemplate('editform');
    }
    public function storeForm(Request $request)
    {
        $request->validate([
            'form_fields' => 'required',
            'form_name' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['form_fields']))
        {

            $responce = (new ContactForm)->storeForm($input['form_fields'] ,$input['form_name']);

            return $responce;

        }
        return redirect('admin/fund/add-fund')->with('message', "danger=Something Went Wrong");

    }

    public function updateForm(Request $request)
    {
        $request->validate([
            'form_fields' => 'required',
            'form_name' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['form_fields']))
        {
            $responce = (new ContactForm)->updateForm($input['form_fields'] ,$input['form_name'],$input['form_id']);

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
                ContactForm::where('form_id',$data['data_id'])->delete();
                ContactFormFields::where('form_id',$data['data_id'])->delete();

                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Form Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Form id is required"]);
            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
