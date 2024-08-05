<div class="login-container">
    <div class="login-header">
        <a href="{{url('/')}}" title="IFN Dashboard">
            <img src="{{asset('./assets/images/IFN-logo.svg')}}" alt="logo">
        </a>
    </div>
    <div class="login-body">
        <h2 class="m-t-0 m-b-10">Verify Your Email </h2>
        <p>Your account password reset link has been sent to your email address  at {{$email}}. Please  click that link to continue.  </p>


            <button type="submit" class="btn btn-primary w-100">VERIFY</button>


    <p class="setup-text m-t-30 m-b-30">Didn't get our email><a href="{{url('/admin/forgot-email-code')}}"><span>Rsend</span></a> </p>
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
