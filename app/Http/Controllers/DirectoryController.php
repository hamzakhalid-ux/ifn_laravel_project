<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Mail\ContectUsEmail;
use App\Mail\NewFundEmail;
use App\Models\Company;
use App\Models\Funds;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\View;
use Validator;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Mail;



class DirectoryController extends ViewComposingController
{
    //
    public function directorylist(Request $request) {
        $this->viewData['main_class'] = 'funds-directory p-t-45 p-b-70';
        $this->viewData['title'] = 'Directory List';
        $session_user = session()->get('userData');
        $price = DB::table('if_package_prices')->where('id',$session_user->package_price_id)->first();
        $creator = DB::table('ifn_subscriber_mapper')->where('user_id',$session_user->user_id)->first();
        $ifn_subscriber = DB::table('ifn_subscriber')->where('id',$creator->subscriber_id)->first();

        if(empty($session_user->package_price_id) && $session_user->role == 6)
        {
            return $this->buildTemplate('pleaselogin');
        }
        elseif(!empty($price) && $session_user->role == 6 && $ifn_subscriber->status == 0)
        {
            // $this->viewData['main_class'] = 'subscription-page p-b-60';
            // return $this->buildTemplate('subscriptiondetail')->with('session_user',$session_user)
            //     ->with('price',$price)
            //     ->with('ifn_subscriber',$ifn_subscriber);
            return $this->buildTemplate('underreview');

        }
        return $this->buildTemplate('directorylist');
    }

    public function subscriberFundList(Request $request) {
        $this->viewData['main_class'] = 'funds-directory p-t-45 p-b-70';
        $this->viewData['title'] = 'Fund List';
        $session_user = session()->get('userData');
        $price = DB::table('if_package_prices')->where('id',$session_user->package_price_id)->first();
        $creator = DB::table('ifn_subscriber_mapper')->where('user_id',$session_user->user_id)->first();
        $ifn_subscriber = DB::table('ifn_subscriber')->where('id',$creator->subscriber_id)->first();
        if(empty($session_user->package_price_id) && $session_user->role == 6)
        {
            return $this->buildTemplate('pleaselogin');
        }
        elseif(!empty($price) && $session_user->role == 6 && $ifn_subscriber->status == 0)
        {
            return $this->buildTemplate('underreview');
        }
        return $this->buildTemplate('subscriber_fund_list');
    }

    public function subscriptionDetail()
    {

        $session_user = session()->get('userData');
        $price = DB::table('if_package_prices')->where('id',$session_user->package_price_id)->first();
        $creator = DB::table('ifn_subscriber_mapper')->where('user_id',$session_user->user_id)->first();
        $ifn_subscriber = DB::table('ifn_subscriber')->where('id',$creator->subscriber_id)->first();
        // $creator = DB::table('ifn_subscriber_mapper')->where('user_id',$session_user->user_id)->first();
        $ifn_subscriber_mapper = DB::table('ifn_subscriber_mapper')->where('subscriber_id',$ifn_subscriber->id)->where('creator',0)->get();
        $this->viewData['main_class'] = 'subscription-page p-b-60';
        return $this->buildTemplate('subscriptiondetail')->with('session_user',$session_user)
        ->with('price',$price)
        ->with('ifn_subscriber_mapper',$ifn_subscriber_mapper)
        ->with('creator',$creator)
        ->with('ifn_subscriber',$ifn_subscriber);
    }

    public function addfund(Request $request) {
        $this->viewData['main_class'] = '';
        $this->viewData['title'] = 'Add Fund';

        return $this->buildTemplate('directory_fund_add');
    }

    public function viewDirectoryDetail(Request $request) {

        $cat_id = request('company_id');
        if(empty($cat_id))
        {
            return redirect()->route('home');
        }
        $company = Company::where('company_id',$cat_id)->first();
        if(empty($company))
        {
            return redirect()->route('home');
        }
        $this->viewData['main_class'] = 'funds-directory p-t-45 p-b-70';
        $this->viewData['title'] = 'Directory';

        return $this->buildTemplate('view_directory_detail');
    }

