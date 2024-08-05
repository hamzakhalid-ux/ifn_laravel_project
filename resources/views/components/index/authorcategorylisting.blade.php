<div class="news-grid">
    <h1 class="page-title m-0">Author: {{$user_detail->first_name." ".$user_detail->last_name}}</h1>
  </div>
  <div class="news-cards">
    @if (!empty($post_details))
        @foreach ($post_details as $post)
            <div class="card">
              <a href="{{ route('detail.show', ['slug' => Str::slug($post['post_title']) . '-c'.  (!empty($post['post_category'][0]['category_id']) ? $post['post_category'][0]['category_id'] : ($post['post_tag'][0]['tag_id'] ?? '')) . '-' . $post['post_id']]) }}" >
                <div class="card-image">
                        <img style="width: 303px;height: 243px"
                        src="{{ asset('post/' . $post['post_image']) }}"
                        alt="all news images"
                        >
                    
                </div>
                <div class="card-body">
                    <h6 class="card-title">{{ \Carbon\Carbon::parse($post['post_date'])->format('d F, Y') }}</h6>
                    <p class="card-text">
                        {{ Illuminate\Support\Str::limit($post['post_title'], $limit = 25, $end = '...') ?? ''}}
                    </p>
                    <a href="{{ route('author', ['slug' =>  "author-".$post['user_id']]) }}" title="{{$post['userdetail']['first_name'] ?? '' }}">Author: {{$post['userdetail']['first_name'] . ' '.$post['userdetail']['last_name'] }}</a>
                </div>
              </a>
            </div>
        @endforeach
    @endif
  </div>
  <h3 class="label-title m-t-60">AUTHOR’S PROFILE</h3>
  <div class="feature-list m-t-30 m-b-40">
    <div class="item">
      <div class="image with-border">
        <img style="width: 299px;height:236.188px"
          src="{{ asset('user_profile/' . $user_detail->profile_image) }}"
          alt="user img"
        >
      </div>
      <div class="desc author-desc">
            <a href="#" class="edit-icon">
            <img
                src="{{asset('assets/images/Author-images/output-onlinepngtools (3) 2.png')}}"
                alt="text area icon"
            >
            </a>
            <h5>{{$user_detail->first_name." ".$user_detail->last_name}}</h5>
            <p class="m-b-10 m-t-20">
            Assistant Professor of Islamic Finance<br> and Associate Dean for
            Academic Affairs
            </p>
            <a href="#"> {{$user_detail->email ?? ''}}</a>
      </div>
    </div>
  </div>

