<?php
    $flag = true;
    if (!empty($cat_details->category_id ))
        $route= route('category', ['slug' =>  $cat_details->breadcrumb ?? '']);
    elseif(!empty($cat_details->id))
        $route = route('tag', ['slug' =>  $cat_details->slug ?? '']);
    elseif(!empty($cat_details->loc_id))
        $route = route('location', ['slug' =>  $cat_details->short_title ?? '']);
        $data_type = ($type == 'c') ? 'category' : (($type == 't') ? 'tag' : 'location');
        $data_cat_id = ($type == 'c') ? $cat_details->category_id : (($type == 't') ? $cat_details->id : $cat_details->loc_id);
    ?>
    <div class="news-grid">
        <h1 class="page-title m-0">{{$title ?? 'All ' }}  {{(!empty($cat_details) && $title  =='Region: ') ? $cat_details->region : $cat_details->title}}</h1>
        <form class="funds-form" method="GET" action="{{$route }}" enctype="multipart/form-data">
            <div class="filter-search">
                @if(!empty($all_records))
                    <select class="selectpicker-clear" name="post_date" >
                        <option value="">Select Filter</option>
                            @for ($year = now()->year; $year >= now()->year - 10; $year--)
                                <option {{( request()->get('post_date') == $year ) ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                            @endfor
                    </select>
                    <button type="submit" class="btn btn-primary">
                        FILTER
                    </button>
                @endif
            </div>
        </form>
  </div>
    <div class="podcast-card">
        @if(!empty($cat_posts['postmapper']))
            @foreach ($cat_posts['postmapper'] as $post)
                @if(!empty($post['postdetail']))
                @php
                    $flag = false;
                @endphp
                    <div class="image black-border relative">
                        {{-- {!! $post['postdetail']['post_title'] ?? '' !!} --}}
                        <p class="newsletter-top-head">Volume 20, Issue 49</p>
                        <p class="newsletter-date">{{ \Carbon\Carbon::parse($post['postdetail']['post_date'])->format('d F, Y') }}</p>
                        <a href="#" title="download" class="label-icon">
                            <span>
                                <img src="{{asset('assets/images/icons/download-icon.svg')}}" alt="download icon">

                            </span>
                            DOWNLOAD
                        </a>
                        {{-- <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-'. $type . $data_cat_id . '-' . $post['postdetail']['post_id']]) }}" >
                            <img style="width: 194px;height: 324px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="download icon">
                        </a> --}}
                        <a href="{{ route('newsletterdetail', ['slug' => $post['postdetail']['post_id']]) }}" >
                            <img style="width: 194px;height: 324px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="download icon">
                        </a>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    @if($flag)
    <div class="d-flex"></div>
    <main class="search-results m-t-20 d-flex align-items-center justify-content-center text-center">
        <div>
            <h5 class="m-0">NOTHING FOUND.</h5>
            <p class="m-0 p-t-10 p-b-50">There doesn’t seem to be any results for your search. Please try using different keywords.</p>
        </div>
    </main>
    @endif

    <a href="#" class="btn btn-secondary w-100 sm m-t-40 text-transform-normal" title="More News" >Back To Top</a>
