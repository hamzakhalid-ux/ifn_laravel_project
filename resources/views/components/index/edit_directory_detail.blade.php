<div class="sort-head m-b-100">
    <form class="funds-form">
        <div class="form-group m-0">
            <input type="text" class="form-control" placeholder="Company Name">
        </div>
        <div class="form-group m-0">
            <select class="selectpicker">
                <option>By Country</option>
                <option>option2</option>
                <option>option3</option>
            </select>
        </div>
        <div class="form-group m-0">
            <select class="selectpicker">
                <option>By Regions</option>
                <option>option2</option>
                <option>option3</option>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary text-transform-normal sm">Search</button>
        <a href="{{url('directory-list')}}" class="btn btn-secondary text-transform-normal sm" title="Fund Database" >Fund Database</a>
    </form>
</div>
<h3 class="label-title text-transform-normal min-width m-b-40">Fund Directory</h3>
<form class="funds-form" method="POST" action="{{ url('company/update') }}" enctype="multipart/form-data">
@csrf
    <div class="content-box m-b-20">

            <input type="hidden" id="company_id" name="company[company_id]" value="{{$company->company_id ?? ''}}">
            <div class="uploader-wrapper m-b-45">
                <div class="image">
                    <img src="{{ asset('media/' . $company->company_logo) }}" alt="ableAce-logo">
                </div>
                <div>
                    <div class="upload-btn m-r-15">
                        <button class="btn btn-search">Upload New photo</button>
                        <input type="file" name="company[company_logo]">
                    </div>
                    <a href="#" class="btn btn-gray text-transform-normal">Reset</a>
                    <i class="note">Allowed JPG, GIF or PNG. Max size of 800K</i>
                </div>
            </div>
            <div class="flex-row">
                <div class="col-6">
                    <div class="form-group ">
                        <input type="text"  class="form-control" name="company[company_name]" value="{{$company->company_name ?? ''}}" placeholder="Company ABC" >
                        <label>Fund Management Company</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select class="selectpicker" name="company[company_country]">
                            @if(!empty($all_countries))
                                @foreach($all_countries as $country)
                                    <option @if(!empty($company) && $company->company_country == $country->iso ) selected @endif value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label>Country</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text"  class="form-control"  name="company[company_city]" value="{{$company->company_city ?? ''}}" placeholder="Company City Name" >
                        <label>City/Town</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text"  class="form-control"  name="company[company_web]"  value="{{$company->company_web ?? ''}}" placeholder="www.ifninvestor.com" >
                        <label>Website Address</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="company[company_phone]" value="{{$company->company_phone ?? ''}}" placeholder="+1 (837) 546-7238" >
                        <label>Phone Number</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select  class="selectpicker" name="company[company_timezone]">
                            @if(!empty($timezone))
                                @foreach($timezone as $time)
                                    <option @if(!empty($company) && $company->company_timezone == $time->country_code ) selected @endif value="{{$time->country_code}}">{{$time->timezone ?? ''}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label>Region</label>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="form-group">
                        <select class="selectpicker" name="company[company_currency]">
                            @if(!empty($all_currencies))
                                @foreach($all_currencies as $currency)
                                    <option @if(!empty($company) && $company->company_currency == $currency->code ) selected @endif value="{{$currency->code}}">{{$currency->name ?? ''}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label>Currency</label>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="form-group m-0">
                        <textarea type="text" class="form-control" name="company[company_profile]" placeholder="" rows="6" cols="73">{!! $company->company_profile ?? '' !!}</textarea>
                        <label>Fund Management Company Profile</label>
                    </div>
                </div>
            </div>
    </div>
        @if(!empty($company->funds) && count($company->funds) > 0)
        @foreach ($company->funds as $index=>$fund)
            <input type="hidden" name="fund[{{$index}}][fund_company]" value="{{$company->company_id ?? ''}}">
            <div class="content-box p-b-25 m-b-20">
                <div class="content-head m-b-40">
                    <h5>Funds</h5>
                    @if(!empty($fund->attached_file))
                    <a href="{{ url('fund/download_pdf/'.$fund->fund_id) }}" title="fact" class="view-file">
                        <img src="{{asset('assets/images/icons/add-file-icon.svg')}}" alt="add file">Fact SHEET</a>
                    </a>
                    @else
                        {{-- <h5>No Fund Fact Sheet</h5> --}}
                    @endif
                </div>
                <div class="flex-row">
                    <div class="col-6">
                        <div class="form-group ">
                            <input type="text" class="form-control" name="fund[{{$index}}][fund_name]" placeholder="Management" value="{{$fund->fund_name ?? ''}}" >
                            <label>Fund Name</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select class="selectpicker" name="fund[{{$index}}][fund_country]">
                                @if(!empty($all_countries))
                                @foreach($all_countries as $country)
                                    <option @if(!empty($fund->fund_country) && $fund->fund_country == $country->iso) selected @endif value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                                @endforeach
                            @endif
                            </select>
                            <label>Fund Country</label>
                        </div>
                    </div>
                    {{-- <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fund[{{$index}}][fund_city]" value="{{$fund->fund_city ?? ''}}" placeholder="Risk Profile" required>
                            <label>Fund City</label>
                        </div>
                    </div> --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fund[{{$index}}][contact_person_name]" value="{{$fund->contact_person_name ?? ''}}" placeholder="Risk Profile" >
                            <label>Contact Person Name</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fund[{{$index}}][contact_person_email]" value="{{$fund->contact_person_email ?? ''}}" placeholder="abcexample45@gmail.com" >
                            <label>Contact Person Email</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text"  class="form-control" name="fund[{{$index}}][contact_person_phone]" value="{{$fund->contact_person_phone ?? ''}}" placeholder="+1 (837) 546-7238" >
                            <label>Contact Person Phone</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text"  class="form-control" name="fund[{{$index}}][contact_person_landline]" value="{{$fund->contact_person_landline ?? ''}}" placeholder="Contact Person Landline" >
                            <label>Contact Person Landline</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {{-- <input type="text" class="form-control" name="fund[{{$index}}][investor_risk]" value="{{$fund->investor_risk ?? ''}}" placeholder="Risk Profile" > --}}
                            <select class="selectpicker" name="fund[{{$index}}][investor_risk]" id="">
                                <option value="">Select Investor Risk Profile</option>
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
                            <input type="text" class="form-control" name="fund[{{$index}}][fund_expense_ratio]" value="{{$fund->fund_expense_ratio ?? ''}}" placeholder="$7,767" >
                            <label>Total Expense Ratio</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" name="fund[{{$index}}][fund_last_update_date]" value="{{$fund->fund_last_update_date ?? ''}}">
                            <label>Date Of Last Update</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" name="fund[{{$index}}][launched_date]" value="{{$fund->launched_date ?? ''}}">
                            <label>Launch Date</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text"  class="form-control" name="fund[{{$index}}][type_of_fund]" value="{{$fund->type_of_fund ?? ''}}" placeholder="Open" >
                            <label>Type Of Fund</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text"  class="form-control"  name="fund[{{$index}}][fund_person_designation]" value="{{$fund->fund_person_designation ?? ''}}" placeholder="Open" >
                            <label>Fund Person Designation</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Management Fee" name="fund[{{$index}}][management_fee]" value="{{$fund->management_fee ?? ''}}">
                            <label>Management Fee</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Entry Fee" name="fund[{{$index}}][entry_fee]" value="{{$fund->entry_fee ?? ''}}">
                            <label>Entry Fee</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Exit Fee" name="fund[{{$index}}][exit_fee]" value="{{$fund->exit_fee ?? ''}}">
                            <label>Exit Fee</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Shariah Advisor" name="fund[{{$index}}][shariah_advisors]" value="{{$fund->shariah_advisors ?? ''}}">
                            <label>Shariah Advisor</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Trustees" name="fund[{{$index}}][trustees]" value="{{$fund->trustees ?? ''}}">
                            <label>Trustees</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select class="selectpicker" id=""  name="fund[{{$index}}][open_closed]">
                                <option  value="">Select</option>
                                <option @if(!empty($fund->open_closed) && $fund->open_closed == 'open') selected @endif  value="open">Open</option>
                                <option @if(!empty($fund->open_closed) && $fund->open_closed == 'closed') selected @endif value="closed">Closed</option>
                            </select>
                            <label>Open/Closed</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Fund Website" name="fund[{{$index}}][fund_website]" value="{{$fund->fund_website ?? ''}}">
                            <label>Fund Website</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {{-- <input type="text" class="form-control" placeholder="Asset Class" name="fund[{{$index}}][asset_class]" value="{{$fund->asset_class ?? ''}}"> --}}
                            <select class="selectpicker" name="fund[{{$index}}][asset_class]" id="" data-placeholder="Asset Class">
                                <option  value="">Select Asset Class</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'commodities') selected @endif value="commodities">Commodities</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'cryptocurrencies') selected @endif value="cryptocurrencies">Cryptocurrencies</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'debt') selected @endif value="debt">Debt</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'equities') selected @endif value="equities">Equities</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'etf') selected @endif value="etf">ETF</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'fixed-ncome-nstruments') selected @endif value="fixed-ncome-nstruments">Fixed Income Instruments </option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'mixed-assets') selected @endif value="mixed-assets">Mixed Assets </option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'money-market') selected @endif value="money-market">Money Market </option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'money-market_fixed-income-instruments') selected @endif value="money-market_fixed-income-instruments">Money Market + Fixed Income Instruments</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'money-market_sukuk') selected @endif value="money-market_sukuk">Money Market + Sukuk</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'real-estates') selected @endif value="real-estates">Real Estates</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'sukuk') selected @endif value="sukuk">Sukuk</option>
                                <option @if(!empty($fund->asset_class) && $fund->asset_class == 'sukuk_fixed-income-instruments') selected @endif value="sukuk_fixed-income-instruments">Sukuk + Fixed Income Instruments</option>
                            </select>
                            <label>Asset Class</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Return 1y (Annualised) %" name="fund[{{$index}}][return_1y]" value="{{$fund->return_1y ?? ''}}">
                            <label>Return 1y (Annualised)</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Returns 5Y (Annualised) %" name="fund[{{$index}}][return_3y]" value="{{$fund->return_3y ?? ''}}">
                            <label>Returns 3Y (Annualised)</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Returns 5Y (Annualised) %" name="fund[{{$index}}][return_5y]" value="{{$fund->return_5y ?? ''}}">
                            <label>Returns 5Y (Annualised)</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Return YTD (Annualised) %" name="fund[{{$index}}][return_ytd]" value="{{$fund->return_ytd ?? ''}}">
                            <label>Return YTD (Annualised)</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div id="all_fund_div">
    </div>
    <input type="hidden" id="fundindex" value="0">
    <div class="text-right">
        <a  class="btn btn-secondary sm text-transform-normal height-57 addmorefund"  style="min-width: 300px;" title="Add Your Fund">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.585 0.674805C5.06496 0.674805 0.584961 5.1548 0.584961 10.6748C0.584961 16.1948 5.06496 20.6748 10.585 20.6748C16.105 20.6748 20.585 16.1948 20.585 10.6748C20.585 5.1548 16.105 0.674805 10.585 0.674805ZM15.585 11.6748H11.585V15.6748H9.58496V11.6748H5.58496V9.6748H9.58496V5.6748H11.585V9.6748H15.585V11.6748Z" fill="white"></path>
            </svg> Add Your Fund
        </a>
    </div>
    <div class="content-box p-b-25 m-t-20 m-b-20">
        <div class="content-head m-b-25">
            <h5>Social Accounts</h5>
        </div>
        <ul class="update-social-list unstyled-list">
            <li>
                <div class="icon">
                    <img src="{{asset('assets/images/icons/linkedin-square.svg')}}" alt="linkedin">LinkedIn
                </div>
                <div class="funds-form relative">
                    <input type="text" class="form-control" name="company[linkdin_link]" value="{{$company->linkdin_link ?? ''}}" placeholder="www.ifn.com" >

                    <span class="input-icon">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.96197 11.2931C10.095 10.1601 12.071 10.1601 13.204 11.2931L13.911 12.0001L15.325 10.5861L14.618 9.87906C13.675 8.93506 12.419 8.41406 11.083 8.41406C9.74697 8.41406 8.49097 8.93506 7.54797 9.87906L5.42597 12.0001C4.49027 12.9388 3.96484 14.2101 3.96484 15.5356C3.96484 16.861 4.49027 18.1323 5.42597 19.0711C5.88984 19.5356 6.44094 19.9039 7.04759 20.1548C7.65424 20.4057 8.30449 20.5342 8.96097 20.5331C9.61763 20.5344 10.2681 20.406 10.8749 20.1551C11.4818 19.9042 12.033 19.5358 12.497 19.0711L13.204 18.3641L11.79 16.9501L11.083 17.6571C10.5194 18.2181 9.75664 18.533 8.96147 18.533C8.1663 18.533 7.4035 18.2181 6.83997 17.6571C6.27847 17.0938 5.96318 16.3309 5.96318 15.5356C5.96318 14.7402 6.27847 13.9773 6.83997 13.4141L8.96197 11.2931Z" fill="#8592A3"/>
                            <path d="M12.496 4.92875L11.789 5.63575L13.203 7.04975L13.91 6.34275C14.4735 5.78174 15.2363 5.46678 16.0315 5.46678C16.8266 5.46678 17.5894 5.78174 18.153 6.34275C18.7145 6.90602 19.0298 7.66892 19.0298 8.46425C19.0298 9.25958 18.7145 10.0225 18.153 10.5857L16.031 12.7067C14.898 13.8397 12.922 13.8397 11.789 12.7067L11.082 11.9997L9.66797 13.4137L10.375 14.1207C11.318 15.0647 12.574 15.5857 13.91 15.5857C15.246 15.5857 16.502 15.0647 17.445 14.1207L19.567 11.9997C20.5027 11.061 21.0281 9.78967 21.0281 8.46425C21.0281 7.13883 20.5027 5.86746 19.567 4.92875C18.6285 3.99256 17.357 3.4668 16.0315 3.4668C14.7059 3.4668 13.4344 3.99256 12.496 4.92875Z" fill="#32475C" fill-opacity="0.54"/>
                        </svg>
                    </span>
                </div>
            </li>
            <li>
                <div class="icon">
                    <img src="{{asset('assets/images/icons/Instagram-square.svg')}}" alt="Instagram">Instagram
                </div>
                <div class="funds-form relative">
                    <input type="text" class="form-control" name="company[instagram_link]" value="{{$company->instagram_link ?? ''}}" placeholder="www.ifn.com" >

                    <span class="input-icon">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.96197 11.2931C10.095 10.1601 12.071 10.1601 13.204 11.2931L13.911 12.0001L15.325 10.5861L14.618 9.87906C13.675 8.93506 12.419 8.41406 11.083 8.41406C9.74697 8.41406 8.49097 8.93506 7.54797 9.87906L5.42597 12.0001C4.49027 12.9388 3.96484 14.2101 3.96484 15.5356C3.96484 16.861 4.49027 18.1323 5.42597 19.0711C5.88984 19.5356 6.44094 19.9039 7.04759 20.1548C7.65424 20.4057 8.30449 20.5342 8.96097 20.5331C9.61763 20.5344 10.2681 20.406 10.8749 20.1551C11.4818 19.9042 12.033 19.5358 12.497 19.0711L13.204 18.3641L11.79 16.9501L11.083 17.6571C10.5194 18.2181 9.75664 18.533 8.96147 18.533C8.1663 18.533 7.4035 18.2181 6.83997 17.6571C6.27847 17.0938 5.96318 16.3309 5.96318 15.5356C5.96318 14.7402 6.27847 13.9773 6.83997 13.4141L8.96197 11.2931Z" fill="#8592A3"/>
                            <path d="M12.496 4.92875L11.789 5.63575L13.203 7.04975L13.91 6.34275C14.4735 5.78174 15.2363 5.46678 16.0315 5.46678C16.8266 5.46678 17.5894 5.78174 18.153 6.34275C18.7145 6.90602 19.0298 7.66892 19.0298 8.46425C19.0298 9.25958 18.7145 10.0225 18.153 10.5857L16.031 12.7067C14.898 13.8397 12.922 13.8397 11.789 12.7067L11.082 11.9997L9.66797 13.4137L10.375 14.1207C11.318 15.0647 12.574 15.5857 13.91 15.5857C15.246 15.5857 16.502 15.0647 17.445 14.1207L19.567 11.9997C20.5027 11.061 21.0281 9.78967 21.0281 8.46425C21.0281 7.13883 20.5027 5.86746 19.567 4.92875C18.6285 3.99256 17.357 3.4668 16.0315 3.4668C14.7059 3.4668 13.4344 3.99256 12.496 4.92875Z" fill="#32475C" fill-opacity="0.54"/>
                        </svg>
                    </span>
                </div>
            </li>
            <li>
                <div class="icon">
                    <img src="{{asset('assets/images/icons/Facebook-square.svg')}}" alt="Facebook">Facebook
                </div>
                <div class="funds-form relative">
                    <input type="text"  class="form-control" name="company[facebook_link]" value="{{$company->facebook_link ?? ''}}" placeholder="www.ifn.com" >

                    <span class="input-icon">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.96197 11.2931C10.095 10.1601 12.071 10.1601 13.204 11.2931L13.911 12.0001L15.325 10.5861L14.618 9.87906C13.675 8.93506 12.419 8.41406 11.083 8.41406C9.74697 8.41406 8.49097 8.93506 7.54797 9.87906L5.42597 12.0001C4.49027 12.9388 3.96484 14.2101 3.96484 15.5356C3.96484 16.861 4.49027 18.1323 5.42597 19.0711C5.88984 19.5356 6.44094 19.9039 7.04759 20.1548C7.65424 20.4057 8.30449 20.5342 8.96097 20.5331C9.61763 20.5344 10.2681 20.406 10.8749 20.1551C11.4818 19.9042 12.033 19.5358 12.497 19.0711L13.204 18.3641L11.79 16.9501L11.083 17.6571C10.5194 18.2181 9.75664 18.533 8.96147 18.533C8.1663 18.533 7.4035 18.2181 6.83997 17.6571C6.27847 17.0938 5.96318 16.3309 5.96318 15.5356C5.96318 14.7402 6.27847 13.9773 6.83997 13.4141L8.96197 11.2931Z" fill="#8592A3"/>
                            <path d="M12.496 4.92875L11.789 5.63575L13.203 7.04975L13.91 6.34275C14.4735 5.78174 15.2363 5.46678 16.0315 5.46678C16.8266 5.46678 17.5894 5.78174 18.153 6.34275C18.7145 6.90602 19.0298 7.66892 19.0298 8.46425C19.0298 9.25958 18.7145 10.0225 18.153 10.5857L16.031 12.7067C14.898 13.8397 12.922 13.8397 11.789 12.7067L11.082 11.9997L9.66797 13.4137L10.375 14.1207C11.318 15.0647 12.574 15.5857 13.91 15.5857C15.246 15.5857 16.502 15.0647 17.445 14.1207L19.567 11.9997C20.5027 11.061 21.0281 9.78967 21.0281 8.46425C21.0281 7.13883 20.5027 5.86746 19.567 4.92875C18.6285 3.99256 17.357 3.4668 16.0315 3.4668C14.7059 3.4668 13.4344 3.99256 12.496 4.92875Z" fill="#32475C" fill-opacity="0.54"/>
                        </svg>
                    </span>
                </div>
            </li>
            <li>
                <div class="icon">
                    <img src="{{asset('assets/images/icons/Twitter-square.svg')}}" alt="Twitter">Twitter
                </div>
                <div class="funds-form relative">
                    <input type="text" class="form-control" name="company[twitter_link]" value="{{$company->twitter_link ?? ''}}" placeholder="www.ifn.com" >

                    <span class="input-icon">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.96197 11.2931C10.095 10.1601 12.071 10.1601 13.204 11.2931L13.911 12.0001L15.325 10.5861L14.618 9.87906C13.675 8.93506 12.419 8.41406 11.083 8.41406C9.74697 8.41406 8.49097 8.93506 7.54797 9.87906L5.42597 12.0001C4.49027 12.9388 3.96484 14.2101 3.96484 15.5356C3.96484 16.861 4.49027 18.1323 5.42597 19.0711C5.88984 19.5356 6.44094 19.9039 7.04759 20.1548C7.65424 20.4057 8.30449 20.5342 8.96097 20.5331C9.61763 20.5344 10.2681 20.406 10.8749 20.1551C11.4818 19.9042 12.033 19.5358 12.497 19.0711L13.204 18.3641L11.79 16.9501L11.083 17.6571C10.5194 18.2181 9.75664 18.533 8.96147 18.533C8.1663 18.533 7.4035 18.2181 6.83997 17.6571C6.27847 17.0938 5.96318 16.3309 5.96318 15.5356C5.96318 14.7402 6.27847 13.9773 6.83997 13.4141L8.96197 11.2931Z" fill="#8592A3"/>
                            <path d="M12.496 4.92875L11.789 5.63575L13.203 7.04975L13.91 6.34275C14.4735 5.78174 15.2363 5.46678 16.0315 5.46678C16.8266 5.46678 17.5894 5.78174 18.153 6.34275C18.7145 6.90602 19.0298 7.66892 19.0298 8.46425C19.0298 9.25958 18.7145 10.0225 18.153 10.5857L16.031 12.7067C14.898 13.8397 12.922 13.8397 11.789 12.7067L11.082 11.9997L9.66797 13.4137L10.375 14.1207C11.318 15.0647 12.574 15.5857 13.91 15.5857C15.246 15.5857 16.502 15.0647 17.445 14.1207L19.567 11.9997C20.5027 11.061 21.0281 9.78967 21.0281 8.46425C21.0281 7.13883 20.5027 5.86746 19.567 4.92875C18.6285 3.99256 17.357 3.4668 16.0315 3.4668C14.7059 3.4668 13.4344 3.99256 12.496 4.92875Z" fill="#32475C" fill-opacity="0.54"/>
                        </svg>
                    </span>
                </div>
            </li>
        </ul>
    </div>
    <div class="paging-buttons p-b-0">
        <a
        href="#"
        class="btn btn-primary btn-sm text-transform-normal"
        title="Cancel"
        >Cancel</a
        >
        {{-- <a
        href="#"
        class="btn btn-secondary btn-sm text-transform-normal"
        title="Save" >Save</a> --}}
        <button type="submit" class="btn btn-secondary btn-sm text-transform-normal">Save</span>

    </div>
</form>
