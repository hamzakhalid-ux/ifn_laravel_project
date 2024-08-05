<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Models\ExtraBenefits;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountVerification;
use App\Mail\ForgotPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\InvoiceMail;
use App\Mail\SubscriberEmail;
use App\Models\CustomDeals;
use App\Models\Locations;
use App\Models\Packages;
use App\Models\User;
use Illuminate\Support\Str;
use Validator;
use DB;
use Session;
use PDF;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;

class UsersController extends ViewComposingController {

    public function getUserRegistration(Request $request) {
        return $this->buildTemplate('add_user');
    }
    public function addUser(Request $request) {

        $rules = [
            'first_name' => 'required|min:3|max:10',
            'last_name' => 'required|min:3|max:10',
            'email' => 'required|email|unique:ifn_users,email',
            'password' => 'required',
            'retype_password' => 'required|required_with:password|same:password',
            'role' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);


        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }
        $data = $request->all();
        $profile_image='';

        if (isset($data['profile_image']) && is_uploaded_file($data['profile_image'])){
            $profile_image = (new ImageHelper)->uploadSingleImage($data['profile_image'],'user_profile');
        }

        $params = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => hash('sha512', $request->get('password')),
            'role' => $request->get('role'),
            'profile_image'=> $profile_image[0]['l']['name'] ?? '',
            'active' => '1',
            'subscriber' => $data['subscriber'] ?? 0,
            'package_id' => $data['package_id'] ?? null,
        ];


        if($params['role'] == 1 || $params['role'] == 2){
            $default_p = DB::table('ifn_privileges')->get()->pluck('priv_id');
        }else{
            $default_p = DB::table('ifn_roles as r')->select('r.default_privs')->where('r.role_id', $params['role'])->first();
            $default_p = explode(',', $default_p->default_privs);
        }

        $user_privs = [];
        $insertedId = DB::table('ifn_users')->insertGetId($params);
        foreach ($default_p as $key => $priv) {
            $user_privs[$key]['priv_id'] = $priv;
            $user_privs[$key]['user_id'] = $insertedId;
        }
        DB::table('ifn_user_privileges')->insert($user_privs);

        $user_details = self::userDetails($request->all(), $insertedId);
        $result = (count($user_details)>0) ? UserDetails::updateOrInsert( ['user_id' => $insertedId],  $user_details ) : '';


        return redirect()->back()->with(['messages' => 'User Successfully Created!..']);
    }


    public function getUserLogin(Request $request) {
        $this->viewData['main_class'] = "login-container";
        $session_user = session()->get('userData');
        if(!empty($session_user))
        {
            return redirect()->action([\App\Http\Controllers\Admin\HomePageController::class, 'getHomePage']);
        }
        return $this->buildTemplate('login');
    }

    public function getFrontUserLogin(Request $request) {
        $this->viewData['main_class'] = "login-container";
        $session_user = session()->get('userData');
        if(!empty($session_user))
        {
            return redirect()->action([\App\Http\Controllers\Admin\HomePageController::class, 'getHomePage']);
        }
        return $this->buildTemplate('login_front');
    }

    public function checkUser(Request $request) {

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }

        $user = DB::table('ifn_users')->where(['email' => $request->get('email'), 'password' => hash('sha512', $request->get('password')),'active' => '1'])->where('role' ,'<>', '6')->first();
        if(empty($user)){
            $errors = ['User Not Found'];
            return redirect()->back()->with(['errors' => $errors]);
        }

        $privs = DB::table('ifn_user_privileges')->where('user_id', $user->user_id )->get()->pluck('priv_id')->toArray();
        $user->privileges = implode(',', $privs);
        // dd('d',$request->all());
        if(!empty($request->get('remember_me')))
        {
            $randomString = Str::random(25);
            // dd($randomString);
            $update = DB::table('ifn_users')->where('user_id',$user->user_id)->update(['remember_me'=> $randomString]);
            Cache::put('ifn_auth_key', $randomString);
        }
        session(['userData' => $user]);

        return redirect()->action([\App\Http\Controllers\Admin\HomePageController::class, 'getHomePage']);
    }

    public function checkUserFront(Request $request) {

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }

        $user = DB::table('ifn_users')->where(['email' => $request->get('email'), 'password' => hash('sha512', $request->get('password')),'active' => '1'])->where('role' , '6')->first();
        if(empty($user)){
            $errors = ['User Not Found'];
            return redirect()->back()->with(['errors' => $errors]);
        }

        $privs = DB::table('ifn_user_privileges')->where('user_id', $user->user_id )->get()->pluck('priv_id')->toArray();
        $user->privileges = implode(',', $privs);
        if(!empty($request->get('remember_me')))
        {
            $randomString = Str::random(25);
            $update = DB::table('ifn_users')->where('user_id',$user->user_id )->update(['remember_me'=> $randomString]);
            Cache::put('ifn_auth_key', $randomString);
        }
        session(['userData' => $user]);

        return redirect()->action([\App\Http\Controllers\Admin\HomePageController::class, 'getHomePage']);
    }

    public function getLogout() {
        Session::forget('userData');
        Cache::forget('ifn_auth_key');
        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'getFrontUserLogin']);
    }

    public function getUserList(Request $request) {
        return $this->buildTemplate('list_user');
    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                DB::table('ifn_users')->where('user_id',$data['data_id'])->delete();
                DB::table('ifn_user_privileges')->where('user_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "User Deleted Successfully"]);
            }
           else{
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "User id is required."]);
           }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
    public function editUser(Request $request)
    {
        $plan_list= DB::table('if_package_prices')->where('web_id',env('wed_id',1))->get();

        return $this->buildTemplate('edit_user')->with('plan_list',$plan_list);
    }

    public function editPrivileges(Request $request)
    {
        return $this->buildTemplate('edit_privilege');
    }
    public function updateRecord(Request $request) {
        try{
            $rules = [
                'first_name' => 'required|min:3|max:10',
                'last_name' => 'required|min:3|max:10',
                // 'email' => 'required|email|unique:ifn_users,email',
                // 'password' => 'required',
                // 'gender' => 'required',
                'role' => 'required',
                'user_id' => 'required',
            ];
            $messages = [];

            $validator = Validator::make($request->all(), $rules, $messages);

            if(!empty($validator->messages()->all())){
                $errors = $validator->messages()->all();
                return redirect()->back()->with(['errors' => $errors]);
            }

            $data = $request->all();
            $profile_image='';

            if (isset($data['profile_image']) && is_uploaded_file($data['profile_image'])){
                $profile_image = (new ImageHelper)->uploadSingleImage($data['profile_image'],'user_profile');
            }

            $params = [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                // 'email' => $request->get('email'),
                // 'password' => hash('sha512', $request->get('password')),
                // 'profile_image'=> $profile_image[0]['l']['name'] ?? '',
                'role' => $request->get('role'),
            ];
            // Add 'profile_image' key only if it's not empty
            if (!empty($profile_image[0]['l']['name'])) {
                $params['profile_image'] = $profile_image[0]['l']['name'];
            }
            if (!empty($request->get('password'))) {
                $params['password'] = hash('sha512', $request->get('password'));
            }
            $update = DB::table('ifn_users')->where('user_id',$request->get('user_id'))->update($params);
            $user_details = self::userDetails($request->all(), $request->get('user_id'));
            $result = (count($user_details)>0) ? UserDetails::updateOrInsert( ['user_id' => $request->get('user_id')],  $user_details ) : '';
            $result = DB::table('ifn_user_privileges')->where('user_id', $request->get('user_id'))->delete();
            if($params['role'] == 1 || $params['role'] == 2){
                $default_p = DB::table('ifn_privileges')->get()->pluck('priv_id');
            }else{
                $default_p = DB::table('ifn_roles as r')->select('r.default_privs')->where('r.role_id', $params['role'])->first();
                $default_p = explode(',', $default_p->default_privs);
            }
            $user_privs = [];
            foreach ($default_p as $key => $priv) {
                $user_privs[$key]['priv_id'] = $priv;
                $user_privs[$key]['user_id'] = $request->get('user_id');
            }
            DB::table('ifn_user_privileges')->insert($user_privs);


            return redirect()->back()->with(['messages' => 'User Successfully Updated!..']);
        }catch(Exception $e)
        {
            dd($e->getMessage());
            return redirect('/');
        }
    }


    public function updatePrivileges(Request $request) {

        $rules = [
            'privilege' => 'required',
            'user_id' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }
        $new_privi = [];
        foreach($request->get('privilege') as $index=>$privi)
        {
            $new_privi[$index]['user_id'] = $request->get('user_id');
            $new_privi[$index]['priv_id'] = $privi;
        }

        DB::table('ifn_user_privileges')->where('user_id',$request->get('user_id'))->delete();
        DB::table('ifn_user_privileges')->insert($new_privi);

        return redirect()->back()->with(['messages' => 'User Privileges Successfully Updated!..']);
    }

    public function signupPackage(Request $request) {
        $this->viewData['main_class'] = "sign-up-bg select-package";
        return $this->buildTemplate('signup_package');
    }

    public function packagedetails(Request $request) {

        $package_id =request('package_id');
        $plan_list= DB::table('if_package_prices')->where('web_id',env('wed_id',1))->get();

        $package_name = Packages::where('package_id' ,$package_id)->first();
        if(empty($package_id))
        {
            return redirect('/');
        }


        $this->viewData['main_class'] = "plan-page-bg";
        return $this->buildTemplate('personal_details')->with(['plan_list'=>$plan_list,'package_name'=>$package_name['package_name'],'checkbox_details'=>$checkbox_details ??'','package_id'=>$package_id]);

    }


    public function personaldetail(Request $request) {

        // dd($request->all());
        $checkbox_details =(!empty($request->get('checkboxdata'))) ?  json_encode($request->get('checkboxdata')) : '';
        $checkboxdata = $request->get('checkboxdata');
        $package_id =$checkboxdata['package_id'] ?? '';

        $plan_list= DB::table('if_package_prices')->where('web_id',env('wed_id',1))->get();

        $package_name = Packages::where('package_id' ,$package_id)->first();
        if(empty($package_id))
        {
            return redirect('/');
        }
        $this->viewData['main_class'] = "plan-page-bg";
        return $this->buildTemplate('personal_details')->with(['plan_list'=>$plan_list,'package_name'=>$package_name['package_name'],'checkbox_details'=>$checkbox_details,'package_id'=>$package_id]);
    }

    public function storepersonaldetail(Request $request)
    {
        // dd( $request->all());
        try {
            $session_user = session()->get('userData');
            $personaldetail = $request->get('personaldetail') ;
            $personaldetail = !empty($personaldetail) ? get_object_vars(json_decode($personaldetail)) : '';
            $old_users = DB::table('ifn_users')->where(['email' => $personaldetail['work_email']])->first();
            if(!empty($old_users))
            {
                return redirect()->route('home');
            }
            $randomString = Str::random(40);
            $commonParams = [
                'first_name' => $personaldetail['f_name'],
                'last_name' => $personaldetail['l_name'],
                'package_id' => $personaldetail['package_id'],
                'subscriber' => 1,
                'package_price_id' => $personaldetail['package_price_id'] ?? 0,
                'token' => $randomString,
            ];
            DB::beginTransaction();

            if (empty($session_user)) {
                $params = array_merge($commonParams, [
                    'email' => $personaldetail['work_email'],
                    'password' => hash('sha512', $personaldetail['password']),
                    'active' => 0,
                    'role' => 6,
                ]);

                $insertedId = DB::table('ifn_users')->insertGetId($params);
            } else {
                $insertedId = DB::table('ifn_users')
                    ->where('user_id', $session_user->user_id)
                    ->update($commonParams + ['active' => 1]);

                $insertedId = $session_user->user_id;
            }

            ExtraBenefits::where('user_id' , $insertedId)->delete();
            $packagedetail = DB::table('ifn_packages')->where('package_id', $personaldetail['package_id'])->first();
            $subscriberdetail= DB::table('if_package_prices')->where('id', $personaldetail['package_price_id'] ?? '')->first();
            $ifn_subscriber = [
                'status' => 0,
                'web_id' => env('web_id', 1),
                'package_id' => $personaldetail['package_id'],
                // Remove 'user_id' from the $ifn_subscriber array
            ];

            DB::table('ifn_subscriber')->updateOrInsert(
                ['user_id' => $insertedId], // The unique key to check
                $ifn_subscriber // Data to insert or update
            );

            $subscriberdetailsave = [
                'user_id' => $insertedId,
                'package_id' => $personaldetail['package_id'],
                'package_price_id' => $personaldetail['package_price_id'] ?? null,
                'package_price' => $subscriberdetail->price ?? 0,
                'subscriber_id' => DB::table('ifn_subscriber')->where('user_id', $insertedId)->value('id'),
                'creator' => 1,
                'status' => 0,
            ];
            $user_details = self::userDetails($personaldetail, $insertedId);
            $user_benefits = self::userBenefits($request->get('checkboxdata'), $insertedId);

            DB::table('ifn_subscriber_mapper')->updateOrInsert( ['user_id' => $insertedId],  $subscriberdetailsave );
            $result = (count($user_details)>0) ? UserDetails::updateOrInsert( ['user_id' => $insertedId],  $user_details ) : '';
            $result = (count($user_benefits)>0) ? ExtraBenefits::insert($user_benefits) : '';

            $verificationLink = route('account.verify', ['token' => $randomString]);

            (empty($session_user))? Mail::to($personaldetail['work_email'])->send(new AccountVerification($verificationLink)) : '';

            $this->viewData['main_class'] = "plan-page-bg";
            DB::commit();

            if($personaldetail['package_id'] == 1){
                return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'registrationCompleted'])->with('package_request', $request->all());
            }
            $commonParams['company'] = $personaldetail['company'] ?? '';
            return $this->buildTemplate('signupinvoice')
            ->with(['subscriberdetail'=>$subscriberdetail ?? '' ,
             'userdetail'=>$commonParams ?? '',
             'packagedetail'=>$packagedetail ?? '',
             'user_id' => $insertedId,
                ]);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('home');
        }
    }

    public function userDetails($data ,$user_id)
    {
        $data_dic['salutation'] = $data['salutation'] ?? '';
        $data_dic['company'] =$data['company'] ?? '';
        $data_dic['designation'] = $data['designation'] ?? '';
        $data_dic['country'] = $data['country'] ?? '';
        $data_dic['region'] = (new Locations)->getRegionByCountry($data['country'] ?? '');
        $data_dic['city'] = $data['city'] ?? '';
        $data_dic['phone_number'] = $data['phone_number'] ?? '';
        $data_dic['direct_line'] = $data['direct_line'] ?? '';
        $data_dic['code_and_sector'] = $data['code_and_sector'] ?? '';
        $data_dic['job_code'] = $data['job_code'] ?? '';
        $data_dic['user_id'] = $user_id;

        return $data_dic;
    }

    public function userBenefits($data ,$user_id)
    {
        if(!empty($data->checkbox))
        {
            $index= 0;
            foreach($data->checkbox as $key=>$value)
            {
                $data_dic[$index]['user_id'] = $user_id;
                $data_dic[$index]['deal_id'] = $key ?? null;
                $data_dic[$index]['package_id'] = $data->package_id;
                $index++;
            }
        }
        return $data_dic ?? [];
    }

    public function verifyEmail(Request $request)
    {
        $token = request('token');
        $user = DB::table('ifn_users')->where(['token' => $token , 'active' => 0])->first();
        $this->viewData['main_class'] = "test";
        if ($user) {
            // Perform the verification logic here (e.g., update the user's status)
            DB::table('ifn_users')->where('user_id',$user->user_id)->update(['active'=>1]);
            return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'registrationCompleted']);

        }

        $data['message'] = "Your Account is Token is Invalid";
        $data['header_message'] = "Invalid verification token.";
        $data['logo_message'] ="Invalid verification token";
        return $this->buildTemplate('registration_completed')->with('data',$data);
    }

    public function registrationCompleted(Request $request)
    {
        $package_details = !empty(session()->get('package_request')['personaldetail']) ? json_decode(session()->get('package_request')['personaldetail']) : '';
        //  dd($package_details->package_id);
        $this->viewData['main_class'] = "test";

        $data['message'] = (!empty($package_details->package_id) && ($package_details->package_id == 1)) ?"You're now subscribed to IFN Investor's Basic Plan.
        Upgrade to Premium Plan anytime for greater access
        to more of the world's insights on Islamic finance!" : "For verification purposes, please enter your transaction ID
        under the 'Subscription' tab.";
        $data['header_message'] = (!empty($package_details->package_id) && ($package_details->package_id == 1)) ? "BASIC PLAN REGISTRATION COMPLETE!" : "";
        $data['package'] = $package_details ;
        $data['logo_message'] = (!empty($package_details->package_id) && ($package_details->package_id == 1)) ? "Good Stuff!" : "Thank You.";
        $data['package_details'] = $package_details;
        return $this->buildTemplate('registration_completed')->with('data',$data);
    }

    public function activateAccount(Request $request)
    {

        $token = request('token');
        $user = DB::table('ifn_users')->where(['token' => $token , 'active' => 0])->first();

        //  dd($package_details->package_id);
        $this->viewData['main_class'] = "test";

        $data['message'] = "Your account is activated. Please login and explore the funds and articles";
        $data['header_message'] = "THANK YOU FOR ACTIVATION";
        $data['logo_message'] ="Thank You.";

        if ($user) {
            DB::table('ifn_users')->where('user_id',$user->user_id)->update(['active'=>1]);
            $data['message'] = "Your account is activated. Please login and explore the funds and articles";
            $data['header_message'] = "THANK YOU FOR ACTIVATION";
            $data['logo_message'] ="Thank You.";
            return $this->buildTemplate('registration_completed')->with('data',$data);

        }else{
            $data['message'] = "Your Account is already activated";
            $data['header_message'] = "Token Expired!";
            $data['logo_message'] ="Already Activated";
            return $this->buildTemplate('registration_completed')->with('data',$data);
        }

    }

    public function loginwelcome(Request $request)
    {
        $this->viewData['main_class'] = "";
        return $this->buildTemplate('loginwelcome');
    }

    public function forgotPassword(Request $request) {
        $this->viewData['main_class'] = "login-container";
        $session_user = session()->get('userData');
        // if(!empty($session_user))
        // {
        //     return redirect()->action([\App\Http\Controllers\Admin\HomePageController::class, 'getHomePage']);
        // }
        $session_user = session()->get('userData');
        if(!empty($session_user->user_id))
        {
            return $this->buildTemplate('resetpassword')->with(['user_id'=>$session_user->user_id]);
        }else{
            return $this->buildTemplate('forgotpassword');
        }

    }

    public function emailcode(Request $request) {

        $rules = [
            'email' => 'required',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);
        if(!empty($validator->messages()->all())){
            $errors = $validator->messages()->all();
            return redirect()->back()->with(['errors' => $errors]);
        }
        $user = DB::table('ifn_users')->where(['email' => $request->get('email') , 'active' => 1])->first();
        if(empty($user))
        {
            return redirect()->back()->with(['errors' => ['User Not Found']]);
        }
        $randomString = Str::random(40);
        DB::table('ifn_users')
        ->where(['email' => $request->get('email'), 'active' => 1])
        ->update([
            'token' => $randomString,
        ]);
        $verificationLink = route('reset.password', ['token' => $randomString]);
        Mail::to($user->email)->send(new AccountVerification($verificationLink));

        $this->viewData['main_class'] = "login-container";
        return $this->buildTemplate('verifyemailcode')->with(['email'=>$user->email]);
    }

    public function resetPassword(Request $request)
    {
        $token = request('token');
        $user = DB::table('ifn_users')->where(['token' => $token ])->first();
        if (empty($user)) {
            $this->viewData['main_class'] = "test";
            $data['message'] = "Your Account is Token is Invalid";
            $data['header_message'] = "Invalid verification token.";
            $data['logo_message'] ="Invalid verification token";
            return $this->buildTemplate('registration_completed')->with('data',$data);
        }
        DB::table('ifn_users')->where('token','')->update(['active'=>1]);

        $this->viewData['main_class'] = "login-container";
        return $this->buildTemplate('resetpassword')->with(['user_id'=>$user->user_id]);
    }

    public function setNewPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required',
            'password' => 'required|confirmed',
        ]);
        try {
            // $rules = [
            //     'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            //     'password_confirmation' => 'required',
            //     'password' => 'required|confirmed',
            // ];

            // $messages = [];

            // $validator = Validator::make($request->all(), $rules, $messages);
            // if(!empty($validator->messages()->all())){
            //     $errors = $validator->messages()->all();
            //     return redirect()->back()->with(['errors' => $errors]);
            // }

            $update = DB::table('ifn_users')
            ->where('user_id' , $request->get('user_id'))
            ->update([
                'password' => hash('sha512', $request->get('password')),
                'token' => '',
            ]);
            return redirect('/');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/')->with('message', 'danger=Something went Wrong'.$e->getMessage());
        }
    }

    public function signupPlanInvoice(Request $request)
    {
        $this->viewData['main_class'] = "";
        return $this->buildTemplate('signupinvoice');
    }

    public function generatePDF(Request $request)
    {
        $user_id = request('slug');
        // dd($user_id);
        try {
            $user = User::with('Package_detail','user_details')->where('user_id', $user_id)->firstOrFail();
            $ifn_subscriber_mapper = DB::table('ifn_subscriber_mapper')->where('user_id', $user_id)->first();
            $if_package_prices = DB::table('if_package_prices')->where('id', $ifn_subscriber_mapper->package_price_id)->first();
            if (empty($ifn_subscriber_mapper->package_price)) {
                return redirect()->route('home');
            }

            $data = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'price' => $ifn_subscriber_mapper->package_price,
                'package_id' => $ifn_subscriber_mapper->package_id,
                'number_of_subscriber' => $if_package_prices->number_of_subscriber,
                'package_description' => $user->Package_detail->package_description,
                'company' => $user->user_details->company ?? '',
                'user_id' => $user->user_id,
            ];
            $pdf = PDF::loadView('pdf_template.invoice', $data);

            // return $pdf->download('example.pdf');
            return $pdf->stream('example.pdf', ['Attachment' => false]);

        } catch (Exception $e) {
            dd($e->getMessage());
            // Handle the case where a model is not found (e.g., redirect to home)
            return redirect()->route('home');
        }
    }

    public function sendPDF(Request $request)
    {
        try {
            $user_id = request('slug');
            $user = User::with('Package_detail')->where('user_id', $user_id)->firstOrFail();
            if(empty($user))
            {
                return redirect()->route('home');
            }
            $ifn_subscriber_mapper = DB::table('ifn_subscriber_mapper')->where('user_id', $user_id)->first();
            $if_package_prices = DB::table('if_package_prices')->where('id', $ifn_subscriber_mapper->package_price_id)->first();
            if (empty($ifn_subscriber_mapper->package_price)) {
                return redirect()->route('home');
            }

            $data = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'price' => $ifn_subscriber_mapper->package_price,
                'package_id' => $ifn_subscriber_mapper->package_id,
                'number_of_subscriber' => $if_package_prices->number_of_subscriber,
                'package_description' => $user->Package_detail->package_description,
                'user_id' => $user_id,
            ];
            $pdf = PDF::loadView('pdf_template.invoice', $data);
            Mail::to(  $user->email)->send(new InvoiceMail($pdf));
            // return $pdf->download('example.pdf');
            $this->viewData['main_class'] = "test";
            $data['message'] = "Invoice Sent Successfuly. You're now subscribed to IFN Investor's Premium Plan. Enjoy the greatest access to unlimited resources covering the world's best insights on Islamic finance!";
            $data['header_message'] ="Email Send Successfully";
            return $this->buildTemplate('registration_completed')->with('data',$data);

        } catch (Exception $e) {
            // dd($e->getMessage());
            // Handle the case where a model is not found (e.g., redirect to home)
            return redirect()->route('home');
        }

    }

    public function storeTransaction(Request $request)
    {

        try {
            $data=$request->all();
            $user = DB::table('ifn_subscriber')->where('user_id', $data['user_id'])->update(['transaction_id'=>$data['transaction_id']]);
            return redirect()->back();


        } catch (Exception $e) {
            // Handle the case where a model is not found (e.g., redirect to home)
            return redirect()->route('home');
        }

    }

    public function storeChildUsers(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'emails.*.email' => 'required|email|unique:ifn_users,email',
                'emails.*.email' => 'distinct|email',
            ]);
            if(!empty($validator->messages()->all())){
                $errors = $validator->messages()->all();
                return redirect()->back()->with(['errors' => $errors]);
            }
            $data=$request->all();
            $user = DB::table('ifn_users')->where('user_id', $data['parent_user'])->first();
            $ifn_subscriber_mapper = DB::table('ifn_subscriber_mapper')->where('user_id', $data['parent_user'])->where('creator',1)->first();
            DB::beginTransaction();

            foreach($data['emails'] as $email)
            {
                $randomString = Str::random(40);
                $commonParams = [
                    'first_name' => null,
                    'last_name' => null,
                    'email' => $email['email'],
                    'package_id' => $user->package_id,
                    'subscriber' => 1,
                    'active' => 1,
                    'role' => 6,
                    'package_price_id' => $user->package_price_id,
                    'token' => $randomString,
                ];

                $subscriberMapperId = DB::table('ifn_users')->insertGetId($commonParams);

                $subscriberdetailsave = [
                    'user_id' => $subscriberMapperId,
                    'package_id' => $ifn_subscriber_mapper->package_id,
                    'package_price_id' => $ifn_subscriber_mapper->package_price_id ?? null,
                    'package_price' =>$ifn_subscriber_mapper->package_price,
                    'subscriber_id' => $ifn_subscriber_mapper->subscriber_id,
                    'creator' => 0,
                    'status' => 0,
                ];
                DB::table('ifn_subscriber_mapper')->insert( $subscriberdetailsave );
                $verificationLink = route('add.subscriber.detail', ['token' => $randomString]);
                Mail::to( $email['email'])->send(new SubscriberEmail($verificationLink));
            }
            DB::commit();

            return redirect()->route('home');


        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            // Handle the case where a model is not found (e.g., redirect to home)
            return redirect()->route('home');
        }

    }

    public function subscriberdetail(Request $request) {

        $token = request('token');
        $user = DB::table('ifn_users')->where(['token' => $token ])->first();

        if (empty($user)) {
            $this->viewData['main_class'] = "test";
            $data['message'] = "Your Account is Token is Invalid";
            $data['header_message'] = "Invalid verification token.";
            $data['logo_message'] ="Invalid verification token";
            return $this->buildTemplate('registration_completed')->with('data',$data);
        }
        $package_name = Packages::where('package_id' ,$user->package_id)->first();
        // dd($user);
        $this->viewData['main_class'] = "plan-page-bg";
        return $this->buildTemplate('subscriber_details')->with(['user_id'=>$user->user_id,'package_name'=>$package_name['package_name']]);
        // if(!empty($session_user))
        // {
        //     return redirect()->action([\App\Http\Controllers\Admin\HomePageController::class, 'getHomePage']);
        // }
        // return $this->buildTemplate('forgotpassword');
    }


    public function storeSubscriberdetail(Request $request) {

        try{
            $rules = [
                'personaldetail.f_name' => 'required|min:3|max:10',
                'personaldetail.l_name' => 'required|min:3|max:10',
                // 'email' => 'required|email|unique:ifn_users,email',
                'personaldetail.password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',

                'personaldetail.password' => 'required|confirmed',
                'personaldetail.password_confirmation' => 'required',
                // 'gender' => 'required',
                'personaldetail.user_id' => 'required',
            ];

            $messages = [
                'personaldetail.f_name.required' => 'First Name is required!',
                'personaldetail.f_name.min' => 'Min 3 characters are required!',
                'personaldetail.f_name.max' => 'Max 20 characters are required!',
                'personaldetail.l_name.required' => 'Last Name is required!',
                'personaldetail.l_name.min' => 'Min 3 characters are required!',
                'personaldetail.l_name.max' => 'Max 20 characters are required!',

                // 'personaldetail.salutation.required' => 'salutation is required!',
                // 'personaldetail.region.required' => 'region is required!',
                // 'personaldetail.city.required' => 'City Name is required!',
                // 'personaldetail.company.required' => 'Company Name is required!',
                // 'personaldetail.designation.required' => 'Designation is required!',
                // 'personaldetail.phone_number.required' => 'Phone Number is required!',
                // 'personaldetail.direct_line.required' => 'Direct  Line Name is required!',
                // 'personaldetail.work_email.email' => 'Need A Valid Email, Your email is not correct!',
                // 'personaldetail.work_email.unique' => 'This Email is alreay registered!',
                'personaldetail.password.required' => 'Password field is required!',
                'personaldetail.password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
                'personaldetail.password_confirmation.required' => 'Password Confimation field is also required!',
                'personaldetail.password_confirmation.same' => 'The Password confirmation field must match Password',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if(!empty($validator->messages()->all())){
                $errors = $validator->messages()->all();
                return redirect()->back()->with(['errors' => $errors])->withErrors($validator)->withInput();
            }
            $data = $request->all();
            // dd($data);

            // $profile_image='';

            // if (isset($data['profile_image']) && is_uploaded_file($data['profile_image'])){
            //     $profile_image = (new ImageHelper)->uploadSingleImage($data['profile_image'],'user_profile');
            // }

            $params = [
                'first_name' => $data['personaldetail']['f_name'] ?? '',
                'last_name' => $data['personaldetail']['f_name'] ?? '',
                'password' => hash('sha512', $data['personaldetail']['password']),
                // 'profile_image'=> $profile_image[0]['l']['name'] ?? '',
            ];
            $user_details = self::userDetails($data['personaldetail'], $data['personaldetail']['user_id']);
            $update = DB::table('ifn_users')->where('user_id',$data['personaldetail']['user_id'])->update($params);
            $result = (count($user_details)>0) ? UserDetails::updateOrInsert( ['user_id' => $data['personaldetail']['user_id']],  $user_details ) : '';
            return redirect()->route('home');
        }
        catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            // Handle the case where a model is not found (e.g., redirect to home)
            return redirect()->route('home');
        }
    }

    public function storepersonaldetailinsession(Request $request)
    {
        try {
            $session_user = session()->get('userData');
            $commonRules = [
                'personaldetail.f_name' => 'required|min:3|max:20',
                'personaldetail.l_name' => 'required|min:3|max:20',
                'personaldetail.salutation' => 'required',
                // 'personaldetail.region' => 'required',
                'personaldetail.city' => 'required',
                'personaldetail.company' => 'required',
                'personaldetail.designation' => 'required',
                'personaldetail.phone_number' => 'required',
                'personaldetail.direct_line' => 'required',
                'personaldetail.package_price_id' => 'required_if:personaldetail.package_id,2',

            ];
            $rules = empty($session_user)
                ? array_merge($commonRules, [
                    'personaldetail.work_email' => 'required|email|unique:ifn_users,email',
                    'personaldetail.password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                    'personaldetail.password_confirmation' => 'required|required_with:personaldetail.password|same:personaldetail.password',
                ])
                : $commonRules;
            // dd($rules);
            $messages = [
                'personaldetail.f_name.required' => 'First Name is required!',
                'personaldetail.f_name.min' => 'Min 3 characters are required!',
                'personaldetail.f_name.max' => 'Max 20 characters are required!',
                'personaldetail.l_name.required' => 'Last Name is required!',
                'personaldetail.l_name.min' => 'Min 3 characters are required!',
                'personaldetail.l_name.max' => 'Max 20 characters are required!',

                'personaldetail.work_email.required' => 'Email is required!',
                'personaldetail.salutation.required' => 'salutation is required!',
                // 'personaldetail.region.required' => 'region is required!',
                'personaldetail.city.required' => 'City Name is required!',
                'personaldetail.company.required' => 'Company Name is required!',
                'personaldetail.designation.required' => 'Designation is required!',
                'personaldetail.phone_number.required' => 'Phone Number is required!',
                'personaldetail.direct_line.required' => 'Direct  Line Name is required!',
                'personaldetail.work_email.email' => 'Need A Valid Email, Your email is not correct!',
                'personaldetail.work_email.unique' => 'This Email is alreay registered!',
                'personaldetail.password.required' => 'Password field is required!',
                'personaldetail.password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
                'personaldetail.password_confirmation.required' => 'Password Confimation field is also required!',
                'personaldetail.password_confirmation.same' => 'The Password confirmation field must match Password',
                'personaldetail.package_price_id' => 'The PREMIUM Plan Field is required!',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if(!empty($validator->messages()->all())){
                $errors = $validator->messages()->all();
                return redirect()->back()->with(['errors' => $errors])->withErrors($validator)->withInput();
            }
            $personaldetail = $request->get('personaldetail') ;
            $deal = CustomDeals::with('package_detail','default_deals')->where('package_id',$personaldetail['package_id'])->first();

            $this->viewData['main_class'] = "sign-up-bg";
            return $this->buildTemplate('package_details')->with('deal',$deal)->with('personaldetail',json_encode($personaldetail));

        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('home');
        }
    }

    public function subscriptionProfile()
    {

        $session_user = session()->get('userData');
        if(empty($session_user->package_id))
        {
            return redirect()->route('home');
        }
        $user_details =User::with('user_details')->where('user_id',$session_user->user_id)->first();

        $this->viewData['main_class'] = 'subscription-page p-b-60';
        return $this->buildTemplate('subscriber_profile')->with('user_details',$user_details);
    }

    public function updatePlan(Request $request)
    {
        $request->validate([
            'users_in_plan' => 'required',
            'plan_user_id' => 'required',
            'old_package_id' => 'required|regex:/^1$/',
        ]);
        try{
            $data = $request->all();
            $subscriberdetail= DB::table('if_package_prices')->where('id', $data['users_in_plan'] ?? '')->first();

            $ifn_subscriber = [
                'package_id' => 2,
                // Remove 'user_id' from the $ifn_subscriber array
            ];
            DB::table('ifn_subscriber')->updateOrInsert(
                ['user_id' => $data['plan_user_id']], // The unique key to check
                $ifn_subscriber // Data to insert or update
            );

            $subscriberdetailsave = [
                'user_id' => $data['plan_user_id'],
                'package_id' => 2,
                'package_price_id' =>$data['users_in_plan'] ?? null,
                'package_price' => $subscriberdetail->price ?? 0,
                'subscriber_id' => DB::table('ifn_subscriber')->where('user_id', $data['plan_user_id'])->value('id'),
                'creator' => 1,
                'status' => 0,
            ];
            $user_detail =[
                'package_id'=> 2,
                'package_price_id' =>$data['users_in_plan'],
            ];
            DB::table('ifn_subscriber_mapper')->updateOrInsert( ['user_id' => $data['plan_user_id']],  $subscriberdetailsave );
            DB::table('ifn_users')->updateOrInsert( ['user_id' => $data['plan_user_id']],  $user_detail );
            return redirect()->back()->with(['messages' => 'User Subscription Plan Update Successfully!..']);

        }catch(Exception $e){

            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('home');

        }
    }
}
