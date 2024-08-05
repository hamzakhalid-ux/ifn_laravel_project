@php
    $fundTypes=['Digital','Endowment','ETF','Feeder','Growth','Income','Income + Growth','Index','Pension','REITs','Retirement']
@endphp
<div class="sort-head m-b-45">
    {{-- <form class="funds-form"> --}}
    <form class="funds-form" method="GET" action="{{ route('fund.list') }}" enctype="multipart/form-data">

        <div class="form-group m-0">
            <select class="selectpicker" name="fund_country" data-placeholder="By Country">
                <option value="">By Country</option>
                @if(!empty($all_countries))
                    @foreach($all_countries as $country)
                        <option {{( request()->get('fund_country') == $country->iso) ? 'selected' : '' }} value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group m-0">
            {{-- <input type="text" name="fund_region" class="form-control" value="{{request()->get('fund_region')}}" placeholder="By Regions"> --}}
            <select class="selectpicker" name="fund_region" data-placeholder="By Region">
                <option value="">By Region</option>
                @if(!empty($uniqueRegions))
                    @foreach($uniqueRegions as $region)
                        <option {{((!empty(request()->get('fund_region'))) && request()->get('fund_region') == $region ) ? 'selected' : '' }} value="{{$region}}">{{$region ?? ''}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group m-0">
            {{-- <input type="text" name="type_of_fund" class="form-control" value="{{request()->get('type_of_fund')}}" placeholder="Type of Fund"> --}}
            <select class="selectpicker" id=""  name="type_of_fund" data-placeholder="Fund Type">
                <option  value="">Please select Fund Type</option>
                @if(!empty($fundTypes))
                    @foreach($fundTypes as $fundtype)
                        <option @if(!empty(request()->get('type_of_fund')) && request()->get('type_of_fund') == $fundtype) selected @endif value="{{$fundtype}}">{{$fundtype ?? ''}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group m-0">
            {{-- <input type="text" name="fund_name" class="form-control" value="{{request()->get('fund_name')}}" placeholder="Fund Name"> --}}
            <select class="selectpicker"  id=""  name="open_closed" data-placeholder="Open/Closed">
                <option  value="">Open/Closed</option>
                <option @if(!empty(request()->get('open_closed')) && request()->get('open_closed') == 'open') selected @endif value="open">Open</option>
                <option @if(!empty(request()->get('open_closed')) && request()->get('open_closed') == 'closed') selected @endif value="closed">Closed</option>
            </select>
        </div>
        <a href="{{url('directory-list')}}" class="btn btn-secondary text-transform-normal sm" title="Fund Directory " >Fund Directory </a>
        <div class="form-group m-0">
            {{-- <input type="text" name="investor_risk" class="form-control" value="{{request()->get('investor_risk')}}" placeholder="Investor Risk Profile"> --}}
            <select class="selectpicker" name="investor_risk" id="" data-placeholder="Investor Risk Profile">
                <option  value="">Select Investor Risk Profile</option>
                <option @if(!empty(request()->get('investor_risk')) && request()->get('investor_risk') == 'very-high') selected @endif  value="very-high">Very High</option>
                <option @if(!empty(request()->get('investor_risk')) && request()->get('investor_risk') == 'high') selected @endif value="high">High</option>
                <option @if(!empty(request()->get('investor_risk')) && request()->get('investor_risk') == 'moderate') selected @endif value="moderate">Moderate</option>
                <option @if(!empty(request()->get('investor_risk')) && request()->get('investor_risk') == 'low') selected @endif value="low">Low</option>
                <option @if(!empty(request()->get('investor_risk')) && request()->get('investor_risk') == 'very-low') selected @endif value="very-low">Very Low</option>
            </select>
        </div>
        <div class="form-group m-0">
            {{-- <input type="datetime-local" name="fund_date" class="form-control" value="{{request()->get('fund_date')}}" placeholder="Launch Date"> --}}
            <select class="selectpicker" name="asset_class" id="" data-placeholder="Asset Class">
                <option  value="">Select Asset Class</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'commodities') selected @endif value="commodities">Commodities</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'cryptocurrencies') selected @endif value="cryptocurrencies">Cryptocurrencies</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'debt') selected @endif value="debt">Debt</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'equities') selected @endif value="equities">Equities</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'etf') selected @endif value="etf">ETF</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'fixed-ncome-nstruments') selected @endif value="fixed-ncome-nstruments">Fixed Income Instruments </option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'mixed-assets') selected @endif value="mixed-assets">Mixed Assets </option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'money-market') selected @endif value="money-market">Money Market </option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'money-market_fixed-income-instruments') selected @endif value="money-market_fixed-income-instruments">Money Market + Fixed Income Instruments</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'money-market_sukuk') selected @endif value="money-market_sukuk">Money Market + Sukuk</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'real-estates') selected @endif value="real-estates">Real Estates</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'sukuk') selected @endif value="sukuk">Sukuk</option>
                <option @if(!empty(request()->get('asset_class')) && request()->get('asset_class') == 'sukuk_fixed-income-instruments') selected @endif value="sukuk_fixed-income-instruments">Sukuk + Fixed Income Instruments</option>
            </select>
        </div>
        <div class="form-group m-0">
            {{-- <input type="number" name="fund_expense_ratio" class="form-control" value="{{request()->get('fund_expense_ratio')}}" placeholder="Total Expense Ratio (TER)"> --}}
            <select class="selectpicker" name="domiciled" data-placeholder="Domiciled">
                <option value="">By Country</option>
                @if(!empty($all_countries))
                    @foreach($all_countries as $country)
                        <option {{( request()->get('domiciled') == $country->iso) ? 'selected' : '' }} value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-search text-transform-normal sm">Search</button>
        <a href="#" onclick="window.location.href = '{{ route('fund.add') }}';" class="btn btn-secondary text-transform-normal sm" title="Add Your Fund " >
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.585 0.674805C5.06496 0.674805 0.584961 5.1548 0.584961 10.6748C0.584961 16.1948 5.06496 20.6748 10.585 20.6748C16.105 20.6748 20.585 16.1948 20.585 10.6748C20.585 5.1548 16.105 0.674805 10.585 0.674805ZM15.585 11.6748H11.585V15.6748H9.58496V11.6748H5.58496V9.6748H9.58496V5.6748H11.585V9.6748H15.585V11.6748Z" fill="white"></path>
            </svg>
            Add Your Fund
        </a>
    </form>
    <div class="btn btn-secondary m-t-10"id="reset_search_button">Reset</div>