    public function editDirectoryDetail(Request $request) {

        $cat_id = request('company_id');
        if(empty($cat_id))
        {
            return redirect()->route('home');
        }
        $company = Company::where('company_id',$cat_id)->first();
        if(empty($company) || session()->get('userData')->user_id != $company->user_id)
        {
            return redirect()->route('home');
        }
        $this->viewData['main_class'] = 'funds-directory p-t-45 p-b-70';
        $this->viewData['title'] = 'Directory';

        return $this->buildTemplate('edit_directory_detail');
    }

    public function addmorefund(Request $request)
    {
        $data = $request->all();
        try{
            if(isset($data['fundindex']))
            {

                $index = $data['fundindex'];
                $company_id = $data['company_id'];
                $all_countries = DB::table('ifn_country')->get();
                $html = View::make('components.index.ajax_fund_template')->with(['company_id' => $company_id,'index'=>$index, 'all_countries' => $all_countries])->render();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success','message' => 'Successfully', 'data' => $html ]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Category id is Required"]);

            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }


    public function updatecompany(Request $request)
    {
        // $rules = [
        //     'company.company_name' => 'required',
        //     'company.company_country' => 'required',
        //     'company.company_phone' => 'required',
        //     'company.company_timezone' => 'required',
        // ];
        // $messages = [];
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if(!empty($validator->messages()->all())){
        //     $errors = $validator->messages()->all();
        //     return redirect()->back()->with(['errors' => $errors]);
        // }

        $input =$request->all();
        if(isset($input['company']))
        {
            DB::beginTransaction();
                $data = $input['company'];
                if (isset($input['company']['company_logo']) && is_uploaded_file($input['company']['company_logo'])){
                    $data['company_logo'] = (new ImageHelper)->uploadSingleImage($input['company']['company_logo'],'media');
                }
                $data['company_city_id'] = (new company)->getCityid($input['company']['company_city'] ,$input['company']['company_country']);

                $make_dic = (new Company)->makeDictionary($data);
                $post =Company::where('company_id',$input['company']['company_id'])->update($make_dic);

                if(!empty($input['fund']))
                {
                    foreach($input['fund'] as $fund)
                    {
                        $funds[] =(new Funds)->makeDictionary($fund);
                    }
                    Funds::where('fund_company',$input['company']['company_id'])->delete();
                    Funds::insert($funds);
                }
            DB::commit();

        }
        return redirect()->route('edit.directory.detail', ['company_id' => $input['company']['company_id']]);

    }

    public function fundstore(Request $request)
    {
        $request->validate([
            'fund.fund_name' => 'required',
            'fund.fund_country' => 'required',
            'fund.fund_company' => 'required',
            // 'fund.type_of_fund' => 'required',
            // 'fund.anum_usd' => 'required',
            'fund.launched_date' => 'required',
            // 'fund.fund_currency' => 'required',
            'fund.fund_person_designation' => 'required',
            'fund.contact_person_name' => 'required',
            'fund.contact_person_email' => 'required',
            'fund.management_fee' => 'required',
            // 'fund.fund_country' => 'required',
            // 'fund.fund_last_update_date' => 'required',
        ], [
            'fund.fund_name.required' => 'The Fund Name field is required.',
            'fund.fund_country.required' => 'The Fund Country field is required.',
            'fund.fund_company.required' => 'The Fund Company field is required.',
            // 'fund.anum_usd.required' => 'The AUM USD field is required.',
            'fund.launched_date.required' => 'The Launched Date field is required.',
            // 'fund.fund_currency.required' => 'The Fund Currency field is required.',
            'fund.fund_person_designation.required' => 'The Contact Person Designation is required.',
            'fund.contact_person_name.required' => 'The Contact Person Name field is required.',
            'fund.contact_person_email.required' => 'The Contact Person Email field is required.',
            'fund.management_fee.required' => 'The Management Fee field is required.',
            // 'fund.fund_country.required' => 'The Fund Country field is required.',
            // 'fund.fund_last_update_date.required' => 'The Last Update Date field is required.',
        ]);
        try {

            $input = $request->all();

            if (isset($input['fund'])) {
                DB::beginTransaction();

                if (!empty($input['fund']['attached_file'])) {
                    $pdfFile = $input['fund']['attached_file'];
                    $pdfFileName = 'saved_pdf_' . time() . '.' . $pdfFile->extension();
                    $input['fund']['attached_file'] = $pdfFileName;
                }

                $input['fund']['fund_company'] = Company::where('company_name', 'like', '%' . $input['fund']['fund_company'] . '%')->value('company_id');
                $make_dic = (new Funds)->makeDictionary($input['fund']);

                Funds::create($make_dic);
                $status=(!empty($pdfFileName)) ? $pdfFile->storeAs('pdf_files', $pdfFileName, 'public') : '';
                DB::commit();
                Mail::to(env('FUND_TO_EMAIL','hk130563@gmail.com'))->send(new NewFundEmail($make_dic['fund_name']));
                return redirect('subscriber-fund-request-list')->with('message', 'success=Fund Created Successfully');
            }
        } catch (Exception $e) {
            // Log the exception for debugging
            dd($e->getMessage());
            // Laravel automatically redirects back with validation errors, no need for this line
            // return redirect()->back();
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);
        }

    }

    public function directoryFilterlist(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['fundindex']))
            {

                $index = $data['fundindex'];
                $company_id = $data['company_id'];
                $all_countries = DB::table('ifn_country')->get();
                $html = View::make('components.index.ajax_fund_template')->with(['company_id' => $company_id,'index'=>$index, 'all_countries' => $all_countries])->render();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success','message' => 'Successfully', 'data' => $html ]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Category id is Required"]);

            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }

    public function generatePDF(Request $request)
    {
        $fund_id = request('slug');

        if(empty($fund_id))
        {
            return redirect()->route('home');
        }
        $fund = Funds::where('fund_id' ,$fund_id)->first();
        if (!$fund) {
            return redirect()->route('home');
        }
        $fund = $fund->toArray();
        // Generate PDF using a view
        $pdf = PDF::loadView('pdf_template.template', $fund);

        // return $pdf->download('example.pdf');
        return $pdf->stream('example.pdf', ['Attachment' => false]);

    }

    public function downloadAttachedfile(Request $request)
    {
        $fund_id = request('slug');

        if(empty($fund_id))
        {
            return redirect()->route('home');
        }
        $fund = Funds::where('fund_id' ,$fund_id)->first();
        if (!$fund) {
            return redirect()->route('home');
        }
        $fund = $fund->toArray();
        $pdfFilePath = storage_path('app/public/pdf_files/' . $fund['attached_file']);

        if (file_exists($pdfFilePath)) {
            return response()->download($pdfFilePath, $fund['attached_file']);
        } else {
            // abort(404, 'PDF file not found.');
            return redirect()->back();
        }

    }
    public function subscriberFundRequestList(Request $request) {
        $this->viewData['main_class'] = 'funds-view';
        $this->viewData['title'] = 'Fund List';
        $session_user = session()->get('userData');

        return $this->buildTemplate('subscriber_fund_request_list');
    }

    public function subscriberFundDetails(Request $request) {
        $fund_id = request('fund_id');
        $session_user = session()->get('userData');
        if(empty($fund_id) || empty($session_user->package_id))
        {
            return redirect()->route('home');
        }
        $fund = Funds::with('companydetail')->where('fund_id',$fund_id)->first();
        if(empty($fund))
        {
            return redirect()->route('home');
        }
        $this->viewData['main_class'] = 'funds-view';
        $this->viewData['title'] = 'Fund Detail';
        // dd($fund->companydetail->company_name);
        return $this->buildTemplate('subscriber_fund_detail')->with('fund',$fund);
    }

    public function convertCurrency(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['local_amount']) && !empty($data['local_currency']))
            {
                $convert_usd_amount = (new PaymentController)->exchangeAmount($data['local_currency'] ,'usd',$data['local_amount']);
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success','message' => 'Successfully', 'data' => number_format($convert_usd_amount, 2) ]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Local Currency/Amount field Empty!."]);

            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }

