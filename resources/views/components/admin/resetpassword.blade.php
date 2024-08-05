<div class="login-container">
    <div class="login-header">
        <a href="#" title="IFN Dashboard">
            <img src="{{asset('./assets/images/IFN-logo.svg')}}" alt="logo">
        </a>
    </div>
    <div class="login-body">
        <h2 class="m-t-0 m-b-10">Reset Password</h2>
        <p>Please ensure your new password is different from previously used passwords.</p>
        {!! Form::open(['url' => '/admin/set-new-password', 'class' => 'funds-form']) !!}

            <input type="hidden"name='user_id' value="{{ $user_id }}" class="form-control" id="email">

            <div class="relative form-group m-b-30">
                <input id="passwordInput1" type="password" name="password" required class="form-control">
                <label>New Password<span>*</span></label>
                @if($errors->has('password')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('password')}}</span> @endif

                <span class="icon password-icon">
                        <img class="togglePassword" index="1" onclick="togglePassword()" src="{{asset('assets/images/icons/Adornment End.png')}}" placeholder="Password" alt="password icon">
                </span>
            </div>

            <div class="relative form-group m-b-30">
                <input id="passwordInput2" type="password" name="password_confirmation" required class="form-control">
                <label>Confirm Password<span>*</span></label>
                @if($errors->has('password_confirmation')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('password_confirmation')}}</span> @endif

                <span class="icon password-icon">
                        <img class="togglePassword" index="2" onclick="togglePassword()" src="{{asset('assets/images/icons/Adornment End.png')}}" placeholder="Password" alt="password icon">
                </span>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        {!! Form::close() !!}


    <p class="setup-text m-t-30 m-b-30"><a href="{{url('/')}}"><span>< Back to HomePage</span></a></p>
    {{-- <div class="divider m-b-30">
        <p class="text-center m-0">or</p>
    </div>
    <ul class="unstyled-list login-share-icons">
        <li>
                <a href="#" title="linkedin" target="_blank">
                        <img src="{{asset('assets/images/icons/social-icons/iconmonstr-linkedin-3 1.png')}}" alt="linkedin">
                </a>
        </li>
        <li>
                <a href="#" title="google" target="_blank">
                        <img src="{{asset('assets/images/icons/social-icons/bxl-google.png')}}" alt="instagram">
                </a>
        </li>
        <li>
                <a href="#" title="facebook" target="_blank">
                        <img src="{{asset('assets/images/icons/social-icons/bxl-facebook.png')}}" alt="facebook">
                </a>
        </li>
        <li>
                <a href="#" title="twitter" target="_blank">
                        <img src="{{asset('assets/images/icons/social-icons/bxl-twitter.png')}}" alt="twitter">
                </a>
        </li>
    </ul> --}}
    </div>
</div>
<div class="login-footer"></div>
