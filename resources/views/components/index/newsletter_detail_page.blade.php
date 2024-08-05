<div class="news-grid">
    <h1 class="page-title m-0">Contents of Newsletter Volume 20, Issue 49</h1>
</div>
<div class="newsletter-cover-story">
    <div class="newsletter-image">
        <img style="width: 582px;height: 811px" src="{{ asset('post/' . $main_post->post_image) }}" alt="newsletter image">
    </div>
    <div class="cover-story-content">
        <div>
            <h3 class="label-title">
               {{$main_post->post_category[0]->categorytitle->title ?? ''}}
            </h3>
        </div>
        <div class="newsletter-quotes">
            “ {{$main_post->post_title}} ”
        </div>
        <div class="cover-story-text">
            {!! $main_post->post_content ?? '' !!}
        </div>
        <a href="#" class="btn btn-secondary sm text-transform-normal" title="What’s Happening?">What’s Happening?</a>
    </div>
</div>
<div class="main-highlights features m-t-40">
    <h3 class="label-title">
        {{ $main_highlights->title ?? ''}}
    </h3>
    <div class="feature-list m-t-40 m-b-40">

            @if(!empty($main_highlights->postmapper))
                @foreach ($main_highlights->postmapper as $post)

                    <div class="item">
                        <div class="image">
                            <img style="width: 200px;height:187.125px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="MAIN HIGHLIGHTS">
                        </div>
                        <div class="desc">
                            <h5>{!! Illuminate\Support\Str::limit($post['postdetail']['post_title'], $limit = 70, $end = '...') ?? ''!!}</h5>
                            <p class="m-b-0">{!! Illuminate\Support\Str::limit($post['postdetail']['post_content'], $limit = 100, $end = '...') ?? ''!!}</p>
                        </div>
                    </div>
                @endforeach
            @endif
    </div>
</div>
<div class="full-newsletter main-grid">
    <div>
        <div class="news-list">
                <div class="verical-between h-100">
                        <div class="inner">
                                <h3 class="label-title m-b-40">
                                    {{ $news_briefs->title ?? ''}}
                                </h3>
                                <ul class="unstyled-list">
                                    @if(!empty($news_briefs->postmapper))
                                        @foreach ($news_briefs->postmapper as $post)
                                            <li>
                                                <span class="icon">
                                                        <img src="{{asset('assets/images/icons/news-icon.svg')}}" alt="icon">
                                                </span>
                                                <span class="text">
                                                    {!! Illuminate\Support\Str::limit($post['postdetail']['post_title'], $limit = 70, $end = '...') ?? ''!!}
                                                </span>
                                            </li>

                                        @endforeach
                                    @endif
                                </ul>
                        </div>
                </div>
        </div>
    </div>
    <div>
        <div class="news-list">
                <div class="verical-between h-100">
                        <div class="inner">
                                <h3 class="label-title m-b-40">
                                    {{ $other_articles->title ?? ''}}

                                </h3>
                                <ul class="unstyled-list">
                                    @if(!empty($other_articles->postmapper))
                                        @foreach ($other_articles->postmapper as $post)
                                            <li>
                                                <span class="icon">
                                                        <img src="{{asset('assets/images/icons/news-icon.svg')}}" alt="icon">
                                                </span>
                                                <span class="text">
                                                    {!! Illuminate\Support\Str::limit($post['postdetail']['post_title'], $limit = 70, $end = '...') ?? ''!!}
                                                </span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                        </div>
                </div>
        </div>
    </div>
</div>
{{-- <a href="#" class="btn btn-secondary w-100 sm m-t-40 text-transform-normal" title="More News">Download Full Newsletter</a> --}}
