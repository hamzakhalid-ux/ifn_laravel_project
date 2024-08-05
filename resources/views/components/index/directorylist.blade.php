<style>
    .char-filter li.hasrecord a {
        background-color: #80001e93;
        color: black;
    }
</style>
<div class="sort-head">
    <form class="funds-form" method="GET" action="{{ route('directory.list',['slug' => $slug]) }}" enctype="multipart/form-data">
        <div class="form-group m-0">
            <input type="text" name="company_name" value="{{request()->get('company_name')}}" class="form-control" placeholder="Company Name">
        </div>
        <div class="form-group m-0">
            <select class="selectpicker" name="company_region" data-placeholder="By Region">
                <option value="">By Region</option>
                @if(!empty($uniqueRegions))
                    @foreach($uniqueRegions as $region)
                        <option {{((!empty(request()->get('company_region'))) && request()->get('company_region') == $region ) ? 'selected' : '' }} value="{{$region}}">{{$region ?? ''}}</option>
                    @endforeach
                @endif
            </select>
            {{-- <input type="text" name="company_city" class="form-control" value="{{request()->get('company_city')}}" placeholder="By City"> --}}
        </div>

        <div class="form-group m-0">
            <select name="company_country" class="selectpicker">
                <option value="">By Country</option>
                @if(!empty($all_countries))
                    @foreach($all_countries as $country)
                        <option {{( request()->get('company_country') == $country->iso) ? 'selected' : '' }} value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                    @endforeach
                @endif
            </select>

        </div>
        <button type="submit" class="btn btn-secondary text-transform-normal sm">Search</button>
        <a href="{{url('/subscriber-fund-list')}}" class="btn btn-secondary text-transform-normal sm" title="Fund Database" >Fund Database</a>
    </form>

    <a href="{{url('/directory-list')}}" class="btn btn-secondary m-t-10">Reset</a>
</div>
<div class="buttons-row m-b-40">
    <h3 class="label-title text-transform-normal min-width">Fund Directory</h3>
    <ul class="unstyled-list char-filter">
        {{-- @dd($first_char_array ,in_array('P',$first_char_array)) --}}
        @for($i = 65; $i <= 90; $i++)
            <li  {{ chr($i) == strtoupper($slug) ? ' class=selected' : ((in_array(chr($i),$first_char_array)) ? ' ' : ' class=hasrecord') }}>
                <a href="{{ route('directory.list', ['slug' =>strtolower(chr($i))]) }}">{{ chr($i) }}</a>
            </li>
        @endfor
    </ul>

</div>
<div class="directories-list">
    {{-- @dd($ifn_companies->toArray()) --}}
    @if(!empty($ifn_companies) && count($ifn_companies->toArray()) > 0)
        @foreach ($ifn_companies as $company)
            <div class="item">
                <div class="profile">
                    <div class="image">
                        <img style="width: 111.997px;height: 51.996px" src="{{ asset('media/' . $company->company_logo) }}" alt="{{$company->company_name}}">
                    </div>
                    <div class="desc">
                        <p>
                            <a  href="{{ route('view.directory.detail', ['company_id' =>  $company->company_id]) }}" >{{$company->company_name}}</a>
                        </p>
                    </div>
                </div>
                <ul class="info unstyled-list">
                    <li>
                        Country:<span>
                            @if(!empty($all_countries))
                                @foreach($all_countries as $country)
                                    {{( $company->company_country == $country->iso) ? $country->name : '' }}
                                @endforeach
                            @endif
                            {{-- {{$company->company_country}} --}}
                        </span>
                    </li>
                    <li>
                        No. of funds:<span>{{count($company->funds)}}</span>
                    </li>
                </ul>
            </div>
        @endforeach
    @else
    <div class="d-flex"></div>
        <main class="search-results m-t-20 d-flex align-items-center justify-content-center text-center">
            <div>
                <h5 class="m-0">NOTHING FOUND.</h5>
                <p class="m-0 p-t-10 p-b-50">There doesn’t seem to be any results for your search. Please try using different keywords.</p>
            </div>
        </main>
    @endif

</div>

