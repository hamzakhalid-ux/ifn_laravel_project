<footer>

    <div class="content">
        <div class="container">
            @if(!empty($setting['settingmappersession']['last_session']))
            <div class="form">
                <div class="main mt-40">
                    <!----Heading-->
                    <div class="inner-col">
                        <span class="button d-2 left">{{$setting['settingmappersession']['last_session'][0]['settingpost']['post_category'][0]['categorytitle']['title'] ?? ''}}</span>
                    </div>
                    <h2 class="h-1 mt-40 pr-40">{{$setting['settingmappersession']['last_session'][0]['settingpost']['post_title'] ?? '' }}</h2>
                    <p class="text-left mt-40 pr-60">{!! $setting['settingmappersession']['last_session'][0]['settingpost']['post_content'] ?? '' !!}
                    </p>
                </div>

                <div class="side">

                    @if(!empty($setting['settingmappersession']['last_session'][0]['settingpost']['postform']))
                    <form action="#">
                        @foreach ($setting['settingmappersession']['last_session'][0]['settingpost']['postform']['form_fields'] as $form_fields)
                        <div>
                            <input type="{{ $form_fields['field_type'] ?? ''}}" class="{{ $form_fields['field_class'] ?? ''}}" name="{{ $form_fields['field_name'] ?? ''}}" placeholder="{{strtoupper($form_fields['field_label']) }}">
                        </div>
                    @endforeach
                    <span class="button d-1 fw mt-20">Register Now!</span>

                    </form>
                    @endif

                </div>
            </div>
            @endif

            <div class="social">
                <div class="main">

                    <img src="assets/images/linkedin 2.png">
                    <img src="assets/images/instagram (1) 1.png">
                    <img src="assets/images/facebook (1) 1.png">
                    <img src="assets/images/twitter 2.png">




                </div>
            </div>

            <div class="footerlink">
                <div class="main">

                    <h2 class="h-2 mb-20">REDMONEY GROUP SDN BHD
                        <p class="text-left mt-30">1/68F, E-12B-2.1, Level 12B,
                            East Wing, The Icon,
                            Jalan Tun Razak, Taman U Thant,
                            50400 Kuala Lumpur,
                            Malaysia.
                        </p>

                </div>

                @if(!empty($setting['footermenu1'][0]['menu_objects']))
                @php

                    $menuObjects = $setting['footermenu1'][0]['menu_objects'];
                    $chunks = array_chunk($menuObjects, ceil(count($menuObjects) / 3));
                @endphp

                @foreach ($chunks as $chunk)

                <div class="centerli">

                    <ul>
                        @foreach ($chunk as $menuObject)
                        <li>{{ $menuObject['object_title'] ?? '' }}</li>
                    @endforeach
                    </ul>


                </div>


                    </ul>
                @endforeach
            @endif

                <div class="side">
                    <img src="assets/images/Group 28.png">
                </div>
            </div>

            <div class="copyright">
                <div class="main">


                    <p class="text-left mt-30">Privacy Policy
                    </p>

                </div>

                <div class="center">
                    <p class="text-center mt-30">All rights reserved. Copyright @ 2023 Islamic Finance News.
                    </p>

                </div>


                <div class="side">
                    <p class="text-right mt-30">Terms & Conditions
                    </p>

                </div>
            </div>

        </div>
    </div>
</footer>
