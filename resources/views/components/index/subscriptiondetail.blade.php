<div class="main-grid align-items-end m-b-40">
    <div class="col">
       <h1 class="main-page-title m-0">Subscription</h1>
    </div>
    <div class="col">
        <div class="search-box-wrapper">
            <div class="search-box">
                <div>
                    <div class="relative">
                        <input type="text"  id="searchInput" class="input" placeholder="Article Search">
                        <span class="icon">

                            <img id="searchImage" src="{{asset('assets/images/icons/search-icon-gray.svg')}}" alt="search">
                        </span>
                    </div>
                    <a href="#" class="btn btn-search w-100" title="Advanced Search" onclick="window.location.href = '{{ url('advancefilter') }}';" >
                        <img src="{{asset('assets/images/icons/search-icon.svg')}}" alt="search">
                        Advanced Search
                    </a>
                </div>
                <div>
                    <a href="#" onclick="window.location.href = '{{ route('fund.list') }}';" class="btn btn-secondary w-100" title="Fund Database">Fund Database</a>
                    <a href="#" onclick="window.location.href = '{{ route('directory.list') }}';" class="btn btn-secondary w-100" title="Fund Directory">Fund Directory</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="fund-desc-box">
        <table class="w-100">
            <tbody>
                <tr>
                    <td>
                        <div class="user-pro">
                            <div class="icon">{{ strtoupper(substr(session()->get('userData')->first_name, 0, 1)) . strtoupper(substr(session()->get('userData')->last_name, 0, 1))}}</div>
                            <div>
                                <p class="text-color-primary font-weight-600">{{session()->get('userData')->first_name . " " . session()->get('userData')->last_name}}</p>
                                @if(!empty($price->number_of_subscriber))
                                    <p class="">{{$price->number_of_subscriber ?? ''}} More Persons</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        <p>Premium Subscription</p>
                        <p class="text-color-primary">{{$price->currency ?? ''}} {{$price->price ?? 0}}</p>
                    </td>
                    <td>
                        @php
                        // dd($price);
                            $dateString = $price->created_at ?? null;
                            $dateTime = new DateTime($dateString);
                            $formattedDate = $dateTime->format('d F, Y');
                        @endphp
                        <p>Date:</p>
                        <p class="text-color-primary">{{$formattedDate}}</p>
                    </td>
                    <td>
                        <p>Status</p>
                        <span class="status-label approved">{{(session()->get('userData')->package_id == 1)?
                           'Basic plan' :
                        ($ifn_subscriber->status == 0 ? 'Pending': 'Confirmed')}}</span>
                    </td>
                </tr>
                @if ($ifn_subscriber->status == 0)
                <tr>
                    <td colspan="4" class="border-row">
                        @if(empty($ifn_subscriber->transaction_id) && $ifn_subscriber->package_id != 1)

                        <form class="funds-form trans-id" method="POST" action="{{ url('/store-transaction') }}" enctype="multipart/form-data">
                            @csrf
                            <label>Please enter your transaction ID:</label>
                            <input type="text" required name="transaction_id" class="form-control" placeholder="Transaction ID" >
                            <input type="hidden" name="user_id" class="form-control" value="{{$session_user->user_id ?? ''}}" >

                            <button type="submit" class="btn btn-primary sm text-transform-normal">Submit</button>
                        </form>
                        <br>
                        @elseif($ifn_subscriber->package_id == 1)
                        <h6 class="success-msg "></h6>
                        @elseif(session()->get('userData')->subscriber == 1 && session()->get('userData')->package_id == 2)
                        <h6 class="success-msg ">Transaction ID successfully submitted!</h6>
                        @endif
                    </td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>
    @if($ifn_subscriber->status == 1 && $creator->creator == 1 && !empty($price) && (count($ifn_subscriber_mapper) !== $price->number_of_subscriber))
        <h4>Please enter email details of other users: </h4>
        <div class="fund-desc-box p-b-35">
            <form class="funds-form" method="POST" action="{{ url('/store-child-users') }}" enctype="multipart/form-data">
                @csrf
                @php
                    $errors = session()->get('errors');
                    $message = !empty(session()->get('message')) ? session()->get('message') : '';
                    $message_class = !empty(session()->get('errors')) ? 'label-danger' : 'label-success';
                @endphp
                <div class="{{$message_class}} text-center">{{!empty(session()->get('message')) ? session()->get('message') : ''}}</div>
                @if(!empty($errors))
                <ul class="">
                    @foreach($errors as $error)
                    <li class="text-danger">{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                <div class="flex-row">
                    <input type="hidden" name="parent_user" value="{{$ifn_subscriber->user_id ?? ''}}">
                    @if(!empty($price->number_of_subscriber) && $price->number_of_subscriber>0)
                        @for ($i = 0; $i < $price->number_of_subscriber; $i++)
                            <div class="col-6">
                                <h6>User {{$i+1}}</h6>
                                <div class="form-group m-b-20">
                                    <input type="text" required name="emails[{{$i}}][email]" class="form-control" placeholder="Example@gmail.com">
                                    <label>Email</label>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
                {{-- <span class="error-msg d-block m-b-10 static">You have reached limit.</span> --}}
                <div class="paging-buttons p-0">
                    {{-- <a href="#" class="btn btn-secondary sm text-transform-normal" title="Add Other">Add Other</a> --}}
                    <button class="btn btn-primary sm text-transform-normal">Submit</button>
                </div>
            </form>
        </div>
    @endif
