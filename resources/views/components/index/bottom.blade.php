<div class="features m-t-40">
    <h3 class="label-title">
        {{$setting['settingmappersession']['features_left'][0]['settingcategory']['title'] ?? ''}}
    </h3>
    <div class="feature-list m-t-40 m-b-40">
        @if(!empty($setting['settingmappersession']['features_left']))
                @foreach($setting['settingmappersession']['features_left'] as $key=>$correspondent)
                    @forelse($correspondent['settingcategory']['postmapper'] as $index => $post)
                        <div class="item">
                            <div class="image">
                                <img style="width: 202px;height: 190px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="feature">
                            </div>
                            <div class="desc">
                                <h5>{{ $post['postdetail']['post_title'] ?? '' }}</h5>
                                <p class="m-b-0"> {!! $post['postdetail']['post_content'] ?? '' !!}</p>
                            </div>
                        </div>
                    @empty
                        {{-- Handle the case when there are no posts --}}
                        <p>No posts available</p>
                    @endforelse
                @endforeach
            @endif
    </div>
    <a href="{{ route('category', ['slug' =>  $setting['settingmappersession']['features_left'][0]['settingcategory']['breadcrumb'] ?? '']) }}" class="btn btn-secondary w-100 sm text-transform-normal" title="More Features">More {{$setting['settingmappersession']['features_left'][0]['settingcategory']['title'] ?? ''}}</a>
</div>
