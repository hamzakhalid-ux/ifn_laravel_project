@php
    $fundTypes=['Digital','Endowment','ETF','Feeder','Growth','Income','Income + Growth','Index','Pension','REITs','Retirement']
@endphp
<div class="title-header m-t-40 m-b-30 p-r-0">
    <h2 class="lg">
        Update Your Fund
    </h2>
</div>
<form class="form-inline width-100 funds-form" method="POST"  enctype="multipart/form-data" action="{{ url('fund/update') }}" >
    @csrf
    <input type="hidden" name="fund[fund_id]" value="{{$fund->fund_id}}">
    <div class="content-box">
        <div class="content-head m-b-40">
            <h5>Funds</h5>
            {{-- <a href="#" title="fact" class="view-file">
                <img src="{{asset('assets/images/icons/add-file-icon.svg')}}" alt="add file">fact</a>
            </a> --}}
            @if(!empty($fund->attached_file))
                <a href="{{ url('fund/download_pdf/'.$fund->fund_id) }}" title="FACT SHEET" class="btn btn-primary" target="_blank">FACT SHEET</a>
            @endif
            <div class="upload-btn m-r-15">
                <a class="view-file"><img src="{{asset('assets/images/icons/add-file-icon.svg')}}" alt="add file">fact</a>
                {{-- <input type="file" name="company[company_logo]"> --}}
                <input type="file" accept=".pdf"  name="fund[attached_file]">

            </div>
        </div>
        <div class="flex-row">
            <div class="col-6">
                <div class="form-group ">
                    <input type="text" class="form-control" name="fund[fund_name]" placeholder="Fund Name" value="{{ !empty($fund->fund_name) ? $fund->fund_name : old('fund.fund_name')}}" >
                    {{-- <input type="text" class="form-control" value="Management"> --}}
                    <label>Fund Name</label>
                    @if($errors->has('fund.fund_name')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.fund_name')}}</span> @endif

                </div>
            </div>
            <div class="col-6">
                <div class="form-group ">
                    @if(session()->get('userData')->package_id == 2)
                    {{-- error-field--}}
                        <select class="selectpicker fund_company_hide" id=""  name="fund[fund_company]">
                            <option  value="">Please select Company</option>
                            @if(!empty($ifn_companies))
                                @foreach($ifn_companies as $company)
                                    <option @if(!empty(!empty($fund->fund_company)) && $fund->fund_company == $company->company_id) selected @endif value="{{$company->company_name}}">{{$company->company_name ?? ''}}</option>
                                @endforeach
                            @endif
                        </select>
                    @else
                        <input type="text" class="form-control fund_company_hide" name="fund[fund_company]" placeholder="Fund Management Company" value="{{old('fund.fund_company')}}" required>
                    @endif

                    <label>Fund Management Company</label>
                    @if($errors->has('fund.fund_company')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.fund_company')}}</span> @endif

                    {{-- <span class="error-msg">Company doesn't exist.</span> --}}
                </div>
            </div>
            <div class="col-6 suggest_company">
                <div class="form-group ">
                    <input type="text" class="form-control" name="fund[suggest_company]" id="suggest_company" placeholder="Company Name" value="{{!empty($fund->suggest_company) ? $fund->suggest_company : old('fund.suggest_company')}}">
                    {{-- <input type="text" class="form-control" value="Management"> --}}
                    <label>Company Name</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">

                    <select class="selectpicker"  name="fund[fund_country]">
                        <option  value="">Please select Country</option>
                        @if(!empty($all_countries))
                            @foreach($all_countries as $country)
                                <option @if(!empty($fund->fund_country) && $fund->fund_country == $country->iso) selected @endif value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label>Country</label>
                    @if($errors->has('fund.fund_country')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.fund_country')}}</span> @endif

                </div>
            </div>
            {{-- <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="fund[fund_city]" value="{{$fund->fund_city ?? ''}}" placeholder="Fund City" required>
                    <label>City</label>
                </div>
            </div> --}}

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="fund[contact_person_name]" value="{{!empty($fund->contact_person_name) ? $fund->contact_person_name : old('fund.contact_person_name')}}" placeholder="Contact Person Name" >
                    <label>Contact Person Name</label>
                    @if($errors->has('fund.contact_person_name')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.contact_person_name')}}</span> @endif

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="fund[contact_person_email]" value="{{!empty($fund->contact_person_email) ? $fund->contact_person_email : old('fund.contact_person_email')}}" placeholder="abcexample45@gmail.com" >
                    <label>Contact Person Email</label>
                    @if($errors->has('fund.contact_person_email')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.contact_person_email')}}</span> @endif

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control"  name="fund[contact_person_phone]" value="{{!empty($fund->contact_person_phone) ? $fund->contact_person_phone : old('fund.contact_person_phone')}}" placeholder="+1 (837) 546-7238" >
                    <label>Contact Person Phone</label>
                    @if($errors->has('fund.contact_person_phone')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.contact_person_phone')}}</span> @endif

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text"  class="form-control" name="fund[contact_person_landline]" value="{{!empty($fund->contact_person_landline) ? $fund->contact_person_landline : old('fund.contact_person_landline')}}" placeholder="Contact Person Landline" >
                    <label>Contact Person Landline</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                        <select class="selectpicker" name="fund[investor_risk]" id="">
                            <option  @if(!empty($fund->investor_risk) && $fund->investor_risk == 'very-high') selected @endif value="very-high">Very High</option>
                            <option  @if(!empty($fund->investor_risk) && $fund->investor_risk == 'high') selected @endif value="high">High</option>
                            <option  @if(!empty($fund->investor_risk) && $fund->investor_risk == 'moderate') selected @endif value="moderate">Moderate</option>
                            <option  @if(!empty($fund->investor_risk) && $fund->investor_risk == 'low') selected @endif  value="low">Low</option>
                            <option  @if(!empty($fund->investor_risk) && $fund->investor_risk == 'very-low') selected @endif  value="very-low">Very Low</option>
                        </select>
                    <label>Investor Risk Profile</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="number"  class="form-control" name="fund[fund_expense_ratio]" value="{{!empty($fund->fund_expense_ratio) ? $fund->fund_expense_ratio : old('fund.fund_expense_ratio')}}" placeholder="$7,767" >
                    <label>Total Expense Ration (AUM)</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group datepicker">
                    <input type="date"  class="form-control"  name="fund[fund_last_update_date]" value="{{!empty($fund->fund_last_update_date) ? $fund->fund_last_update_date :  old('fund.fund_last_update_date')}}">
                    <label>Date Of Last Update</label>
                    <span class="icon">
                        <img src="{{asset('assets/images/icons/calendar-icon.svg')}}" alt="calendar">
                    </span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group datepicker">
                    <input type="date" class="form-control" name="fund[launched_date]" value="{{!empty($fund->launched_date) ? $fund->launched_date :  old('fund.launched_date')}}">
                    <label>Launch Date</label>
                    <span class="icon">
                        <img src="{{asset('assets/images/icons/calendar-icon.svg')}}" alt="calendar">
                    </span>
                    @if($errors->has('fund.launched_date')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.launched_date')}}</span> @endif

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="fund[fund_person_designation]" value="{{!empty($fund->fund_person_designation) ? $fund->fund_person_designation : old('fund.fund_person_designation')}}" placeholder="Fund Person Designation" >
                    <label>Fund Person Designation</label>
                    @if($errors->has('fund.fund_person_designation')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.fund_person_designation')}}</span> @endif

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="number" class="form-control" step="any" min="0" max="100" placeholder="Management Fee" name="fund[management_fee]" value="{{!empty($fund->management_fee) ? $fund->management_fee : old('fund.management_fee')}}">
                    <label>Management Fee</label>
                    @if($errors->has('fund.management_fee')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('fund.management_fee')}}</span> @endif

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="number" class="form-control" step="any" min="0" max="100" placeholder="Entry Fee" name="fund[entry_fee]" value="{{!empty($fund->entry_fee) ? $fund->entry_fee : old('fund.entry_fee')}}">
                    <label>Entry Fee</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="number" class="form-control" step="any" min="0" max="100" placeholder="Exit Fee" name="fund[exit_fee]" value="{{!empty($fund->exit_fee) ? $fund->exit_fee : old('fund.exit_fee')}}">
                    <label>Exit Fee</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Shariah Advisor" name="fund[shariah_advisors]" value="{{ !empty($fund->shariah_advisors) ? $fund->shariah_advisors : old('fund.shariah_advisors')}}">
                    <label>Shariah Advisor</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Trustees" name="fund[trustees]" value="{{ !empty($fund->trustees) ? $fund->trustees : old('fund.trustees')}}">
                    <label>Trustees</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select class="selectpicker"  id=""  name="fund[open_closed]">
                        <option  value="">Select</option>
                        <option @if(!empty($fund->open_closed) && $fund->open_closed == 'open') selected @endif  value="open">Open</option>
                        <option @if(!empty($fund->open_closed) && $fund->open_closed == 'closed') selected @endif value="closed">Closed</option>
                    </select>
                    <label>Open/Closed</label>
                </div>
            </div>
            {{-- <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Fund Website" name="fund[fund_website]" value="{{$fund->fund_website ?? ''}}">
                    <label>Fund Website</label>
                </div>
            </div> --}}
            {{-- <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Asset Class" name="fund[asset_class]" value="{{$fund->asset_class ?? ''}}">
                    <label>Asset Class</label>
                </div>
            </div> --}}

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Return 1y (Annualised) %" name="fund[return_1y]" value="{{!empty($fund->return_1y) ? $fund->return_1y : old('fund.return_1y')}}">
                    <label>Return 1y (Annualised)</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Returns 3Y (Annualised) %" name="fund[return_3y]" value="{{!empty($fund->return_3y) ? $fund->return_3y : old('fund.return_3y')}}">
                    <label>Returns 3Y (Annualised)</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Returns 5Y (Annualised) %" name="fund[return_5y]" value="{{ !empty($fund->return_5y) ? $fund->return_5y  : old('fund.return_5y')}}">
                    <label>Returns 5Y (Annualised)</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Return YTD (Annualised) %" name="fund[return_ytd]" value="{{ !empty($fund->return_ytd) ? $fund->return_ytd  : old('fund.return_ytd')}}">
                    <label>Return YTD (Annualised)</label>
                </div>
            </div>

            {{-- <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Return ytd" name="fund[return_ytd]" value="{{$fund->return_ytd ?? ''}}">
                    <input type="file" accept=".pdf"  name="fund[attached_file]" value="" class="form-control"  placeholder="Select Date">
                    <label>Attach Fact Sheet</label>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="paging-buttons">
        <a href="#" class="btn btn-primary sm text-transform-normal" title="Cancel">Cancel</a>
        <button type="submit"  class="btn btn-secondary sm text-transform-normal" title="Submit" >Submit</button>
    </div>
</form>

{{-- <div class="modal-backdrop"></div>
<div class="modal" id="fund-submitted">
    <div class="modal-content text-center">
        <h2>Fund successfully submitted!</h2>
        <p>Your fund submission is now awaiting approval.</p>
        <div class="paging-buttons p-0">
            <a href="#" class="btn btn-secondary sm close-modal" title="CLOSE">CLOSE</a>
        </div>
    </div>
</div> --}}
{{-- <script>
    function submitForm() {
        var form = document.getElementById('myForm');
        form.submit();
    }
</script> --}}
