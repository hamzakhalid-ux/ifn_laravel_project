<header class="header-wrapper">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <img src="{{asset('assets/images/top-bar-logo.svg')}}" alt="logo" >
                    </a>
                </div>
                <ul class="unstyled-list">
                    @if(!empty($setting['topmenu1'][0]['menu_objects']))
                        @foreach ($setting['topmenu1'][0]['menu_objects'] as $menu_object)
                            @if ($menu_object['object_type'] == 'category')
                                <li><a href="{{ route('category', ['slug' =>  $menu_object['categorydata']['breadcrumb'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @elseif($menu_object['object_type'] == 'tag')
                                <li><a href="{{ route('tag', ['slug' =>  $menu_object['tagdata']['slug'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @elseif($menu_object['object_type'] == 'custom_links')
                                <li><a href="{{$menu_object['url'] ?? ''}}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>

                            @elseif($menu_object['object_type'] == 'location')
                                <li><a href="{{ route('location', ['slug' =>  $menu_object['locdata']['short_title'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @elseif($menu_object['object_type'] == 'region')
                                <li><a href="{{ route('region', ['slug' =>  $menu_object['object_title'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @elseif($menu_object['object_type'] == 'page')
                                <li><a href="{{ route('page', ['slug' =>  $menu_object['pagedata']['page_slug'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @else
                                <li><a href="#" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <img src="{{asset('assets/images/IFN-logo.svg')}}" alt="logo">
                    </a>
                </div>
                <div class="sponsor-logo">
                    @if(!empty($admapper['logo_ad']))
                        @foreach ($admapper['logo_ad'] as $index=>$ads)
                            @if($index == 1)
                                @break
                            @endif
                            <a href="{{$ads['ad_link']}}" target="_blank">
                                <img style="width: 310px;height: 77px" src="{{ asset('ads_images/' . $ads['ad_image']) }}" alt="ICIEC-logo">
                            </a>
                        @endforeach
                    @endif
                </div>
                <ul class="unstyled-list account-links">
                    @if(!empty(session()->get('userData')))
                        {{-- <li>
                            <a href="#" onclick="window.location.href = '{{url('/admin/logout')}}';" title="LOG IN">LOG OUT</a>
                        </li> --}}
                        {{-- @dd(session()->get('userData')) --}}
                        <li>
                            <div class="account-dropdown">
                                <div class="toggler">
                                    <span class="name">{{strtoupper(session()->get('userData')->first_name ?? 'Andrew')}}</span>
                                    <span class="icon">
                                        <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.96484 0.0858154C8.97594 0.0858154 8.00924 0.37906 7.18699 0.928467C6.36475 1.47787 5.72388 2.25877 5.34545 3.1724C4.96701 4.08603 4.86799 5.09136 5.06092 6.06127C5.25384 7.03117 5.73005 7.92209 6.42931 8.62135C7.12857 9.32061 8.01949 9.79682 8.98939 9.98974C9.9593 10.1827 10.9646 10.0837 11.8783 9.70521C12.7919 9.32678 13.5728 8.68591 14.1222 7.86367C14.6716 7.04142 14.9648 6.07472 14.9648 5.08582C14.9648 3.75973 14.4381 2.48796 13.5004 1.55028C12.5627 0.6126 11.2909 0.0858154 9.96484 0.0858154ZM9.96484 8.08582C9.3715 8.08582 8.79148 7.90987 8.29813 7.58022C7.80479 7.25058 7.42027 6.78204 7.1932 6.23387C6.96614 5.68569 6.90673 5.08249 7.02249 4.50054C7.13824 3.9186 7.42397 3.38405 7.84352 2.9645C8.26308 2.54494 8.79763 2.25922 9.37957 2.14346C9.96152 2.0277 10.5647 2.08711 11.1129 2.31418C11.6611 2.54124 12.1296 2.92576 12.4593 3.4191C12.7889 3.91245 12.9648 4.49247 12.9648 5.08582C12.9648 5.88146 12.6488 6.64453 12.0862 7.20714C11.5236 7.76975 10.7605 8.08582 9.96484 8.08582ZM18.9648 19.0858V18.0858C18.9648 16.2293 18.2273 14.4488 16.9146 13.1361C15.6018 11.8233 13.8214 11.0858 11.9648 11.0858H7.96484C6.10833 11.0858 4.32785 11.8233 3.0151 13.1361C1.70234 14.4488 0.964844 16.2293 0.964844 18.0858V19.0858H2.96484V18.0858C2.96484 16.7597 3.49163 15.488 4.42931 14.5503C5.36699 13.6126 6.63876 13.0858 7.96484 13.0858H11.9648C13.2909 13.0858 14.5627 13.6126 15.5004 14.5503C16.4381 15.488 16.9648 16.7597 16.9648 18.0858V19.0858H18.9648Z" fill="white"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="dropdown">
                                    <div class="head">
                                        Welcome {{strtoupper(session()->get('userData')->first_name ?? 'Andrew')}}!
                                    </div>
                                    <ul class="unstyled-list">
                                        <li>
                                            <a href="{{url('/subscription_detail')}}">Subscription</a>
                                        </li>
                                        @if(!empty(session()->get('userData')->package_id))
                                        <li>
                                            <a href="{{url('/subscription_profile')}}">Profile</a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{url('/admin/forgot-password')}}">Change Password</a>
                                        </li>
                                        <li>
                                            <a href="{{url('/subscriber-fund-request-list')}}">Fund Request</a>
                                        </li>
                                        <li>
                                            <a href="{{url('/admin/logout')}}" title="LOG IN">LOG OUT</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                    @else
                        <li>
                            <a href="#" onclick="window.location.href = '{{url('/login')}}';" title="LOG IN">LOG IN</a>
                        </li>
                    @endif
                        <li>
                               @if(!empty(session()->get('userData')) && session()->get('userData')->subscriber == 1 && session()->get('userData')->package_id == 2 && !empty($ifn_subscriber->status) && $ifn_subscriber->status == 1)
                               <a href="#" title="SUBSCRIBE" class="btn btn-secondary">
                                 SUBSCRIBED
                                </a>
                               @elseif(empty(session()->get('userData')))
                               <a href="#" title="SUBSCRIBE" onclick="window.open('{{ route('signup') }}', '_self');" class="btn btn-secondary">
                               SUBSCRIBE
                            </a>
                               @else
                               <a href="#" title="SUBSCRIBE" onclick="window.open('{{ route('signup') }}', '_self');" class="btn btn-secondary">
                                NON SUBSCRIBER
                            </a>
                               @endif

                        </li>
                </ul>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container">
            <ul class="unstyled-list">
                <li>
                    <a href="{{ url('author-listings') }}" class="left">{{strtoupper('IFN correspondants')}}</a>
                </li>
                @if(!empty($setting['topmenu2'][0]['menu_objects']))
                        @foreach ($setting['topmenu2'][0]['menu_objects'] as $menu_object)
                            @if ($menu_object['object_type'] == 'category')
                                <li><a href="{{ route('category', ['slug' =>  $menu_object['categorydata']['breadcrumb'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @elseif($menu_object['object_type'] == 'tag')
                                <li><a href="{{ route('tag', ['slug' =>  $menu_object['tagdata']['slug'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @elseif($menu_object['object_type'] == 'custom_links')
                                <li><a href="{{$menu_object['url'] ?? ''}}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>

                            @elseif($menu_object['object_type'] == 'location')
                                <li><a href="{{ route('location', ['slug' =>  $menu_object['locdata']['short_title'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>

                            @elseif($menu_object['object_type'] == 'region')
                                <li><a href="{{ route('region', ['slug' =>  $menu_object['object_title'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>

                            @elseif($menu_object['object_type'] == 'page')
                                <li><a href="{{ route('page', ['slug' =>  $menu_object['pagedata']['page_slug'] ?? '']) }}" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @else
                                <li><a href="#" class="left">
                                    {{ strtoupper($menu_object['object_title']) ?? '' }}
                                </a></li>
                            @endif
                        @endforeach
                    @endif
            </ul>
        </div>
    </nav>
</header>
