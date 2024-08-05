
<div class="news-grid">
    <h1 class="page-title m-0" style="font-size: 44px; line-height: 1.2">{!! $main_post->post_title !!}</h1>
</div>
<?php
    $data_type = ($type == 'c') ? 'category' : (($type == 't') ? 'tag' : 'location');
    $data_cat_id = ($type == 'c') ? $parent_details->category_id : (($type == 't') ? $parent_details->id : $parent_details->loc_id);
    ?>
<div class="news-sec">
    <div class="news">
        <p>{{ \Carbon\Carbon::parse($main_post->post_date)->format('d F, Y') }} | {{$main_post->userdetail->first_name. " " .$main_post->userdetail->last_name}} </p>
        <a href="#">{{$parent_details['title']}}</a>
        <img style="width: 825px;height: 443px" src="{{ asset('post/' . $main_post->post_image) }}" alt="flag image">
    </div>
    <div class="s-for-you news">
        <p>Suggested For You :</p>
        @if(!empty($parent_details['postmapper']))
            @foreach ($parent_details['postmapper'] as $key=>$post)
            @if($key==3)
                @break
            @endif
            {{-- <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) .  '-' . $type  . (!empty($parent_details['id']) ? $parent_details['id'] : $parent_details['category_id'])  . '-' . $post['postdetail']['post_id']]) }}" > --}}
                <h4>{!! Illuminate\Support\Str::limit($post['postdetail']['post_title'], $limit = 50, $end = '...') ?? ''!!}</h4>
                <span>
                    @if(isset($post['postdetail']['post_date']))
                        {{ \Carbon\Carbon::parse($post['postdetail']['post_date'])->format('d F, Y') }}
                    @endif
                </span><br>
            {{-- </a> --}}
            @endforeach
        @endif
    </div>
</div>
<p class="single-report-info">
    {{-- @dd($main_post->post_content) --}}
    {{(!empty($main_post->post_content)) ? strip_tags($main_post->post_content) : ''}}

</p>
    {{-- @dd($main_post->toArray()) --}}
<div class="print-sec">
    <div class="print-sec-left">
        <div class="Tags">
            @if(!empty($main_post->post_tag) && count($main_post->post_tag) > 0)
                <span>Tags: </span>
                <p>
                    @foreach ($main_post->post_tag as $tag_detail)
                        <a href="{{url('tag/'.$tag_detail->tagtitle->slug)}}">{{$tag_detail->tagtitle->title}}</a> ,
                    @endforeach
                </p>
            @endif
        </div>
        <div class="Countries">
            @if(!empty($main_post->post_location) && count($main_post->post_location) > 0)
                <span >Countries: </span>
                <p>
                    @foreach ($main_post->post_location as $tag_detail)
                        <a href="{{url('location/'.$tag_detail->loctitle->short_title)}}">{{$tag_detail->loctitle->title}}</a> ,
                    @endforeach
                </p>
            @endif
            {{-- <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat optio dolore, ut aperiam est eaque eum reprehenderit repudiandae corporis, laborum molestias, pariatur ducimus. Voluptate praesentium rerum consequuntur officia? Voluptas, illo!</p> --}}
        </div>
        <div class="Sectors">
            <span>Sectors: </span><p>
                @php
                    $displayedRegions = [];
                @endphp
            @foreach ($main_post->post_location as $tag_detail)
                @if (!in_array($tag_detail->loctitle->region, $displayedRegions))
                    <a href="{{url('region/'.$tag_detail->loctitle->region)}}">{{$tag_detail->loctitle->region}}</a> ,
                @php
                    $displayedRegions[] = $tag_detail->loctitle->region;
                @endphp
                @endif
            @endforeach
            </p>
        </div>
    </div>
    <div>
        {{-- <div class="share-icons m-b-40">
            <p class="m-0" >Share this: </p>
            <ul class="unstyled-list social-list">
                <li>
                        <a href="{{$main_post->linkdin_link}}" title="linkedin" >
                                <img src="{{asset('assets/images/icons/linkedin.svg')}}" alt="linkedin">
                        </a>
                </li>
                <li>
                        <a href="{{$main_post->instagram_link}}" title="instagram" >
                                <img src="{{asset('assets/images/icons/instagram.svg')}}" alt="instagram">
                        </a>
                </li>
                <li>
                        <a href="{{$main_post->facebook_link}}" title="facebook" >
                                <img src="{{asset('assets/images/icons/facebook.svg')}}" alt="facebook">
                        </a>
                </li>
                <li>
                        <a href="{{$main_post->twitter_link}}" title="twitter" >
                                <img src="{{asset('assets/images/icons/twitter.svg')}}" alt="twitter">
                        </a>
                </li>

            </ul>
        </div> --}}
        <div class="print-article"><p>Print this article: </p>
            <button  onclick="window.print()"><img src="{{asset('assets/images/print-icon.png')}}" alt="print icon"></button>
        </div>
    </div>
</div>

<h3 class="label-title m-b-50">
    SUGGESTED FOR YOU
</h3>
<div class="suggest-for-you news-cards">
    @if(!empty($parent_details['postmapper']))
        @foreach ($parent_details['postmapper'] as $key=>$post)
            @if($key==3)
                @break

            @endif
            <div class="card">
                <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-' . $type . (!empty($parent_details['id']) ? $parent_details['id'] : $parent_details['category_id']) . '-' . $post['postdetail']['post_id']]) }}" >
                <div class="card-image">
                    <img style="width: 411px; height: 330px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="all news images" />
                </div>
                <div class="card-body">
                    <h6 class="card-title">{{ \Carbon\Carbon::parse($main_post->post_date)->format('d F, Y') }} | <a href="{{url("/author/{$post['postdetail']['userdetail']['user_id']}")}}">{{$post['postdetail']['userdetail']['first_name']}} {{$post['postdetail']['userdetail']['last_name']}}</a></h6>
                    <p class="card-text m-b-5">
                        {!! Illuminate\Support\Str::limit($post['postdetail']['post_title'], $limit = 35, $end = '...') ?? ''!!}
                    </p>
                </div>
                </a>
            </div>
        @endforeach
    @endif
</div>
{{-- <div class="funds-form  comment-field m-t-60">
    <textarea class="form-control"  placeholder="palceholder...."></textarea>
    <label>Leave a comment:</label>
</div>
<div class="text-right">
    <a href="#" class="btn btn-secondary sm text-transform-normal" title="More IFN Events">Post Comment</a>
</div> --}}

<div class="paging-buttons p-b-0 p-t-40">
    <a
        href="{{ route($url, ['slug' =>  (!empty($parent_details['breadcrumb']) ? $parent_details['breadcrumb'] :( $parent_details['slug'] ?? $parent_details['short_title'])) ]) }}"
        class="btn btn-primary btn-sm text-transform-normal"
        title="Back To Top"
        >Full List Of All {{$parent_details['title'] ?? ''}}</a>
    <a
        href="{{ route('detail.show', ['slug' => Str::slug($parent_details['postmapper'][0]['postdetail']['post_title']) .  '-' . $type  . $data_cat_id  . '-' . $parent_details['postmapper'][0]['postdetail']['post_id']]) }}"
        class="btn btn-secondary btn-sm text-transform-normal"
        title="Load More"
        >Next Article</a>
</div>
