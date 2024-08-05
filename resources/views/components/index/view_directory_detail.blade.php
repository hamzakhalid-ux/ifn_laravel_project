@php

    $asset_class = ['commodities' => 'Commodities' ,'cryptocurrencies'=> 'Cryptocurrencies','debt'=>'Debt',
                       'equities'=> 'Equities','etf'=> 'ETF','fixed-ncome-nstruments'=> 'Fixed Income Instruments',
                      'mixed-assets'=>'Mixed Assets' ,'money-market'=>'Money Market', 'money-market_fixed-income-instruments' => 'Money Market + Fixed Income Instruments',
                       'money-market_sukuk'=>'Money Market + Sukuk', 'real-estates'=> 'Real Estates','sukuk'=>'Sukuk',
                       'sukuk_fixed-income-instruments'=> 'Sukuk + Fixed Income Instruments'];
    $invester_risk = ['very-high' => 'very-high' ,'high'=>'High','moderate'=>'Moderate','low'=>'Low','very-low'=> 'Very Low' ]

@endphp
<div class="buttons-row m-b-40">
    <h3 class="label-title text-transform-normal min-width">Fund Directory</h3>
    <a href="{{ route('directory.list') }}" class="btn btn-secondary sm text-transform-normal" title="Fund Database">
        Fund Database
    </a>
</div>
<div class="fund-desc-box p-b-50 m-b-40">
    <div class="profile-info">
        <div class="image">
            <img src="{{ asset('media/' . $company->company_logo) }}" alt="ableAce-logo">
        </div>
        <ul class="unstyled-list social-list">
            <li>
                <a href="{{$company->linkdin_link ?? ''}}" title="linkedin" >
                    <img src="{{asset('assets/images/icons/linkedin-square.svg')}}" alt="linkedin">
                </a>
            </li>
            <li>
                <a href="{{$company->instagram_link ?? ''}}" title="instagram" >
                    <img src="{{asset('assets/images/icons/instagram-square.svg')}}" alt="instagram">
                </a>
            </li>
            <li>
                <a href="{{$company->facebook_link ?? ''}}" title="facebook" >
                    <img src="{{asset('assets/images/icons/facebook-square.svg')}}" alt="facebook">
                </a>
            </li>
            <li>
                <a href="{{$company->twitter_link ?? ''}}" title="twitter" >
                    <img src="{{asset('assets/images/icons/twitter-square.svg')}}" alt="twitter">
                </a>
            </li>
            @if(session()->get('userData')->user_id == $company->user_id)
            <li>
                <a href="{{ route('edit.directory.detail', ['company_id' =>  $company->company_id]) }}" class="view-file" title="Edit">
                    <img src="{{asset('assets/images/icons/edit-icon.svg')}}" alt="Edit"> Edit
                </a>
            </li>
            @endif
        </ul>
    </div>
    <table>
        <tbody>
            <tr>
                <td>
                    <p class="label">Fund Management Company</p>
                    <p class="text-color-primary">{{$company->company_name ?? ''}}</p>
                </td>
                <td>
                    <p class="label">Country</p>
                    <p class="text-color-primary">{{$company->company_country ?? ''}}</p>
                </td>
                <td>
                    <p class="label">City/Town</p>
                    <p class="text-color-primary">{{$company->company_city ?? ''}}</p>
                </td>
                <td>
                    <p class="label">Website Address</p>
                    <p class="text-color-primary">{{$company->company_web ?? ''}}</p>
                </td>
                <td>
                    <p class="label">Phone Number</p>
                    <p class="text-color-primary">{{$company->company_phone ?? ''}}</p>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <p class="label">Fund Description</p>
                    <p class="text-color-primary">{{ $company->company_profile ?? ''}} </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="buttons-row m-b-30">
    <h3 class="label-title text-transform-normal ">List Of Funds</h3>
    <p class="counter">Total Funds: {{count($company->funds)}}</p>
