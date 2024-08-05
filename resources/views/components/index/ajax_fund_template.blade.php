
<input type="hidden" name="fund[{{$index}}][fund_company]" value="{{$company_id ?? ''}}">
<div class="content-box p-b-25 m-b-20">
    <div class="content-head m-b-40">
        <h5>Funds</h5>
        <a href="#" title="fact" class="view-file">
            <img src="{{asset('assets/images/icons/add-file-icon.svg')}}" alt="add file">fact SHEET</a>
        </a>
    </div>
    <div class="flex-row">
        <div class="col-6">
            <div class="form-group ">
                <input type="text" class="form-control" name="fund[{{$index}}][fund_name]" placeholder="Management" value="{{$fund->fund_name ?? ''}}" required>
                <label>Fund Name</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <select class="selectpicker" class="form-control" name="fund[{{$index}}][fund_country]">
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
                <input type="text" class="form-control" name="fund[{{$index}}][fund_city]" value="{{$fund->fund_city ?? ''}}" placeholder="Risk Profile" >
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
                <input type="number" class="form-control" placeholder="Management Fee" step="any" min="0" max="100" name="fund[{{$index}}][management_fee]" value="{{$fund->management_fee ?? ''}}">
                <label>Management Fee</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <input type="number" class="form-control" placeholder="Entry Fee" step="any" min="0" max="100" name="fund[{{$index}}][entry_fee]" value="{{$fund->entry_fee ?? ''}}">
                <label>Entry Fee</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <input type="number" class="form-control" placeholder="Exit Fee" step="any" min="0" max="100" name="fund[{{$index}}][exit_fee]" value="{{$fund->exit_fee ?? ''}}">
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
                <select class="selectpicker"  id=""  name="fund[{{$index}}][open_closed]">
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
                <input type="text" class="form-control" placeholder="Returns 3Y (Annualised) %" name="fund[{{$index}}][return_3y]" value="{{$fund->return_3y ?? ''}}">
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
