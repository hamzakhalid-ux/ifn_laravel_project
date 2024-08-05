@php

    $asset_class = ['commodities' => 'Commodities' ,'cryptocurrencies'=> 'Cryptocurrencies','debt'=>'Debt',
                       'equities'=> 'Equities','etf'=> 'ETF','fixed-ncome-nstruments'=> 'Fixed Income Instruments',
                      'mixed-assets'=>'Mixed Assets' ,'money-market'=>'Money Market', 'money-market_fixed-income-instruments' => 'Money Market + Fixed Income Instruments',
                       'money-market_sukuk'=>'Money Market + Sukuk', 'real-estates'=> 'Real Estates','sukuk'=>'Sukuk',
                       'sukuk_fixed-income-instruments'=> 'Sukuk + Fixed Income Instruments'];
    $invester_risk = ['very-high' => 'very-high' ,'high'=>'High','moderate'=>'Moderate','low'=>'Low','very-low'=> 'Very Low' ]

@endphp
<div class="container">
    <div class="buttons-row m-t-10 m-b-30">
        <h3 class="label-title text-transform-normal min-width">Fund View</h3>
        <a href="{{url('fund/add')}}" class="btn btn-secondary sm text-transform-normal" title="Add Your Fund">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.585 0.674805C5.06496 0.674805 0.584961 5.1548 0.584961 10.6748C0.584961 16.1948 5.06496 20.6748 10.585 20.6748C16.105 20.6748 20.585 16.1948 20.585 10.6748C20.585 5.1548 16.105 0.674805 10.585 0.674805ZM15.585 11.6748H11.585V15.6748H9.58496V11.6748H5.58496V9.6748H9.58496V5.6748H11.585V9.6748H15.585V11.6748Z" fill="white"/>
            </svg> Add Your Fund
        </a>
    </div>
    <div class="fund-desc-box ">
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
                        <p class="text-color-primary">{{$fund->companydetail->company_name ?? 'N/A'}}</p>
                    </td>
                    <td>
                        <p class="label">Fund Coutry</p>
                        <p class="text-color-primary">{{$fund->fund_country ?? 'N/A'}}</p>
                    </td>
                    {{-- <td>
                        <p class="label">Fund City </p>
                        <p class="text-color-primary">{{$fund->fund_city ?? ''}}</p>
                    </td> --}}
                    <td>
                        <p class="label">Asset Class</p>
                        <p class="text-color-primary">{{$asset_class[$fund->asset_class] ?? 'N/A'}}</p>
                    </td>
                    <td>
                        <p class="label">Fund Investor Risk</p>
                        <p class="text-color-primary">{{!empty($invester_risk[$fund->investor_risk]) ? $invester_risk[$fund->investor_risk] : ($fund->investor_risk ?? '')}}</p>
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
                        <p class="text-color-primary">{{!empty($fund->type_of_fund) ? $fund->type_of_fund : 'N/A'}}</p>
                    </td>
                    <td>
                        <p class="label">Total Expense Ratio (TER)</p>
                        <p class="text-color-primary">@if (is_float($fund->fund_expense_ratio) || is_int($fund->fund_expense_ratio))
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
                        <p class="text-color-primary">{{number_format($fund->management_fee , 2) . '%' }}</p>
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
                        <p class="text-color-primary">{{ !empty($fund->fund_website) ? $fund->fund_website : 'N/A'}}</p>
                    </td>
                    {{-- <td>
                        <p class="label">Asset Class</p>
                        <p class="text-color-primary">{{$fund->asset_class ?? ''}}</p>
                    </td> --}}
                    <td>
                        <p class="label">Return 1y (Annualised)</p>
                        <p class="text-color-primary">{{$fund->return_1y ?? 'N/A'}}</p>
                    </td>
                </tr>

                <tr>
                    {{-- <td>
                        <p class="label">Return 1y</p>
                        <p class="text-color-primary">{{$fund->return_1y ?? ''}}</p>
                    </td> --}}
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
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="paging-buttons">
        <a href="{{url('/')}}" class="btn btn-primary sm" title="BACK">BACK</a>
    </div>
</div>