</div>
<h3 class="label-title text-transform-normal min-width m-b-40">Database</h3>
{{-- @dd($ifn_funds->toArray()) --}}
@php

    $asset_class = ['commodities' => 'Commodities' ,'cryptocurrencies'=> 'Cryptocurrencies','debt'=>'Debt',
                       'equities'=> 'Equities','etf'=> 'ETF','fixed-ncome-nstruments'=> 'Fixed Income Instruments',
                      'mixed-assets'=>'Mixed Assets' ,'money-market'=>'Money Market', 'money-market_fixed-income-instruments' => 'Money Market + Fixed Income Instruments',
                       'money-market_sukuk'=>'Money Market + Sukuk', 'real-estates'=> 'Real Estates','sukuk'=>'Sukuk',
                       'sukuk_fixed-income-instruments'=> 'Sukuk + Fixed Income Instruments'];
    $invester_risk = ['very-high' => 'very-high' ,'high'=>'High','moderate'=>'Moderate','low'=>'Low','very-low'=> 'Very Low' ]

@endphp
<div class="custom-table-scroll">
    <table id="dataTable">
        <thead>
            <tr>
                <th><span>Fund Name</span></th>
                <th><span>Fund Management Company</span></th>
                <th><span>Country</span></th>
                <th><span>Region</span></th>
                <th><span>Types of fund</span></th>
                <th><span>Investor Risk</span></th>
                <th><span>Asset Class</span></th>
                {{-- <th><span>Assets Under Management (US $)</span></th>
                    --}}
                <th><span>Open/Closed</span></th>
                <th><span>Public/Private</span></th>
                <th><span>Investor Risk Profile</span></th>
                <th><span>Local AUM</span></th>
                <th><span>Local Currency</span></th>
                <th><span>AUM USD</span></th>
                <th><span>Management Fee</span></th>
                <th><span>Entry Fee</span></th>
                <th><span>Exit Fee</span></th>
                <th><span>Launch Date</span></th>
                <th><span>Return 1y (Annualised)</span></th>
                <th><span>Returns 3Y (Annualised) </span></th>
                <th><span>Returns 5Y (Annualised)</span></th>
                <th><span>Return YTD (Annualised)</span></th>
                <th><span>Domiciled</span></th>
                <th><span>Last Update</span></th>
                <th><span>Shariah Advisors</span></th>
                <th class="action-cell"><span>Action</span></th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($ifn_funds))
                @foreach($ifn_funds as $index=>$fund)
                    <tr onclick="window.location='{{ url('/subscriber-fund-detail/'.$fund->fund_id) }}';">
                        <td>{{$fund->fund_name}}</td>
                        <td>{{$fund->companydetail->company_name}}</td>
                        <td>{{$fund->loctitle->title ?? ''}}</td>
                        <td>{{$fund->fund_region}}</td>
                        <td>{{$fund->type_of_fund}}</td>
                        <td>{{!empty($invester_risk[$fund->investor_risk]) ? $invester_risk[$fund->investor_risk] : ($fund->investor_risk ?? '')}}</td>
                        <td>{{ $asset_class[$fund->asset_class] ?? '' }}</td>


                        <td>{{ucfirst($fund->open_closed)}}</td>
                        <td>Public</td>
                        <td>{{$fund->contact_person_name}}</td>
                        <td>
                            @if (is_float($fund->fund_expense_ratio) || is_int($fund->fund_expense_ratio))
                                {{ number_format($fund->fund_expense_ratio) }}
                            @else
                                {{ $fund->fund_expense_ratio }}
                            @endif
                        </td>
                        <td>{{$fund->fund_currency}}</td>
                        <td>{{(!empty($fund->anum_usd ) && $fund->anum_usd != 0) ? number_format($fund->anum_usd,2).'$' : 0 }}</td>
                        <td>{{number_format($fund->management_fee , 2) . '%'}}</td>
                        <td>{{number_format($fund->entry_fee , 2) . '%'}}</td>
                        <td>{{number_format($fund->exit_fee , 2) . '%'}}</td>
                        <td>{{$fund->created_at}}</td>
                        <td>{{$fund->return_1y}}</td>
                        <td>{{$fund->return_3y}}</td>
                        <td>{{$fund->return_5y}}</td>
                        <td>{{$fund->return_ytd}}</td>
                        <td>{{$fund->domiciled}}</td>
                        <td>{{$fund->fund_last_update_date}}</td>
                        <td>{{$fund->shariah_advisors}}</td>
                        <td>
                            <a href="#" title="action">
                                <img src="assets/images/icons/action-icon.svg" alt="action icon">
                            </a>
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
