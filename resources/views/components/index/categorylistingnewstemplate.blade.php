
<div class="news-grid">
    <h1 class="page-title m-0">{{$title ?? 'All ' }}  {{(!empty($cat_details) && $title  =='Region: ') ? $cat_details->region : $cat_details->title}}</h1>
    <p class="m-0 page-counter">Displaying {{ (!empty($current_post_count)) ? $current_post_count : 0 }} of {{$current_post_count ?? 0}}</p>
</div>
<?php
    $flag = true;
    $data_type = ($type == 'c') ? 'category' : (($type == 't') ? 'tag' : 'location');
    $data_cat_id = ($type == 'c') ? $cat_details->category_id : (($type == 't') ? $cat_details->id : $cat_details->loc_id);
    ?>
<div class="news-cards filter-hights" id="press_release">
    {{-- @dd('d',!empty($cat_posts['postmapper']),count($cat_posts['postmapper'])) --}}
    @if(!empty($cat_posts['postmapper']))
        @foreach ($cat_posts['postmapper'] as $index=>$post)
            @if(!empty($post['postdetail']))
            @php
                $flag = false;
                $post_user_id = $post['postdetail']['userdetail']['user_id'];
            @endphp
                <div class="card">
                    <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-'. $type .$data_cat_id . '-' . $post['postdetail']['post_id']]) }}" >
                    <div class="card-image">
                            <img style="width: 303px;height: 243px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}"  alt="all news images" >
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">{{ \Carbon\Carbon::parse($post['postdetail']['post_date'])->format('d F, Y') }} | <a href="{{url("/author/$post_user_id")}}">{{$post['postdetail']['userdetail']['first_name']}} {{$post['postdetail']['userdetail']['last_name']}}</a> </h6>
                        <p class="card-text" title="{{$post['postdetail']['post_title'] ?? ''}}">
                            {{ Illuminate\Support\Str::limit($post['postdetail']['post_title'], $limit = 25, $end = '...') ?? ''}}
                        </p>
                            <a href="{{ ($type == 'c') ?  route('tag', ['slug' =>  $post['postdetail']['post_tag'][0]['tagtitle']['slug'] ?? '']) : route('category', ['slug' =>  $post['postdetail']['post_category'][0]['categorytitle']['breadcrumb'] ?? '']) }}" title="{{$post['postdetail']['userdetail']['first_name'] ?? '' }}">
                                 {{($type == 'c') ?  ($post['postdetail']['post_tag'][0]['tagtitle']['title'] ?? '') : ($post['postdetail']['post_category'][0]['categorytitle']['title'] ?? '') }}
                                </a>
                    </div>
                    </a>
                </div>
            @endif
        @endforeach
    @endif
    @if($flag)
    <div class="d-flex"></div>
    <main class="search-results m-t-20 d-flex align-items-center justify-content-center text-center">
        <div>
            <h5 class="m-0">NOTHING FOUND.</h5>
            <p class="m-0 p-t-10 p-b-50">There doesn’t seem to be any results for your search. Please try using different keywords.</p>
        </div>
    </main>
    @endif
    @if(!empty($allcategories) && !empty($cat_details['filtersetting']) && $cat_details['filtersetting']['category'] == 1)
        <div class="category-filter">
            <h4 class="cat-title m-0">Filter By Category :</h4>
            <ul class="cat-body unstyled-list">
                @foreach ($allcategories as  $category)
                    <li  class ="catfilter {{(!empty($cat_details->category_id) && $cat_details->category_id ==  $category['category_id'] || $category['category_id'] == request('category')) ? 'active' : '' }}" data-id="{{$category['category_id'] ?? ''}}" >
                        <a href="{{ ($type == 'c') ?  route('category', ['slug' =>  $category['breadcrumb'] ?? '']) : Request::url().'?category='.$category['category_id'] }}" title="All News">
                        {{$category['title'] ?? ''}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(!empty($alltags) && !empty($cat_details['filtersetting']) && $cat_details['filtersetting']['category'] == 1)
        <div class="category-filter tag-filters">
            <h4 class="cat-title m-0">Filter By Tag :</h4>
            <ul class="cat-body unstyled-list">
                @foreach ($alltags as  $tag)
                    <li  class ="catfilter {{(!empty($cat_details->id) && $cat_details->id == $tag['id'] || $tag['id'] == request('tag')) ? 'active' : '' }}" data-id="{{$tag['id'] ?? ''}}" >
                        <a href="{{ ($type == 't') ? route('tag', ['slug' =>  $tag['slug'] ?? '']) :  (Request::url().'?tag='. $tag['id']) }}" title="All News">
                        {{$tag['title'] ?? ''}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="paging-buttons p-b-0">

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
