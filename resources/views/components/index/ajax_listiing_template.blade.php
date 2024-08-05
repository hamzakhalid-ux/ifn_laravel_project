

@if($data['template']== 'press_release')
    @if(!empty($data['cat_posts']['postmapper']))
        @foreach ($data['cat_posts']['postmapper'] as $post)
        <div class="item">
            <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-' . $data['type'] . $data['cat_id'] . '-' . $post['postdetail']['post_id']]) }}" >
                <div class="image">
                    <img src="{{ asset('post/' . $post['postdetail']['post_image']) }}" />
                </div>
            </a>
            <div class="desc verical-between h-100">
                <span class="date">{{ \Carbon\Carbon::parse($post['postdetail']['post_date'])->format('d F, Y') }}</span>
                <p>
                    <b>{{$post['postdetail']['post_title'] ?? ''}}</b>
                    {!! Illuminate\Support\Str::limit($post['postdetail']['post_content'], $limit = 200, $end = '...') ?? ''!!}
                </p>
            </div>
        </div>
        @endforeach
    @endif
@elseif ($data['template'] == 'news_template')
    @if(!empty($data['cat_posts']['postmapper']))
        @foreach ($data['cat_posts']['postmapper'] as $post)
            <div class="card">
                <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-' . $data['type'] . $data['cat_id'] . '-' . $post['postdetail']['post_id']]) }}" >
                    <div class="card-image">
                        <img class="img-responsive" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" />
                    </div>
                </a>
                <div class="card-body">
                    <h6 class="card-title">{{ \Carbon\Carbon::parse($post['postdetail']['post_date'])->format('d F, Y') }} | Author</h6>
                    <p class="card-text" title="{{$post['postdetail']['post_title'] ?? ''}}">
                        {{ Illuminate\Support\Str::limit($post['postdetail']['post_title'], $limit = 25, $end = '...') ?? ''}}
                    </p>
                    <a href="{{ route('author', ['slug' =>  'author-'.$post['postdetail']['user_id']]) }}" title="{{$post['postdetail']['userdetail']['first_name'] ?? '' }}">Author: {{$post['postdetail']['userdetail']['first_name'] . ' '.$post['postdetail']['userdetail']['last_name'] }}</a>
                </div>
            </div>
        @endforeach
    @endif
@elseif ($data['template'] == 'newsletter_template')
    @if(!empty($data['cat_posts']['postmapper']))
        @foreach ($data['cat_posts']['postmapper'] as $post)
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
            <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-' . $data['type'] . $data['cat_id'] . '-' . $post['postdetail']['post_id']]) }}" >
                <img style="width: 194px;height: 324px" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" alt="download icon">
            </a>
        </div>

        @endforeach
    @endif

@elseif ($data['template'] == 'default_template')

    @if(!empty($data['cat_posts']['postmapper']))
        @foreach ($data['cat_posts']['postmapper'] as $post)
        <div class="card">
            <div class="card-text">
                <h2 title="{{$post['postdetail']['post_title'] ?? ''}}">{!! $post['postdetail']['post_title'] ?? '' !!}</h2>
            </div>
            <div class="card-head">
                <h3>{{ \Carbon\Carbon::parse($post['postdetail']['post_date'])->format('d F, Y') }}</h2>
            </div>

            <div class="card-image">
                <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-' . $data['type'] . $data['cat_id'] . '-' . $post['postdetail']['post_id']]) }}" >
                    <img class="img-responsive" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" />
                </a>
                </div>

        </div>

        @endforeach
    @endif

@elseif ($data['template'] == 'blank_template')

    @if(!empty($data['cat_posts']['postmapper']))
        @foreach ($data['cat_posts']['postmapper'] as $post)
        <div class="card">
            <div class="card-text">
                <h2 title="{{$post['postdetail']['post_title'] ?? ''}}">{!! $post['postdetail']['post_title'] ?? '' !!}</h2>
            </div>
            <div class="card-head">
                <h3>{{ \Carbon\Carbon::parse($post['postdetail']['post_date'])->format('d F, Y') }}</h2>
            </div>

            <div class="card-image">
                <a href="{{ route('detail.show', ['slug' => Str::slug($post['postdetail']['post_title']) . '-' . $data['type'] . $data['cat_id'] . '-' . $post['postdetail']['post_id']]) }}" >
                    <img class="img-responsive" src="{{ asset('post/' . $post['postdetail']['post_image']) }}" />
                </a>
            </div>

        </div>

        @endforeach
    @endif
@endif
