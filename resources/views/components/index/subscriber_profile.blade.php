@php
    $fundTypes=['Digital','Endowment','ETF','Feeder','Growth','Income','Income + Growth','Index','Pension','REITs','Retirement']
@endphp
<div class="title-header m-t-40 m-b-30 p-r-0">
    <h2 class="lg">
        User Profile
    </h2>
</div>
<form class="form-inline width-100 funds-form" method="POST"  enctype="multipart/form-data" action="{{ url('/subscriber-profile/update') }}" >
    @csrf
    <div class="content-box">
        {{-- <div class="content-head m-b-40">
            <h5>First Name</h5>
            <a href="#" title="fact" class="view-file">
                <img src="{{asset('assets/images/icons/add-file-icon.svg')}}" alt="add file">fact</a>
            </a>
            <div class="upload-btn m-r-15">
                <a class="view-file"><img src="{{asset('assets/images/icons/add-file-icon.svg')}}" alt="add file">fact</a>
                <input type="file" name="company[company_logo]">
                <input type="file" accept=".pdf"  name="fund[attached_file]">

            </div>
        </div> --}}
        <input type="hidden" value="{{$user_details->role}}" name="role">
        <input type="hidden" value="{{$user_details->user_id}}" name="user_id">
        <div class="flex-row">
            <div class="col-6">
                <div class="form-group ">
                    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{$user_details->first_name ?? ''}}" >
                    <label>First Name</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group ">
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{$user_details->last_name ?? ''}}" >
                    <label>Last Name</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group ">
                    <input type="text" class="form-control" name="salutation" placeholder="Salutation" value="{{$user_details->user_details->salutation ?? ''}}" >
                    <label>Salutation</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group ">
                    <input type="text" class="form-control" name="company" placeholder="Company Name" value="{{$user_details->user_details->company ?? ''}}" >
                    <label>Company Name</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group ">
                    <input type="text" class="form-control" name="designation" placeholder="Designation" value="{{$user_details->user_details->designation ?? ''}}" >
                    <label>Designation</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group ">
                    <select class="selectpicker" id=""  name="region">
                        <option  value="">Please select Region</option>
                        @if(!empty($uniqueRegions))
                            @foreach($uniqueRegions as $region)
                                <option {{((!empty($user_details->user_details->region)) && $user_details->user_details->region == $region ) ? 'selected' : '' }} value="{{$region}}">{{$region ?? ''}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label>Region</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group ">
                    <select class="selectpicker" id=""  name="country">
                        <option  value="">Please select Country</option>
                        @if(!empty($all_countries))
                            @foreach($all_countries as $country)
                                <option {{( (!empty($user_details->user_details->country)) && $user_details->user_details->country == $country->iso) ? 'selected' : '' }} value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label>Country</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="City Name" name="city" value="{{$user_details->user_details->city ?? ''}}">
                    <label>City Name</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" value="{{$user_details->user_details->phone_number ?? ''}}">
                    <label>Phone Number</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Direct line" name="direct_line" value="{{$user_details->user_details->direct_line ?? ''}}">
                    <label>Direct line</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="file" accept="image/jpeg,image/png"  name="profile_image" value="" class="form-control"  placeholder="Select Date">
                    <label>Upload Image</label>
                </div>
            </div>
        </div>
    </div>

    <div class="paging-buttons">
        <a href="#" class="btn btn-primary sm text-transform-normal" title="Cancel">Cancel</a>
        <button type="submit"  class="btn btn-secondary sm text-transform-normal" title="Submit" >Submit</button>
    </div>
</form>