    public function subscriberEditFundDetails(Request $request) {
        $fund_id = request('fund_id');
        $session_user = session()->get('userData');
        if(empty($fund_id) || empty($session_user->package_id))
        {
            return redirect()->route('home');
        }
        $fund = Funds::with('companydetail')->where(['fund_id'=>$fund_id ,'user_id'=> $session_user->user_id])->first();
        if(empty($fund))
        {
            return redirect()->route('home');
        }
        $this->viewData['main_class'] = 'funds-view';
        $this->viewData['title'] = 'Fund Detail';
        return $this->buildTemplate('edit_subscriber_fund_detail')->with('fund',$fund);
    }

    public function fundupdate(Request $request)
    {
        $request->validate([
            'fund.fund_name' => 'required',
            'fund.fund_country' => 'required',
            'fund.fund_company' => 'required',
            // 'fund.type_of_fund' => 'required',
            // 'fund.anum_usd' => 'required',
            'fund.launched_date' => 'required',
            // 'fund.fund_currency' => 'required',
            'fund.fund_person_designation' => 'required',
            'fund.contact_person_name' => 'required',
            'fund.contact_person_email' => 'required',
            'fund.management_fee' => 'required',
            // 'fund.fund_country' => 'required',
            // 'fund.fund_last_update_date' => 'required',
        ], [
            'fund.fund_name.required' => 'The Fund Name field is required.',
            'fund.fund_country.required' => 'The Fund Country field is required.',
            'fund.fund_company.required' => 'The Fund Company field is required.',
            // 'fund.anum_usd.required' => 'The AUM USD field is required.',
            'fund.launched_date.required' => 'The Launched Date field is required.',
            // 'fund.fund_currency.required' => 'The Fund Currency field is required.',
            'fund.fund_person_designation.required' => 'The Contact Person Designation is required.',
            'fund.contact_person_name.required' => 'The Contact Person Name field is required.',
            'fund.contact_person_email.required' => 'The Contact Person Email field is required.',
            'fund.management_fee.required' => 'The Management Fee field is required.',
            // 'fund.fund_country.required' => 'The Fund Country field is required.',
            // 'fund.fund_last_update_date.required' => 'The Last Update Date field is required.',
        ]);
        try {

            $input = $request->all();

            if (isset($input['fund'])) {
                DB::beginTransaction();

                if (!empty($input['fund']['attached_file'])) {
                    $pdfFile = $input['fund']['attached_file'];
                    $pdfFileName = 'saved_pdf_' . time() . '.' . $pdfFile->extension();
                    $input['fund']['attached_file'] = $pdfFileName;
                }

                $input['fund']['fund_company'] = Company::where('company_name', 'like', '%' . $input['fund']['fund_company'] . '%')->value('company_id');
                $make_dic = (new Funds)->makeDictionary($input['fund']);
                $status=(!empty($pdfFileName)) ? $pdfFile->storeAs('pdf_files', $pdfFileName, 'public') : '';
                Funds::where('fund_id',$input['fund']['fund_id'])->update($make_dic);

                DB::commit();

                return redirect('subscriber-fund-request-list')->with('message', 'success=Fund Created Successfully');
            }
        } catch (Exception $e) {
            // Log the exception for debugging
            dd($e->getMessage());
            // Laravel automatically redirects back with validation errors, no need for this line
            // return redirect()->back();
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);
        }

    }
}
