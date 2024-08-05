<div class="editos-pick">
    <div class="main-grid">
        <div></div>
        <div>
            <h3 class="label-title">
                {{$setting['settingmappersession']['slider_session'][0]['settingcategory']['title'] ?? ''}}
            </h3>
        </div>
    </div>
    <div class="slider editos-slider">
        @if (!empty($setting['settingmappersession']['slider_session']))
            @forelse($setting['settingmappersession']['slider_session'] as $item)
                @forelse($item['settingcategory']['postmapper'] as $index => $post)
                    @php
                        $postDetail = $post['postdetail'];
                    @endphp
                    <div class="main-grid slide">
                        <div class="image">
                            <img style="width: 595px; height: 479px" src="{{ asset('post/' . $postDetail['post_image']) }}" alt="editor image">
                        </div>
                        <div class="desc">
                        <a @if(!empty(session()->get('userData'))) href="{{ route('detail.show', ['slug' => Str::slug($postDetail['post_title']) . '-c' . $item['object_id'] . '-' . $postDetail['post_id']]) }}" @else herf="#"  @endif class="notlogin"> <h3>{!! $postDetail['post_title'] ?? 'Default Title' !!}</h3></a>
                            <p>{!! $postDetail['post_content'] ?? 'Default Content' !!}</p>
                            <div class="slider-buttons">
                                <div class="arrows">
                                    <button class="slick-prev">
                                        <img src="assets/images/icons/arrow-left.svg" alt="arrow left">
                                    </button>
                                    <button class="slick-next">
                                        <img src="assets/images/icons/arrow-right.svg" alt="arrow right">
                                    </button>
                                </div>
                                <a href="#" class="btn btn-secondary sm text-transform-normal" title="What’s Happening?">What’s Happening?</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No posts available</p>
                @endforelse
            @empty
                <p>No slider sessions available</p>
            @endforelse
        @endif
    </div>
</div>

