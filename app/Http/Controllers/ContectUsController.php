<?php

namespace App\Http\Controllers;

use App\Mail\ContectUsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContectUsController extends Controller
{
    //

    public function contectUsForm(Request $request)
    {

        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['email']))
        {
            Mail::to(env('TO_EMAIL','hk130563@gmail.com'))->send(new ContectUsEmail($input));
            return redirect()->back()->with('message',"success=Email Sent Successfully");
        }
        return redirect('admin/fund/add-fund')->with('message', "danger=Something Went Wrong");

    }
}
