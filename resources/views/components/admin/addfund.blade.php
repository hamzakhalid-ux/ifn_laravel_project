@php
    $fundTypes=['Digital','Endowment','ETF','Feeder','Growth','Income','Income + Growth','Index','Pension','REITs','Retirement']
@endphp
<div class="">
    <div class="card card-info">
        <div class="card-header row">
            <h3 class="card-title col-sm-6">Add Fund</h3>
            <form action="{{ route('import.funds') }}" method="post" enctype="multipart/form-data" class="col-sm-6 mt-3">
                @csrf
                <div class="row">
                    <div class="col-xs-6">
                        <input type="file" name="file" accept=".xlsx"  class="form-control">
                    </div>
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary">Import Funds</button>
                    </div>
                </div>
            </form>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/fund/store-fund') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Fund Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[fund_name]" value="{{old('fund.fund_name')}}" class="form-control"  placeholder="Fund Name">
                            </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Manager Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[fund_manager]" value="" class="form-control"  placeholder="Fund Manager Name">
                            </div>
                    </div> --}}
                    <div class="form-froup row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Region</label>
                        <div class="col-sm-10">
                            <label class="custom-region"></label>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Region</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple" id=""  name="fund[fund_region]">
                               <option  value="">Please select Region</option>
                                @if(!empty($uniqueRegions))
                                    @foreach($uniqueRegions as $region)
                                        <option @if(old('fund.fund_region') == $region) selected @endif value="{{$region}}">{{$region ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple customcountry"  id=""  name="fund[fund_country]">
                               <option  value="">Please select country</option>
                                @if(!empty($all_countries))
                                    @foreach($all_countries as $country)
                                        <option @if(old('fund.fund_country') == $country->iso) selected @endif value="{{$country->iso}}" data-region="{{$country->region}}">{{$country->name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Investor Risk</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="fund[investor_risk]" id="">
                                    <option @if(old('fund.investor_risk') == 'very-high') selected @endif value="very-high">Very High</option>
                                    <option @if(old('fund.investor_risk') == 'high') selected @endif  value="high">High</option>
                                    <option @if(old('fund.investor_risk') == 'moderate') selected @endif value="moderate">Moderate</option>
                                    <option @if(old('fund.investor_risk') == 'low') selected @endif value="low">Low</option>
                                    <option @if(old('fund.investor_risk') == 'very-low') selected @endif value="very-low">Very Low</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Local Currency</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id="local_currency"  name="fund[fund_currency]">
                                <option  value="">Please select Currency</option>
                                    @if(!empty($all_currencies))
                                        @foreach($all_currencies as $currency)
                                            <option @if(old('fund.fund_currency') == $currency->code) selected @endif  value="{{$currency->code}}">{{$currency->code ?? ''}}</option>
                                        @endforeach
                                    @endif
                                </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">AUM USD</label>
                            <div class="col-sm-7">
                                <input type="number" id="anum_usd" readonly name="fund[anum_usd]"  value="{{old('fund.anum_usd')}}" class="form-control"  placeholder="Enter AUM USD">
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-success convertCurrency">Convert</button>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Contact Person Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[contact_person_name]"  value="{{old('fund.contact_person_name')}}" class="form-control"  placeholder="Enter Person Name">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Contact Person Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="fund[contact_person_email]"  value="{{old('fund.contact_person_email')}}" class="form-control"  placeholder="Enter Email">
                            </div>
                    </div>


                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Contact Person Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[contact_person_phone]"  value="{{old('fund.contact_person_phone')}}" class="form-control"  placeholder="Enter Phone Number">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Contact Person landline</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[contact_person_landline]"  value="{{old('fund.contact_person_landline')}}" class="form-control"  placeholder="Enter landline">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Management Fee</label>
                            <div class="col-sm-10">
                                <input type="number" name="fund[management_fee]" step="any" min="0" max="100"  value="" class="form-control"  placeholder="Enter Management Fee">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Entry Fee</label>
                            <div class="col-sm-10">
                                <input type="number" name="fund[entry_fee]" step="any" min="0" max="100"  value="{{old('fund.entry_fee')}}" class="form-control"  placeholder="Enter Entry Fee">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Exit Fee</label>
                            <div class="col-sm-10">
                                <input type="number" name="fund[exit_fee]" step="any" min="0" max="100"  value="{{old('fund.exit_fee')}}" class="form-control"  placeholder="Enter Exit Fee">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Shariah Advisors</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[shariah_advisors]"  value="{{old('fund.shariah_advisors')}}" class="form-control"  placeholder="Enter Shariah Advisors">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Trustees</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[trustees]"  value="{{old('fund.trustees')}}" class="form-control"  placeholder="Enter Trustees">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Open Closed</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id=""  name="fund[open_closed]">
                                <option  value="">Select</option>
                                    <option @if(old('fund.open_closed') == 'open') selected @endif value="open">Open</option>
                                    <option @if(old('fund.open_closed') == 'closed') selected @endif value="closed">Closed</option>
                                </select>
                        </div>
                    </div>



                </div>
                <div class="col-sm-6">

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Fund Website</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[fund_website]"  value="{{old('fund.fund_website')}}" class="form-control"  placeholder="Fund Website">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Asset Class</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="fund[asset_class]" id="">
                                    <option @if(old('fund.asset_class') == 'commodities') selected @endif value="commodities">Commodities</option>
                                    <option @if(old('fund.asset_class') == 'cryptocurrencies') selected @endif value="cryptocurrencies">Cryptocurrencies</option>
                                    <option @if(old('fund.asset_class') == 'debt') selected @endif value="debt">Debt</option>
                                    <option @if(old('fund.asset_class') == 'equities') selected @endif value="equities">Equities</option>
                                    <option @if(old('fund.asset_class') == 'etf') selected @endif value="etf">ETF</option>
                                    <option @if(old('fund.asset_class') == 'fixed-ncome-nstruments') selected @endif value="fixed-ncome-nstruments">Fixed Income Instruments </option>
                                    <option @if(old('fund.asset_class') == 'mixed-assets') selected @endif value="mixed-assets">Mixed Assets </option>
                                    <option @if(old('fund.asset_class') == 'money-market') selected @endif value="money-market">Money Market </option>
                                    <option @if(old('fund.asset_class') == 'money-market_fixed-income-instruments') selected @endif value="money-market_fixed-income-instruments">Money Market + Fixed Income Instruments</option>
                                    <option @if(old('fund.asset_class') == 'money-market_sukuk') selected @endif value="money-market_sukuk">Money Market + Sukuk</option>
                                    <option @if(old('fund.asset_class') == 'real-estate') selected @endif value="real-estates">Real Estates</option>
                                    <option @if(old('fund.asset_class') == 'sukuk') selected @endif value="sukuk">Sukuk</option>
                                    <option @if(old('fund.asset_class') == 'sukuk_fixed-income-instruments') selected @endif value="sukuk_fixed-income-instruments">Sukuk + Fixed Income Instruments</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Company</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id=""  name="fund[fund_company]">
                               <option  value="">Please select Company</option>
                                @if(!empty($ifn_companies))
                                    @foreach($ifn_companies as $company)
                                        <option @if(old('fund.fund_company') == $company->company_id) selected @endif value="{{$company->company_id}}">{{$company->company_name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Types of Funds</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" name="fund[type_of_fund]"  value="" class="form-control"  placeholder="Enter Fund Type"> --}}
                                <select class="form-control js-example-basic-multiple"  id=""  name="fund[type_of_fund]">
                                    <option  value="">Please select Fund Type</option>
                                     @if(!empty($fundTypes))
                                         @foreach($fundTypes as $fundtype)
                                             <option @if(old('fund.type_of_fund') == $fundtype) selected @endif value="{{$fundtype}}">{{$fundtype ?? ''}}</option>
                                         @endforeach
                                     @endif
                                 </select>
                            </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[fund_city]"  value="" class="form-control"  placeholder="City Name">
                            </div>
                    </div> --}}

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Local AUM:</label>
                        <div class="col-sm-10">
                            <input type="number" id="local_amount" name="fund[fund_expense_ratio]"  value="{{old('fund.fund_expense_ratio')}}" class="form-control"  placeholder="Local AUM">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Contact Person Designation</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[fund_person_designation]"  value="{{old('fund.fund_person_designation')}}" class="form-control"  placeholder="Enter Designation">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Launched Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="fund[launched_date]"  value="{{old('fund.launched_date')}}" class="form-control"  placeholder="Select Date">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Fact  Sheet Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="fund[fact_sheet_date]"  value="{{old('fund.fact_sheet_date')}}" class="form-control"  placeholder="Select Date">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Date of Last Update</label>
                            <div class="col-sm-10">
                                <input type="date" name="fund[fund_last_update_date]"  value="{{old('fund.fund_last_update_date')}}" class="form-control"  placeholder="Select Date">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Attach File</label>
                            <div class="col-sm-10">
                                <input type="file" accept=".pdf"  name="fund[attached_file]" value="" class="form-control"  placeholder="Select Date">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Return 1Y (Annualised)</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[return_1y]"  value="{{old('fund.return_1y')}}" class="form-control"  placeholder="Return 1Y (Annualised) %">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Returns 3Y (Annualised)</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[return_3y]"  value="{{old('fund.return_3y')}}" class="form-control"  placeholder="Return 3Y (Annualised) %">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Returns 5Y (Annualised)</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[return_5y]"  value="{{old('fund.return_5y')}}" class="form-control"  placeholder="Return 5Y (Annualised) %">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Return YTD (Annualised)</label>
                            <div class="col-sm-10">
                                <input type="text" name="fund[return_ytd]"  value="{{old('fund.return_ytd')}}" class="form-control"  placeholder="Return YTD (Annualised) %">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Domiciled</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id=""  name="fund[domiciled]">
                               <option  value="">Please select country</option>
                                @if(!empty($all_countries))
                                    @foreach($all_countries as $country)
                                        <option @if(old('fund.domiciled') == $country->iso) selected @endif value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card-footer" style="margin-left: 16px;">
                <button type="submit" class="btn btn-info">Publish</button>
                                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

            </div>
        </form>
    </div>
</div>
