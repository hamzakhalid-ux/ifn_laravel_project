  <!-----ROUNDUP POSCASTS -->
<div class="main-grid m-t-40">
    @if(!empty($setting['settingmappersession']['bottom_left']))
        @foreach ($setting['settingmappersession']['bottom_left'] as $bottom_left)
            @if(count($bottom_left['settingcategory']['postmapper']) > 0)
                <div>
                    <h3 class="label-title m-b-40">
                        {{$bottom_left['settingcategory']['title'] ?? ''}}
                    </h3>
                    @foreach($bottom_left['settingcategory']['postmapper'] as $index => $post)
                        @if($index == 1)
                            @break;
                        @endif
                        <div class="podcast-card">
                            <div class="image relative">
                                {{-- <a href="#" title="mic" class="mic-icon">
                                    <img src="assets/images/icons/mic-icon.svg" alt="mic icon">
                                </a>
                                <a href="#" title="litsen" class="label-icon">
                                    <span>
                                        <img src="assets/images/icons/play-icon.svg" alt="mic icon">
                                    </span>
                                    LISTEN NOW
                                </a>
                                <img src="assets/images/pod-cast-img.png" alt="podcast"> --}}
                                @if ($post['postdetail']['post_type'] == 'podcast')
                                    <div id="buzzsprout-player-14054368">
                                        {!! $post['postdetail']['podcast'] !!}
                                    </div>
                                @else
                                    <img style="width: 282px; height: 419px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="podcast">
                                @endif
                            </div>
                            <div class="desc">
                                <div class="inner">
                                    <h5>{{ isset($post['postdetail']['post_date']) ?
                                        \Carbon\Carbon::parse($post['postdetail']['post_date'])->isoFormat('MMMM D - ') .
                                        \Carbon\Carbon::parse($post['postdetail']['post_date'])->addDays(5)->isoFormat('D, YYYY') :
                                        ''
                                    }}</h5>
                                    <p>{!! Illuminate\Support\Str::limit($post['postdetail']['post_content'], $limit = 250, $end = '...') ?? ''!!}</p>
                                </div>
                                <a href="{{ route('category', ['slug' =>  $bottom_left['settingcategory']['breadcrumb'] ?? '']) }}" class="btn btn-secondary sm w-100 text-transform-normal" title="More Roundups">More {{$bottom_left['settingcategory']['title'] ?? ''}}</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        @endforeach
    @endif
</div>
<div class="main-grid sponsors m-t-40">
    @if(!empty($admapper['section_4']))
        @foreach ($admapper['section_4'] as $index=>$ads)
            @if($index == 2)
                @break
            @endif
            <a href="{{$ads['ad_link']}}" target="_blank">
            <div class="image">
                <img style="width: 318px;height:79px" src="{{ asset('ads_images/' . $ads['ad_image']) }}" alt="ICIEC logo">
            </div>
            </a>
        @endforeach
    @endif
</div>

<div class="main-grid m-t-40">
    @if(!empty($setting['settingmappersession']['bottom_right']))
        @foreach ($setting['settingmappersession']['bottom_right'] as  $bottom_right)
            @foreach($bottom_right['settingcategory']['postmapper'] as $index => $post)
            @if($index == 1)
                @break;
            @endif
                @if(count($bottom_right['settingcategory']['postmapper']) > 0)

                    @if ($post['postdetail']['post_type'] == 'video')
                        <div class="verical-between videos">
                            <div class="inner">
                                <h3 class="label-title m-b-40">
                                    {{$bottom_right['settingcategory']['title'] ?? ''}}
                                </h3>
                                <div class="video-frame relative">
                                        {!! $post['postdetail']['videoName'] !!}
                                </div>
                            </div>
                            <a href="{{ route('category', ['slug' =>  $bottom_right['settingcategory']['breadcrumb'] ?? '']) }}" class="btn btn-secondary sm w-100 m-t-20 text-transform-normal" title="More IFN Videos">More IFN {{$bottom_right['settingcategory']['title'] ?? ''}}</a>
                        </div>
                    @else
                        <div>
                            <h3 class="label-title m-b-40">
                                {{$bottom_right['settingcategory']['title'] ?? ''}}
                            </h3>
                            <div class="podcast-card">
                                <div class="image black-border">
                                    <img style="width: 282px; height: 419px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="review">
                                </div>
                                <div class="desc">
                                    <div class="inner">
                                        <h5>{{ isset($post['postdetail']['post_date']) ?
                                            \Carbon\Carbon::parse($post['postdetail']['post_date'])->isoFormat('MMMM D - ') .
                                            \Carbon\Carbon::parse($post['postdetail']['post_date'])->addDays(5)->isoFormat('D, YYYY') :
                                            ''
                                        }}</h5>
                                        <p>{!! Illuminate\Support\Str::limit($post['postdetail']['post_content'], $limit = 250, $end = '...') ?? ''!!}</p>
                                    </div>
                                    <a href="{{ route('category', ['slug' =>  $bottom_right['settingcategory']['breadcrumb'] ?? '']) }}" class="btn btn-secondary sm w-100 text-transform-normal" title="More Reviews">More {{$bottom_right['settingcategory']['title'] ?? ''}}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        @endforeach
    @endif
</div>
