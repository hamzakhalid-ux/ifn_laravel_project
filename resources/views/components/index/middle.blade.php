<div class="main-grid">
    <div>
        <div class="reports m-b-45">
            <h3 class="label-title m-b-40">
                {{$setting['settingmappersession']['middle_left'][0]['settingcategory']['title'] ?? '' }}
            </h3>
            <div class="slider">
                @foreach($setting['settingmappersession']['middle_left'][0]['settingcategory']['postmapper'] as $post)
                    <div class="slide">
                        <div class="report-card">
                            <div class="image">
                                <img style="width: 307px;height: 280px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="reports">
                            </div>
                            <div class="desc">
                                <div class="inner">
                                    <h4> {{ $post['postdetail']['post_title'] ?? '' }}</h4>
                                    <p>{!! Illuminate\Support\Str::limit($post['postdetail']['post_content'], $limit = 50, $end = '...') ?? '' !!}</p>

                                </div>
                                <div class="slider-buttons">
                                    <div class="arrows">
                                        <button class="slick-prev">
                                            <img src="assets/images/icons/arrow-left.svg" alt="arrow left">
                                        </button>
                                        <button class="slick-next">
                                            <img src="assets/images/icons/arrow-right.svg" alt="arrow right">
                                        </button>
                                    </div>
                                    <a href="{{ route('category', ['slug' =>  $setting['settingmappersession']['middle_left'][0]['settingcategory']['breadcrumb'] ?? '']) }}" class="btn btn-secondary sm text-transform-normal" title="More Reports">More {{$setting['settingmappersession']['middle_left'][0]['settingcategory']['title'] ?? '' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="partners">
                <ul class="unstyled-list">
                    @if(!empty($admapper['report_ad']))
                        @foreach ($admapper['report_ad'] as $index=>$ads)
                            @if($index == 2)
                                @break
                            @endif
                            <li>
                                <a href="{{$ads['ad_link']}}" target="_blank">
                                    <img src="{{ asset('ads_images/' . $ads['ad_image']) }}" alt="partner logo">
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="reports">
            <h3 class="label-title m-b-35">
                {{$setting['settingmappersession']['middle_left'][1]['settingcategory']['title'] ?? '' }}

            </h3>
            <div class="slider">
                @if(!empty($setting['settingmappersession']['middle_left'][1]['settingcategory']['postmapper']))
                @foreach($setting['settingmappersession']['middle_left'][1]['settingcategory']['postmapper'] as $post)
                    <div class="slide">
                        <div class="report-card">
                            <div class="image">
                                <img style="width: 307px;height: 280px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="reports">
                            </div>
                            <div class="desc">
                                <div class="inner">
                                    <h4> {{ $post['postdetail']['post_title'] ?? '' }}</h4>
                                    <p>{!! Illuminate\Support\Str::limit(strip_tags($post['postdetail']['post_content']), $limit = 50, $end = '...') ?? '' !!}</p>
                                </div>
                                <div class="slider-buttons">
                                    <div class="arrows">
                                        <button class="slick-prev">
                                            <img src="assets/images/icons/arrow-left.svg" alt="arrow left">
                                        </button>
                                        <button class="slick-next">
                                            <img src="assets/images/icons/arrow-right.svg" alt="arrow right">
                                        </button>
                                    </div>
                                    <a href="{{ route('category', ['slug' =>  $setting['settingmappersession']['middle_left'][1]['settingcategory']['breadcrumb'] ?? '']) }}" class="btn btn-secondary sm text-transform-normal" title="More Reports">More  {{$setting['settingmappersession']['middle_left'][1]['settingcategory']['title'] ?? '' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div>
        <div class="news-list">
            <div class="verical-between h-100">
                @if(!empty($setting['settingmappersession']['middle_right']))
                    <div class="inner">
                        <h3 class="label-title m-b-40">
                            {{$setting['settingmappersession']['middle_right'][0]['settingcategory']['title'] ?? ''}}
                        </h3>
                        <ul class="unstyled-list">
                            @foreach ($setting['settingmappersession']['middle_right'] as $middle_setting)
                                @forelse($middle_setting['settingcategory']['postmapper'] as $index => $post)
                                    <li>
                                        <span class="icon">
                                            <img src="assets/images/icons/news-icon.svg" alt="icon">
                                        </span>
                                        <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-c' .$setting['settingmappersession']['middle_right'][0]['settingcategory']['category_id'] . '-' . $post['postdetail']['post_id']]) }}" >
                                        <span class="text">
                                            {{$post['postdetail']['post_title'] ?? ''}}
                                        </span>
                                        </a>
                                    </li>
                                @empty
                                    <p>No posts available</p>
                                @endforelse
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ route('category', ['slug' =>  $setting['settingmappersession']['middle_right'][0]['settingcategory']['breadcrumb'] ?? '']) }}" class="btn btn-secondary w-100 sm m-t-40 text-transform-normal" title="More News" >More News</a>
            </div>
        </div>
    </div>
</div>

