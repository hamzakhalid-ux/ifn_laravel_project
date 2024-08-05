
<div class="main-grid">
    <div class="col">
        <div class="partners">
            <h3 class="label-title">
                LAUNCH PARTNERS
            </h3>
            <ul class="unstyled-list">
                @if(!empty($admapper['partners_ad']))
                    @foreach ($admapper['partners_ad'] as $index=>$ads)
                        @if($index == 4)
                            @break
                        @endif
                        <li>
                            <a href="{{$ads['ad_link']}}" target="_blank">
                                <img style="height: 45px" src="{{ asset('ads_images/' . $ads['ad_image']) }}" alt="partner logo">
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="col">
        <div class="search-box-wrapper">
            <div class="search-box">
                <div>
                    <div class="relative">
                        <input type="text"  id="searchInput" class="input" placeholder="Article Search">
                        <span class="icon">
                            <img id="searchImage" src="{{asset('assets/images/icons/search-icon-gray.svg')}}" alt="search">
                        </span>
                    </div>
                    <a href="#" class="btn btn-search w-100" title="Advanced Search" onclick="window.location.href = '{{ url('advancefilter') }}';" >
                        <img src="{{asset('assets/images/icons/search-icon.svg')}}" alt="search">
                        Advanced Search
                    </a>
                </div>
                <div>
                    @if(!empty(session()->get('userData')) && session()->get('userData')->subscriber == 1 && !empty(session()->get('userData')->package_price_id ))
                        <a href="#" onclick="window.location.href = '{{ route('fund.list') }}';" class="btn btn-secondary w-100" title="Fund Database">Fund Database</a>
                        <a href="#" onclick="window.location.href = '{{ route('directory.list') }}';" class="btn btn-secondary w-100" title="Fund Directory">Fund Directory</a>
                    @elseif(!empty(session()->get('userData'))  && (empty(session()->get('userData')->package_price_id ) || session()->get('userData')->subscriber == 0))
                        <a href="#" class="btn btn-secondary w-100 notsubscriber" title="Fund Database">Fund Database</a>
                        <a href="#" class="btn btn-secondary w-100 notsubscriber" title="Fund Directory">Fund Directory</a>
                    @else
                        <a href="#" class="btn btn-secondary w-100 notlogin" title="Fund Database">Fund Database</a>
                        <a href="#" class="btn btn-secondary w-100 notlogin" title="Fund Directory">Fund Directory</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal-backdrop"></div>
<div class="modal" id="fund-submitted">
    <div class="modal-content text-center">
        <h2>You don't appear to be logged in!</h2>
        <p>Kindly do so for unlimited access to the world's best insights on islamic financel.</p>
        <div class="paging-buttons p-0">
            <a href="#" onclick="window.location.href = '{{url('/login')}}';" class="btn btn-secondary sm" title="CLOSE">Log in</a>
        </div>
    </div>
</div>

<div class="modal-backdrop"></div>
<div class="modal" id="login-notsubscriber">
    <div class="modal-content text-center">
        <h2>it apperas that you are not a subscriber!</h2>
        <p>Kindly Subscribe now for unlimited access to the world's best insights on islamic financel.</p>
        <div class="paging-buttons p-0">
            <a href="#" onclick="window.open('{{ route('signup') }}', '_self');" class="btn btn-secondary sm" title="CLOSE">Subscribe</a>
        </div>
    </div>
</div>
