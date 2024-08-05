<div class="login-container">
    <div class="login-header">
      <a href="#" title="IFN Dashboard">
        <img src="{{asset('./assets/images/IFN-logo.svg')}}" alt="logo" />
      </a>
    </div>
    <div class="sign-up-body">
        <form class="form-horizontal" method="POST" action="{{ url('storepersonaldetail') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="checkboxdata[package_id]" value="{{$deal->package_detail->package_id ?? ''}}">
            <input type="hidden" name="personaldetail" value="{{$personaldetail ?? ''}}">
            <div class="container selected-basic-plan">
                <div class="title-header m-t-0 m-b-30">
                <h2 class="lg m-t-70">{{$deal->package_detail->package_name ?? ''}} PLAN SELECTED</h2>
                <p>Feel free to decide what YOU want to receive from us!</p>
                </div>

                @if(!empty($deal->default_deals) && count($deal->default_deals) > 0)
                    @foreach ($deal->default_deals as $index=>$default_deal)
                        <div class="box">
                            <div>
                                <input type="checkbox" id="checkbox{{$index ?? ''}}" name="checkboxdata[checkbox][{{$default_deal->deal_id ?? ''}}]"/>
                            </div>
                            <div class="box-text">
                                <h6 class="m-0" for="checkbox{{$index ?? ''}}">{{$default_deal->deal_name ?? ''}}</h6>
                                <p class="m-0 p-t-10">
                                    {{$default_deal->deal_description ?? ''}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="plan-page-btns m-t-50 m-b-50">
                <a href="{{ url('signup') }}" class="btn btn-secondary" >
                    <svg class="m-r-10" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg" >
                    <path
                        d="M7.58879 10.9109L4.01129 7.33339H11.9996V5.66672H4.01129L7.58879 2.08922L6.41046 0.910889L0.821289 6.50006L6.41046 12.0892L7.58879 10.9109Z"
                        fill="#800000"
                    />
                    </svg>
                    Previous
                </a>
                    <button type="submit" class="btn btn-primary">
                        Next
                        <svg class="m-l-10" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg" >
                            <path d="M4.41083 10.9109L5.58917 12.0892L11.1783 6.50006L5.58917 0.910889L4.41083 2.08922L7.98833 5.66672H0V7.33339H7.98833L4.41083 10.9109Z"
                            fill="white" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
  </div>
