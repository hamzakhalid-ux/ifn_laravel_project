<div class="footer-wrapper">
    <div class="container">
        {{-- @if(!empty($setting['settingmappersession']['last_session']) && empty($company)  && (!Str::contains(url()->current(), 'fund/add'))) --}}
            <div class="footer-form">
                <div class="desc">
                    <h3 class="label-title m-b-50">
                        IFN INVESRTOR REGISTRATION
                        {{-- {{$setting['settingmappersession']['last_session'][0]['settingpost']['post_category'][0]['categorytitle']['title'] ?? ''}} --}}
                    </h3>
                    <h4>
                        {{-- {{Illuminate\Support\Str::limit($setting['settingmappersession']['last_session'][0]['settingpost']['post_title'], $limit = 50, $end = '...') ?? '' }} --}}
                        Get The World’s Latest On Islamic Finance News!
                    </h4>
                    <p>
                        {{-- {!! Illuminate\Support\Str::limit($setting['settingmappersession']['last_session'][0]['settingpost']['post_content'], $limit = 100, $end = '...') ?? '' !!} --}}
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the dummy.
                    </p>

                </div>
                    <form class="form-horizontal" id=""  method="POST" action="{{ url('contect-us-form') }}"  enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <input type="test" class="form-control" name="f_name" placeholder="First Name">
                                @if($errors->has('f_name')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('f_name')}}</span> @endif
                            </div>
                            <div class="form-group">
                                <input type="test" class="form-control" name="l_name" placeholder="Last Name">
                                @if($errors->has('l_name')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('l_name')}}</span> @endif
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                @if($errors->has('email')) <span class="" style="color: red;font-size: 12px;" >{{$errors->first('email')}}</span> @endif
                            </div>
                            <div class="form-group">
                                <input type="test" class="form-control" name="company" placeholder="Company">
                                {{-- @if($errors->has('personaldetail.f_name')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('personaldetail.f_name')}}</span> @endif --}}
                            </div>
                            <div class="form-group">
                                <input type="test" class="form-control" name="designation" placeholder="Designation">
                            </div>
                        <button type="submit" class="btn btn-secondary sm text-transform-normal w-100">Register Now!</button>
                    </form>
            </div>
        {{-- @endif --}}
    </div>

    <footer>
        <div class="container">
            <ul class="unstyled-list social-list m-b-40">
                <li>
                    <a href="#" title="linkedin" >
                        <img src="{{asset('assets/images/icons/linkedin.svg')}}" alt="linkedin">
                    </a>
                </li>
                <li>
                    <a href="#" title="instagram" >
                        <img src="{{asset('assets/images/icons/instagram.svg')}}" alt="instagram">
                    </a>
                </li>
                <li>
                    <a href="#" title="facebook" >
                        <img src="{{asset('assets/images/icons/facebook.svg')}}" alt="facebook">
                    </a>
                </li>
                <li>
                    <a href="#" title="twitter" >
                        <img src="{{asset('assets/images/icons/twitter.svg')}}" alt="twitter">
                    </a>
                </li>
            </ul>
            <div class="text-right">
                @if(!empty(session()->get('userData')) && session()->get('userData')->subscriber == 1 && !empty(session()->get('userData')->package_id ))
                    <a href="#"  onclick="window.location.href = '{{ route('fund.add') }}';" class="btn btn-add">
                        <img src="{{asset('assets/images/icons/add-icon.svg')}}" alt="add icon">Add Your Fund
                    </a>
                @elseif(!empty(session()->get('userData')) && (empty(session()->get('userData')->package_id ) || session()->get('userData')->subscriber == 0))
                    <a href="#" class="btn btn-add notsubscriber">
                        <img src="{{asset('assets/images/icons/add-icon.svg')}}" alt="add icon">Add Your Fund
                    </a>
                @else
                    <a href="#" class="btn btn-add notlogin">
                        <img src="{{asset('assets/images/icons/add-icon.svg')}}" alt="add icon">Add Your Fund
                    </a>
                @endif
            </div>

            <div class="footer-info">
                <div class="address" >
                    <h6>REDMONEY GROUP SDN BHD</h6>
                    <p>1/68F, E-12B-2.1, Level 12B, <br>
                        East Wing, The Icon,<br>
                         Jalan Tun Razak, Taman U Thant,<br>
                        50400 Kuala Lumpur,<br>
                        Malaysia.</p>
                </div>
                <div class="list-wrapper">
                    @if(!empty($setting['footermenu1'][0]['menu_objects']))
                        <ul class="unstyled-list" >
                            @foreach ($setting['footermenu1'][0]['menu_objects'] as $menu_object)
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
                        </ul>
                    @endif
                    @if(!empty($setting['footermenu2'][0]['menu_objects']))
                        <ul class="unstyled-list" >
                            @foreach ($setting['footermenu2'][0]['menu_objects'] as $menu_object)
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
                        </ul>
                    @endif
                    @if(!empty($setting['footermenu3'][0]['menu_objects']))
                        <ul class="unstyled-list" >
                            @foreach ($setting['footermenu3'][0]['menu_objects'] as $menu_object)
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
                        </ul>
                    @endif
                </div>
                <div class="logo">
                    <a href="#" title="logo">
                        <img src="{{asset('assets/images/footer-logo.svg')}}" alt="footer logo">
                    </a>
                </div>
            </div>
            <div class="copyright">
                <a href="#" title="Privacy Policy">Privacy Policy</a>
                <span>All rights reserved. Copyright @ 2023 Islamic Finance News. </span>
                <a href="#" title="Terms & Conditions">Terms & Conditions</a>
            </div>
        </div>
    </footer>
    <span class="scroll-top">
        <img src="{{asset('assets/images/icons/scrollTop.svg')}}" alt="scroll top">
    </span>
</div>
