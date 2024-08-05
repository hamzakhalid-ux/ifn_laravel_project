<div class="container">
    <header>
        <a href="#" title="logo" class="logo-holder">
            <img src="{{asset('assets/images/IFN-logo.svg')}}" alt="logo">
        </a>
    </header>
    <main>
        <h2>{{strtoupper($package_name)}} PLAN SELECTED</h2>
        {{-- @if(session()->has('messages'))
            <div class="alert alert-success">
                {{ session()->get('messages') }}
            </div>
        @endif
        @if (!empty(session()->has('errors')))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session()->get('errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <div class="container xs">
            <div class="accordion open">
                <div class="head">
                    Enter Your Individual Subscriptions
                    <span class="icon">
                        <svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.39898 13.7317L0.333984 11.6667L12.0007 5.09966e-07L23.6673 11.6667L21.6023 13.7317L12.0007 4.13L2.39898 13.7317Z" fill="white"/>
                        </svg>
                    </span>
                </div>
                <form class="form-horizontal" method="POST" action="{{ url('storesubscriberdetail') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="personaldetail[user_id]" value="{{$user_id}}">
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
                                @if(false)
                                    <div class="col-6">
                                        <div class="form-group">
                                        <input
                                            type="email"
                                            class="form-control"
                                            name="personaldetail[work_email]"

                                            placeholder="Email"
                                            value="{{old('personaldetail.salutation')}}"
                                        />
                                        <label>Email <span>*</span></label>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-6">
                                    </div>
                                @endif
                                <div class="col-4">
                                    <div class="form-group ">
                                    <select class="selectpicker" name="personaldetail[region]">
                                        @if(!empty($uniqueRegions))
                                            @foreach($uniqueRegions as $region)
                                                @if($region != '')
                                                    <option {{(old('personaldetail.region') == $region ) ? 'selected' : '' }} value="{{$region}}">{{$region ?? ''}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <label>Region <span>*</span></label>
                                    @if($errors->has('personaldetail.region')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.region')}}</span> @endif

                                    <!-- <span class="error-msg">Company doesn't exist.</span> -->
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group ">
                                    <select class="selectpicker" name="personaldetail[country]">
                                        @if(!empty($all_countries))
                                            @foreach($all_countries as $country)
                                                <option value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label>Country <span>*</span></label>
                                    @if($errors->has('personaldetail.country')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.country')}}</span> @endif

                                    <!-- <span class="error-msg">Company doesn't exist.</span> -->
                                    </div>
                                </div>
                                <div class="col-4">
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
                                        {{-- <span class="pass-msg"
                                            >6 - 15 characters (A-Z , a-z , 0-9 only)</span
                                        > --}}
                                        <span class="icon password-icon">
                                                <img  class="togglePassword" index="2" onclick="togglePassword()" src="{{asset('assets/images/icons/Adornment End.png')}}" placeholder="Password" alt="password icon">
                                        </span>
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
                                {{-- <a href="{{ route('packagedetails',['package_id'=> $package_id]) }}" class="btn btn-secondary">
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
                                </a> --}}
                                <button type="submit" class="btn btn-primary">
                                    Submit
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