</div>
<div class="funds-list">
    @if(!empty($company->funds) && count($company->funds) > 0)
        @foreach ($company->funds as $fund)
            <div class="fund-desc-box m-b-25">
                <div class="title-header m-b-25">
                    <h2>
                        {{$fund->fund_name ?? ''}}
                    </h2>
                    @if(!empty($fund->attached_file))
                        <a href="{{ url('fund/download_pdf/'.$fund->fund_id) }}" title="FACT SHEET" class="btn btn-primary" target="_blank">FACT SHEET</a>
                    @else
                        <h2>No Fund Fact Sheet</h4>
                    @endif
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <p class="label">Fund Management Company</p>
                                <p class="text-color-primary">{{$company->company_name ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Fund Coutry</p>
                                <p class="text-color-primary">{{$fund->fund_country ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Asset Class</p>
                                <p class="text-color-primary">{{$asset_class[$fund->asset_class] ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Fund Investor Risk</p>
                                <p class="text-color-primary">{{!empty($invester_risk[$fund->investor_risk]) ? $invester_risk[$fund->investor_risk] : ($fund->investor_risk ?? 'N/A')}}</p>
                            </td>
                            <td>
                                <p class="label">Contact Person Name</p>
                                <p class="text-color-primary">{{$fund->contact_person_name ?? 'N/A'}}</p>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <p class="label">Contact Person Phone</p>
                                <p class="text-color-primary">{{$fund->contact_person_phone ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Contact Person Email</p>
                                <p class="text-color-primary">{{$fund->contact_person_email ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Contact Person Landline</p>
                                <p class="text-color-primary">{{$fund->contact_person_landline ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Type Of Fund</p>
                                <p class="text-color-primary">{{$fund->type_of_fund ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Total Expense Ratio (TER)</p>
                                <p class="text-color-primary">
                                    @if (is_float($fund->fund_expense_ratio) || is_int($fund->fund_expense_ratio))
                                        {{ number_format($fund->fund_expense_ratio) }}
                                    @else
                                        {{ $fund->fund_expense_ratio }}
                                    @endif
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="label">Launch Date</p>
                                <p class="text-color-primary">{{$fund->launched_date ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Fund Last Update</p>
                                <p class="text-color-primary">{{$fund->fund_last_update_date ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Management Fee</p>
                                <p class="text-color-primary">{{number_format($fund->management_fee,2) . '%'}}</p>
                            </td>
                            <td>
                                <p class="label">Entry Fee</p>
                                <p class="text-color-primary">{{number_format($fund->entry_fee,2) . '%'}}</p>
                            </td>
                            <td>
                                <p class="label">Exit Fee</p>
                                <p class="text-color-primary">{{number_format($fund->exit_fee,2) . '%'}}</p>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <p class="label">Shariah Advisors</p>
                                <p class="text-color-primary">{{$fund->shariah_advisors ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Trustees</p>
                                <p class="text-color-primary">{{$fund->trustees ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Open/Closed</p>
                                <p class="text-color-primary">{{ ucfirst(strtolower($fund->open_closed ?? 'N/A')) }}</p>
                            </td>
                            <td>
                                <p class="label">Fund Website</p>
                                <p class="text-color-primary">{{$fund->fund_website ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Return 1y (Annualised)</p>
                                <p class="text-color-primary">{{$fund->return_1y ?? 'N/A'}}</p>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <p class="label">Returns 3Y (Annualised)</p>
                                <p class="text-color-primary">{{$fund->return_3y ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Returns 5Y (Annualised)</p>
                                <p class="text-color-primary">{{$fund->return_5y ?? 'N/A'}}</p>
                            </td>
                            <td>
                                <p class="label">Return YTD (Annualised)</p>
                                <p class="text-color-primary">{{$fund->return_ytd ?? 'N/A'}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <p class="label">Fund Description</p>
                                <p class="text-color-primary">{{ $company->company_profile ?? 'N/A'}}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>
