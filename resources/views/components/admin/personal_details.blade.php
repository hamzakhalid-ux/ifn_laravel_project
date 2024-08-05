<div class="container">
    <header>
        <a href="{{url('/')}}" title="logo" class="logo-holder">
            <img src="{{asset('assets/images/IFN-logo.svg')}}" alt="logo">
        </a>
    </header>
    <main>
        <h2>{{strtoupper($package_name)}} PLAN SELECTED</h2>
        @if(session()->has('messages'))
            <div class="alert alert-success">
                {{ session()->get('messages') }}
            </div>
        @endif
        {{-- @if (!empty(session()->has('errors')))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session()->get('errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
            {{-- @dd($errors->has('personaldetail.f_name'),$errors->first('personaldetail.f_name')) --}}
        <div class="container xs">
            @if($package_id == 2)
                <div class="content-box">
                    <div class="custom-select">
                        <div class="head">
                            Select Plan
                        </div>
                        <label>Select Plan</label>
                        <div class="body custom-scroll">
                            <ul class="unstyled-list" >
                                @if(!empty($plan_list))
                                    @foreach($plan_list as $plan)
                                        <li class="planselected" data-value="{{$plan->id}}">{{$plan->number_of_subscriber + 1}} Subscriber  <span> {{$plan->currency}} {{$plan->price}} nett / year</span></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        @if($errors->has('personaldetail.package_price_id')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.package_price_id')}}</span> @endif
                    </div>
                </div>
                <div class="content-box p-t-25 p-b-25">
                    <p class="note">You will be able to add other members once your payment is approved</p>
                </div>
            @endif
            <div class="accordion open">
                <div class="head">
                    Enter Your Individual Subscriptions
                    <span class="icon">
                        <svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.39898 13.7317L0.333984 11.6667L12.0007 5.09966e-07L23.6673 11.6667L21.6023 13.7317L12.0007 4.13L2.39898 13.7317Z" fill="white"/>
                        </svg>
                    </span>
                </div>
                <form class="form-horizontal" method="POST" action="{{ url('storepersonaldetailinsession') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="personaldetail[package_id]" value="{{$package_id}}">

                    <input type="hidden" name="personaldetail[checkbox_details]" value="{{$checkbox_details}}">
                    <input type="hidden" id="package_price_id" name="personaldetail[package_price_id]" value=''>
                    <div class="body">
                        <div class="funds-form">
                            <div class="flex-row">
                                <div class="col-6">
                                    <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="personaldetail[f_name]"
                                        placeholder="First Name"
                                        value="{{old('personaldetail.f_name')}}"
                                    />
                                    <label>First Name <span>*</span></label>
                                   @if($errors->has('personaldetail.f_name')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.f_name')}}</span> @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="personaldetail[l_name]"
                                        placeholder="Last Name"
                                        value="{{old('personaldetail.l_name')}}"
                                    />
                                    <label>Last Name <span>*</span></label>
                                    @if($errors->has('personaldetail.l_name')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.l_name')}}</span> @endif

                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="personaldetail[salutation]"
                                        placeholder="Salutation"
                                        value="{{old('personaldetail.salutation')}}"
                                    />
                                    <label>Salutation <span>*</span></label>
                                    @if($errors->has('personaldetail.salutation')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.salutation')}}</span> @endif

                                    </div>
                                </div>
                                @if( !session()->get('userData'))
                                    <div class="col-6">
                                        <div class="form-group">
                                        <input
                                            type="email"
                                            class="form-control"
                                            name="personaldetail[work_email]"

                                            placeholder="Email"
                                            value="{{old('personaldetail.work_email')}}"
                                        />
                                        <label>Email <span>*</span></label>
                                        @if($errors->has('personaldetail.work_email')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.work_email')}}</span> @endif

                                        </div>
                                    </div>
                                @else
                                    <div class="col-6">
                                    </div>
                                @endif
                                {{-- <div class="col-4">
                                    <div class="form-group ">
                                    <select class="selectpicker" name="personaldetail[region]">
                                        @if(!empty($uniqueRegions))
                                            @foreach($uniqueRegions as $region)
                                                @if($region != '')
                                                    <option {{((!empty(old('personaldetail.region'))) && old('personaldetail.region') == $region ) ? 'selected' : '' }} value="{{$region}}">{{$region ?? ''}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <label>Region <span>*</span></label>
                                    @if($errors->has('personaldetail.region')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.region')}}</span> @endif

                                    </div>
                                </div> --}}
                                <div class="col-6">
                                    <div class="form-group ">
                                    <select class="selectpicker" name="personaldetail[country]">
                                        @if(!empty($all_countries))
                                            @foreach($all_countries as $country)
                                                <option {{((!empty(old('personaldetail.country'))) && old('personaldetail.country') == $country->iso ) ? 'selected' : '' }} value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label>Country <span>*</span></label>
                                    @if($errors->has('personaldetail.country')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.country')}}</span> @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="City Name"
                                        name="personaldetail[city]"
                                        value="{{old('personaldetail.city')}}"
                                    />
                                    <label>City <span>*</span></label>
                                    @if($errors->has('personaldetail.city')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.city')}}</span> @endif

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Company Name"
                                        value="{{old('personaldetail.company')}}"
                                        name="personaldetail[company]"
                                    />
                                    <label>Company Name<span>*</span></label>
                                    @if($errors->has('personaldetail.company')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.company')}}</span> @endif

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Designation"
                                        name="personaldetail[designation]"
                                        value="{{old('personaldetail.designation')}}"
                                    />
                                    <label>Designation <span>*</span></label>
                                    @if($errors->has('personaldetail.designation')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.designation')}}</span> @endif

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Phone Number"
                                        name="personaldetail[phone_number]"
                                        value="{{old('personaldetail.phone_number')}}"
                                    />
                                    <label>Phone Number<span>*</span></label>
                                    @if($errors->has('personaldetail.phone_number')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.phone_number')}}</span> @endif

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Direct Line"
                                        name="personaldetail[direct_line]"
                                        value="{{old('personaldetail.direct_line')}}"
                                    />
                                    <label>Direct Line <span>*</span></label>
                                    @if($errors->has('personaldetail.direct_line')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.direct_line')}}</span> @endif

                                    </div>
                                </div>
                                @if( !session()->get('userData'))
                                    <div class="col-6">
                                        <div class="form-group">
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Password"
                                            value="{{old('personaldetail.password')}}"
                                            name="personaldetail[password]"
                                            id="passwordInput2"
                                        />
                                        <label>Password <span>*</span></label>
                                        <span class="icon password-icon">
                                                <img  class="togglePassword" index="2" onclick="togglePassword()" src="{{asset('assets/images/icons/Adornment End.png')}}" placeholder="Password" alt="password icon">
                                        </span>
                                        {{-- <span class="pass-msg">6 - 15 characters (A-Z , a-z , 0-9 only)</span> --}}
                                        @if($errors->has('personaldetail.password')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.password')}}</span> @endif

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Confirm Password"
                                            value="{{old('personaldetail.password_confirmation')}}"
                                            name="personaldetail[password_confirmation]"
                                            id="passwordInput1"
                                        />
                                        <label>confirm password <span>*</span></label>
                                        <span class="icon password-icon">
                                            <img  class="togglePassword" index="1" onclick="togglePassword()" src="{{asset('assets/images/icons/Adornment End.png')}}" placeholder="Password" alt="password icon">
                                        </span>
                                        @if($errors->has('personaldetail.password_confirmation')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.password_confirmation')}}</span> @endif

                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="plan-page-btns m-t-60 m-b-60">
                                <a href="{{ route('signup') }}" class="btn btn-secondary">
                                    <svg
                                    class="m-r-10"
                                    width="12"
                                    height="13"
                                    viewBox="0 0 12 13"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    >
                                    <path
                                        d="M7.58879 10.9109L4.01129 7.33339H11.9996V5.66672H4.01129L7.58879 2.08922L6.41046 0.910889L0.821289 6.50006L6.41046 12.0892L7.58879 10.9109Z"
                                        fill="#800000"
                                    />
                                    </svg>
                                    Previous
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Next
                                    <svg
                                    class="m-l-10"
                                    width="12"
                                    height="13"
                                    viewBox="0 0 12 13"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    >
                                    <path
                                        d="M4.41083 10.9109L5.58917 12.0892L11.1783 6.50006L5.58917 0.910889L4.41083 2.08922L7.98833 5.66672H0V7.33339H7.98833L4.41083 10.9109Z"
                                        fill="white"
                                    />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
