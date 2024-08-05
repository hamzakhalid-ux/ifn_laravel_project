<?php
    if (!empty($cat_details->category_id ))
        $route= route('category', ['slug' =>  $cat_details->breadcrumb ?? '']);
    elseif(!empty($cat_details->id))
        $route = route('tag', ['slug' =>  $cat_details->slug ?? '']);
    elseif(!empty($cat_details->loc_id))
        $route = route('location', ['slug' =>  $cat_details->short_title ?? '']);
    ?>

<h1 class="main-page-title m-b-25">{{$title ?? 'All ' }}  {{(!empty($cat_details) && $title  =='Region: ') ? $cat_details->region : $cat_details->title}}</h1>

<div class="release-list"  id="press_release">
    @if(!empty($cat_posts['postmapper']))
        @foreach ($cat_posts['postmapper'] as $post)
            @if(!empty($post['postdetail']))
            <div class="item">
                <div class="image">
                    <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-'. $type . (!empty($cat_details->id) ? $cat_details->id : $cat_details->category_id) . '-' . $post['postdetail']['post_id']]) }}" >
                        <img src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="press image">
                    </a>
                </div>
                <div class="desc verical-between h-100">
                    <span class="date">{{ \Carbon\Carbon::parse($post['postdetail']['post_date'])->format('d F, Y') }}</span>
                    <p>
                        <b>{{$post['postdetail']['post_title'] ?? ''}}</b>
                        {!! Illuminate\Support\Str::limit($post['postdetail']['post_content'], $limit = 200, $end = '...') ?? ''!!}
                    </p>
                </div>
            </div>
            @endif
        @endforeach
    @endif
    {{-- <div class="item">
        <div class="image">
            <img src="assets/images/events-img.png" alt="press image">
        </div>
        <div class="desc verical-between h-100">
            <span class="date">5 October, 2023</span>
            <p>
                <b>Islamic Finance news hosted the 5th ISFI, supported by Capital Markets Malaysia</b>
                The Islamic Sustainable Finance & Investment Forum (ISFI Forum), organized by IFN (Islamic Finance News), took place at the Securities Commission Malaysia on 3rd October 2023 and was supported by Capital Markets Malaysia ...
            </p>
        </div>
    </div> --}}
</div>
<div class="paging-buttons p-b-0">
    <?php
        $data_type = ($type == 'c') ? 'category' : (($type == 't') ? 'tag' : 'location');
        $data_cat_id = ($type == 'c') ? $cat_details->category_id : (($type == 't') ? $cat_details->id : $cat_details->loc_id);
        ?>
    <a href="#" class="btn btn-primary btn-sm text-transform-normal" title="Back To Top" >Back To Top</a>
    <a  id="loadmore-btn"
        current-count="{{ (!empty($cat_posts['postmapper'])) ? count($cat_posts['postmapper']) : 0 }}"
        total-count="{{$total_count ?? 0}}"
        data-template="{{$cat_posts['filtersetting']['template'] ?? ''}}"
        data-type="{{$data_type ?? ''}}"
        data-cat-id="{{$data_cat_id ?? ''}}"
        data-page="2"
        class="btn btn-secondary btn-sm text-transform-normal"
        title="Load More">Load More</a>
</div>
