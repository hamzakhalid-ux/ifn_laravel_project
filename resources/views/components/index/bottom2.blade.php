<div class="features m-t-40">
    <h3 class="label-title">
        {{$setting['settingmappersession']['correspondents_left'][0]['settingcategory']['title'] ?? ''}}
    </h3>
    <div class="feature-list m-t-40 m-b-40">
        @if(!empty($setting['settingmappersession']['correspondents_left']))
            @foreach($setting['settingmappersession']['correspondents_left'] as $key=>$correspondents)
                @forelse($correspondents['settingcategory']['postmapper'] as $index => $post)

                    @if ($index  == 4)
                        @break
                    @endif
                    <div class="item">
                        <div class="image with-border">
                            <img style="width: 202px;height: 190px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="user img">
                        </div>
                        <div class="desc">
                            <h5>{{ $post['postdetail']['post_title'] ?? '' }}</h5>
                            <p class="m-b-0">{!! $post['postdetail']['post_content'] ?? '' !!}</p>
                        </div>
                    </div>
                @empty
                    <p>No posts available</p>
                @endforelse
            @endforeach
        @endif
    </div>
    <a href="{{ route('category', ['slug' =>  $setting['settingmappersession']['correspondents_left'][0]['settingcategory']['breadcrumb'] ?? '']) }}" class="btn btn-secondary w-100 sm text-transform-normal" title="More Correspondent Reports">More {{$setting['settingmappersession']['correspondents_left'][0]['settingcategory']['title'] ?? ''}}</a>
</div>


