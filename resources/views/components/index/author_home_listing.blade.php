    <div class="news-grid">
        <h1 class="page-title m-0">Investor Correspondents</h1>
    </div>
    <div class="sec-country-sector-corres sec-sector-corres">
        <div class="sec-country-corres">
            @if(!empty($author_users))
                @php $halfCount = ceil(count($author_users) / 2); @endphp
                @foreach ($author_users as $key => $user)
                    @if($key < $halfCount)
                        <div class="feature-list m-b-20">
                            <div class="item">
                                <div class="image with-border">
                                    <img style="width: 182px; height: 184px;" src="{{(!empty($user->profile_image)) ? asset('user_profile/' . $user->profile_image) : asset('assets/images/no-user.jpeg') }}" alt="user img" />
                                </div>
                                <div class="desc author-desc relative">
                                    <a href="{{url("/author/{$user->user_id}")}}" class="edit-icon">
                                        <img src="./assets/images/Author-images/output-onlinepngtools (3) 2.png" alt="text area icon" />
                                    </a>
                                    <h5>{{ $user->first_name . ' ' . $user->last_name}} </h5>
                                    <p class="">Author, {{$user->user_details->designation ?? 'N/A'}}</p>
                                    <a href="#" class="author-country" title="country">{{$user->user_details->loctitle->title ?? 'N/A'}}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="sec-sector-corres">
            @if(!empty($author_users))
                @php $halfCount = ceil(count($author_users) / 2); @endphp
                @foreach ($author_users as $key => $user)
                    @if($key >= $halfCount)
                        <div class="feature-list m-b-20">
                            <div class="item">
                                <div class="image with-border">
                                    <img style="width: 182px; height: 184px;" src="{{(!empty($user->profile_image)) ? asset('user_profile/' . $user->profile_image) : asset('assets/images/no-user.jpeg') }}" alt="user img" />
                                </div>
                                <div class="desc author-desc relative">
                                    <a href="{{url("/author/{$user->user_id}")}}" class="edit-icon">
                                        <img src="./assets/images/Author-images/output-onlinepngtools (3) 2.png" alt="text area icon" />
                                    </a>
                                    <h5>{{ $user->first_name . ' ' . $user->last_name}} </h5>
                                    <p class="">Author, {{$user->user_details->designation ?? 'N/A'}}</p>
                                    <a href="#" class="author-country" title="country">{{$user->user_details->loctitle->title ?? 'N/A'}}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    <h3 class="label-title m-t-40">FOR MORE INFORMATION</h3>
    <div class="investor-portal">
        <p class="m-t-20">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            <br /><br />
            <span class="author-name">John Deo</span><br />
            <span class="italic">Destination</span><br />
            <span>Tel: +603 - 2162 7800 (ext 34)</span><br />
            <span>Fax: +603 - 2162 7810</span><br />
            <span>Email: newperson@redmoneygroup.com</span>
        </p>
    </div>
