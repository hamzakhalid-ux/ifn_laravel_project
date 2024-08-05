<div class="login-container">
    <div class="login-header">
        <a href="#" title="IFN Dashboard">
            <img src="{{asset('./assets/images/IFN-logo.svg')}}" alt="logo">
        </a>
    </div>
    <div class="login-body">
        <h2 class="m-t-0 m-b-10">Forgot Password? </h2>
        <p>Please enter your email so we can send you instructions to reset your password.</p>
        @php
            $errors = session()->get('errors');
            $message = !empty(session()->get('message')) ? session()->get('message') : '';
            $message_class = !empty(session()->get('errors')) ? 'label-danger' : 'label-success';
        @endphp
        <div class="{{$message_class}} text-center">{{!empty(session()->get('message')) ? session()->get('message') : ''}}</div>
        @if(!empty($errors))
        <ul class="">
            @foreach($errors as $error)
            <li class="text-danger">{{$error}}</li>
            @endforeach
        </ul>
        @endif
        {!! Form::open(['url' => '/admin/forgot-email-code', 'class' => 'funds-form']) !!}

            <div class="form-group m-b-30">
                    <input type="email" required name='email' class="form-control" id="email">
                    <label>Email<span>*</span></label>
            </div>


            <button type="submit" class="btn btn-primary w-100">Send</button>
        {!! Form::close() !!}


    <p class="setup-text m-t-30 m-b-30"><a href="{{url('/login')}}"><span> <  Back to login</span></a> </p>
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
