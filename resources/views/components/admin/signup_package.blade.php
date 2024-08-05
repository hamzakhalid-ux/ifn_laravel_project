<div class="login-container">
    <div class="login-header">
      <a href="{{url('/')}}" title="IFN Dashboard">
        <img src="./assets/images/IFN-logo.svg" alt="logo" />
      </a>
    </div>
    <div class="sign-up-body">
      <div class="container">
        <div class="title-header">
          <h2 class="lg">GAIN EXCLUSIVE ACCESS NOW!</h2>
          <a href="{{url('/')}}" class="btn btn-secondary">
            <svg
              class="m-r-10"
              width="12"
              height="13"
              viewBox="0 0 12 13"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M7.58879 10.9109L4.01129 7.33339H11.9996V5.66672H4.01129L7.58879 2.08922L6.41046 0.910889L0.821289 6.50006L6.41046 12.0892L7.58879 10.9109Z"
                fill="#800000"
              />
            </svg>
            BACK TO HOME
          </a>
        </div>
        <div class="sec-basic-premium">
          <div class="sec-basic relative" {{(!empty(session()->get('userData')->package_id)  && (session()->get('userData')->package_id == 1) ? "style=border:none" : '')}} >
            @if ( (!empty(session()->get('userData')->package_id)  && (session()->get('userData')->package_id != 1)) || empty(session()->get('userData')) )
            <div class="fixed-sec">
              <img
                src="./assets/images/icons/Featured icon.png"
                alt="featured icon"
                width="40"
                height="40"
              />
              <h5>{{strtoupper($all_packages[0]['package_name']) ?? ''}}</h5>
              <p>{{$all_packages[0]['package_description'] ?? ''}}</p>
            </div>
            <ul class="unstyled-list">
                @if(!empty($all_packages[0]->default_deals) && count($all_packages[0]->default_deals) > 0)
                    @foreach ($all_packages[0]->default_deals as $default_deal)
                        <li>
                            <span class="icon">
                                <img src="{{asset('assets/images/icons/news-icon.svg')}}" alt="icon">
                            </span>
                            <span class="text"> {{$default_deal->deal_name ?? ''}} </span>
                      </li>
                    @endforeach
                @endif
            </ul>
            <button
              type="button"
              class="btn btn-primary sm m-t-20"
              data-targer="#fund-submitted"
              title="Submit"
              onclick="window.location.href = '{{ route('packagedetails' , ['package_id' => $all_packages[0]->package_id]) }}';"
            >
              REGISTER ME
            </button>
            @endif
          </div>

          <div class="sec-premium relative">
            <div class="fixed-sec fixed-sec-premium">
              <img
                src="./assets/images/icons/Featured icon.png"
                alt="featured icon"
                width="40"
                height="40"
              />
              <h5>{{strtoupper($all_packages[1]['package_name']) ?? ''}}</h5>
              <p>{{$all_packages[1]['package_description'] ?? ''}}</p>
            </div>
            <ul class="unstyled-list">
                @if(!empty($all_packages[1]->default_deals) && count($all_packages[1]->default_deals) > 0)
                    @foreach ($all_packages[1]->default_deals as $default_deal)
                        <li>
                            <span class="icon">
                                <img src="{{asset('assets/images/icons/news-icon.svg')}}" alt="icon">
                            </span>
                            <span class="text"> {{$default_deal->deal_name ?? ''}} </span>
                      </li>
                    @endforeach
                @endif
            </ul>
            <button
              type="button"
              class="btn btn-primary sm m-t-20"
              data-targer="#fund-submitted"
              title="Submit"
              onclick="window.location.href = '{{ route('packagedetails' , ['package_id' => $all_packages[1]->package_id]) }}';"
            >
              REGISTER ME
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
