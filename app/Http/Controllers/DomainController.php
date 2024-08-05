<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Domains;
use Illuminate\Http\Request;
use Validator;

class DomainController extends ViewComposingController
{
    //
    public function addDomain(Request $request) {
        return $this->buildTemplate('adddomain');
    }

    public function listDomain(Request $request) {
        return $this->buildTemplate('listdomains');
    }

    public function editDomain(Request $request)
    {
        return $this->buildTemplate('editdomain');
    }

    public function storeDomain(Request $request) {

        $rules = [
            'domain' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }

        $params = [
            'domain' => $request->get('domain')
        ];

        $insert = Domains::create($params);

        return redirect()->back()->with(['messages' => 'Domain Successfully Created!..']);
    }

    public function updateDomain(Request $request) {

        $rules = [
            'domain' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }
        $params = [
            'domain' => $request->get('domain')
        ];

        $update = Domains::where('id',$request->get('id'))->update($params);

        return redirect()->back()->with(['messages' => 'Domain Successfully Updated!..']);
    }

}
