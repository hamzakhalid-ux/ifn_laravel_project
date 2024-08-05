@if($type == 'normal')
    <form class="article-search m-b-25">
    <a href="{{url('advancefilter')}}" class="btn btn-search w-100" title="Advanced Search">
        <img src="{{asset('assets/images/icons/search-icon.svg')}}" alt="search">
        Advanced Search
    </a>
    <div class="search-box d-block m-0">
        <div class="relative">
            <input type="text" id="searchInput" value="{{ $slug ?? ''}}"  class="input" placeholder="Article Search">
            <span class="icon">
                <img id="searchImage" src="{{asset('assets/images/icons/search-icon-gray.svg')}}" alt="search">
            </span>
        </div>
    </div>
    </form>
@else
    <h1 class="m-b-25" >Advanced Search </h1>
    {{-- @if($errors->has('keyword_1')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('keyword_1')}}</span> @endif --}}

    <form class="funds-form m-b-45" method="POST" action="{{url('advancefilter') }}">
        @csrf
        <div class="flex-row">
            {{-- <div class="col-3">
                <div class="form-group">
                    <select class="selectpicker" id="" name="tag_title" data-placeholder="Tag Name">
                        <option value="">Select Tag</option>
                        @foreach ($all_tags as $item)
                            <option {{ ((!empty($filter['tag_title'])) && $filter['tag_title'] == $item->title) ? 'selected' : '' }} value="{{ $item->title }}">
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </select>
                    <label>TAG</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="selectpicker" id="" name="category_title" data-placeholder="Category Name">
                        <option value="">Select Category</option>
                        @foreach ($all_cats as $item)
                            <option {{ ((!empty($filter['category_title'])) && $filter['category_title'] == $item->title) ? 'selected' : '' }} value="{{ $item->title }}">
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </select>
                    <label>CATEGORY</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="post_title" value="{{$filter['post_title'] ?? ''}}" placeholder="Post Name" />
                    <label>POST TITLE</label>
                </div>
            </div> --}}
            {{-- @dd($filter ?? '') --}}
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword_1" value="{{$filter['keyword_1'] ?? ''}}" placeholder="Keyword 1" />
                    <label>KEYWORD 1</label>

                </div>
            </div><div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword_2" value="{{$filter['keyword_2'] ?? ''}}" placeholder="Keyword 2" />
                    <label>KEYWORD 2</label>
                    @if($errors->has('keyword_2')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('keyword_2')}}</span> @endif

                </div>
            </div><div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword_3" value="{{$filter['keyword_3'] ?? ''}}" placeholder="Keyword 3" />
                    <label>KEYWORD 3</label>
                    @if($errors->has('keyword_3')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('keyword_3')}}</span> @endif

                </div>
            </div><div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword_4" value="{{$filter['keyword_4'] ?? ''}}" placeholder="Keyword 4" />
                    <label>KEYWORD 4</label>
                    @if($errors->has('keyword_4')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('keyword_4')}}</span> @endif

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select class="selectpicker" id=""  name="post_country">
                        <option  value="">Please Select country</option>
                        @if(!empty($all_countries))
                            @foreach($all_countries as $country)
                                <option {{((!empty($filter['post_country'])) && $filter['post_country'] == $country->iso ) ? 'selected' : '' }} value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label>Country</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select class="selectpicker" id=""  name="post_sector">
                        <option  value="">Please Select Sector</option>
                        @if(!empty($all_sector))
                            @foreach($all_sector as $sector)
                                    <option {{((!empty($filter['post_sector'])) && $filter['post_sector'] == $sector->sector ) ? 'selected' : '' }} value="{{$sector->sector}}">{{$sector->sector}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label>Sector</label>
                </div>
            </div>
            <div class="col-6">
                {{-- <div class="form-group">
                    <input type="datetime-local" name="from_date"  value="{{(!empty($filter['from_date'])) ? $filter['from_date'] : ''}}" class="form-control"  placeholder="From Date">
                    <label>From</label>
                </div> --}}
                <div class="flex-row">
                    <div class="col-6">
                        <div class="form-group">
                            <select class="selectpicker" id="from_date_month" name="from_date_month" data-placeholder="Month">
                                <option value="">select Month</option>
                                @for ($i = 0; $i < 12; $i++)
                                    @php
                                        $currentMonth = now()->subMonths($i);
                                        $formattedMonth = $currentMonth->format('m');
                                    @endphp
                                    <option {{ ((!empty($filter['from_date_month'])) && $filter['from_date_month'] == $formattedMonth) ? 'selected' : '' }} value="{{ $formattedMonth }}">
                                        {{ $currentMonth->format('F') }}
                                    </option>
                                @endfor
                            </select>
                            <label>From</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select class="selectpicker" id="from_date_year" name="from_date_year" data-placeholder="Year">
                                <option value="">Select Year</option>
                                @for ($year = now()->year; $year >= now()->year - 10; $year--)
                                    <option {{((!empty($filter['from_date_year'])) && $filter['from_date_year'] == $year ) ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                {{-- <div class="form-group">
                    <input type="datetime-local" name="to_date"  value="{{(!empty($filter['to_date'])) ? $filter['to_date'] : ''}}" class="form-control"  placeholder="To Date">
                    <label>To</label>
                </div> --}}
                <div class="flex-row">
                    <div class="col-6">
                        <div class="form-group">
                            <select class="selectpicker" id="to_date_month" name="to_date_month" data-placeholder="Month">
                                <option></option>
                                @for ($i = 0; $i < 12; $i++)
                                    @php
                                        $currentMonth = now()->subMonths($i);
                                        $formattedMonth = $currentMonth->format('m');
                                    @endphp
                                    <option {{ ((!empty($filter['to_date_month'])) && $filter['to_date_month'] == $formattedMonth) ? 'selected' : '' }} value="{{ $formattedMonth }}">
                                        {{ $currentMonth->format('F') }}
                                    </option>
                                @endfor
                            </select>
                            <label>To</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select class="selectpicker" id="to_date_year" name="to_date_year" data-placeholder="Year">
                                <option></option>
                                @for ($year = now()->year; $year >= now()->year - 10; $year--)
                                    <option {{((!empty($filter['to_date_year'])) && $filter['to_date_year'] == $year ) ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword" value="{{$filter['keyword'] ?? ''}}" placeholder="Keyword" />
                    <label>KEYWORD</label>
                    @if($errors->has('keyword')) <span class="" style="top: calc(100% + 5px);color: red;font-size: 12px; position: absolute;left: 18px;">{{$errors->first('keyword')}}</span> @endif

                </div>
            </div> --}}
        </div>
        <div class="paging-buttons p-0 p-t-15">
            <button class="btn btn-search allnewsbtn" type="submit">Search</button>
            <div class="btn btn-secondary allnewsbtn" id="reset_search_button">Reset</div>
        </div>
    </form>
    @if($errors->has('keyword_1'))
        <div style="text-align: center;">
            <h4 class="m-b-25" style="color: #800000 !important">Please complete the 'keyword 1' field before clicking the 'Search' button</h4>
        </div>
    @endif
@endif
    @if(!empty($cat_posts) && count($cat_posts) > 0)
        <div class="news-grid">

            <h2 class="m-b-10">Search Results for: {{(!empty($filter['keyword_1'])) ? '‘'.$filter['keyword_1'].'’' : ($slug ?? '')}} {{!empty($filter['keyword_2']) ? '‘'.$filter['keyword_2'].'’' : ''}} {{!empty($filter['keyword_3']) ? '‘'.$filter['keyword_3'].'’' : ''}} </h2>
            <p class="m-0 page-counter">Displaying {{ (!empty($cat_posts)) ? count($cat_posts) : 0 }} of {{ (!empty($cat_posts)) ? count($cat_posts) : 0 }}</p>
        </div>
    @endif
    <div class="search-list">
    @if(!empty($cat_posts) && count($cat_posts) > 0)
        @foreach ($cat_posts as $index => $post)
        <a href="{{ route('detail.show', ['slug' => Str::slug($post['post_title']) . '-c' . ($post['post_category'][0]['category_id'] ?? '') . '-' . $post['post_id']]) }}" >
            <div class="item">
                <div class="image">
                    <img src="{{ asset('post/' . $post['post_image']) }}" alt="search image" >
                </div>
                <div class="desc">
                    {{-- @php
                    $content = preg_replace('~^<p[^>]*>(.*)</p>$~s', '$1', $post['post_content']);
                    @endphp --}}
                    <span class="date">{{ \Carbon\Carbon::parse($post['post_date'])->format('d F, Y') }} | {{$post['post_tag'][0]['tagtitle']['title'] ?? 'Features'}}</span>
                    {{-- <p>{!! limitHtml($content, 100 , '...') !!}</p> --}}
                    <p>{{Illuminate\Support\Str::limit($post['post_title'], $limit = 100, $end = '...') ?? '' }}</p>
                </div>
            </div>
        </a>
        @endforeach
    @endif
</div>
@if((empty($cat_posts) || count($cat_posts) == 0) && $filter_status == false)
    <div class="d-flex"></div>
    <main class="search-results m-t-20 d-flex align-items-center justify-content-center text-center">
        <div>
            <h5 class="m-0">NOTHING FOUND.</h5>
            <p class="m-0 p-t-10 p-b-50">There doesn’t seem to be any results for your search. Please try using different keywords.</p>
        </div>
    </main>
@endif

@php
    function limitHtml($content, $limit = 100, $end = '...') {
    // Remove any existing HTML entities
    $content = html_entity_decode($content);

    // Remove any HTML tags to count only visible characters
    $visibleText = strip_tags($content);

    // Check if the visible text length is less than the limit
    if (mb_strlen($visibleText) <= $limit) {
        return $content; // Return the original content
    }

    // Truncate the visible text to the specified limit
    $truncatedText = mb_substr($visibleText, 0, $limit - mb_strlen($end)) . $end;

    // Find all HTML tags in the original content
    preg_match_all('/<[^>]+>(*SKIP)(*F)|./u', $content, $matches);

    // Concatenate the truncated text with the original HTML tags
    $truncatedContent = '';
    foreach ($matches[0] as $char) {
        // Append each character to the truncated content
        $truncatedContent .= $char;

        // Check if we have reached the end of the truncated text
        if (mb_strlen($truncatedContent) >= mb_strlen($truncatedText)) {
            break;
        }
    }

    return $truncatedContent;
}
@endphp
