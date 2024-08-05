@php
    $fundTypes=['Digital','Endowment','ETF','Feeder','Growth','Income','Income + Growth','Index','Pension','REITs','Retirement']
@endphp
<div class="container">
    <div class="buttons-row m-t-10 m-b-30">
        <h3 class="label-title text-transform-normal min-width">Fund Request</h3>
        <a href="{{url('fund/add')}}" class="btn btn-secondary sm text-transform-normal" title="Add Your Fund">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.585 0.674805C5.06496 0.674805 0.584961 5.1548 0.584961 10.6748C0.584961 16.1948 5.06496 20.6748 10.585 20.6748C16.105 20.6748 20.585 16.1948 20.585 10.6748C20.585 5.1548 16.105 0.674805 10.585 0.674805ZM15.585 11.6748H11.585V15.6748H9.58496V11.6748H5.58496V9.6748H9.58496V5.6748H11.585V9.6748H15.585V11.6748Z" fill="white"/>
            </svg> Add Your Fund
        </a>
    </div>
    <div class="funds-view-list">
        @if(!empty($ifn_funds) && count($ifn_funds) > 0)
            @foreach ($ifn_funds as $fund)
                <div class="list-item">
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td>
                                    <p class="font-weight-600 gray-text">Fund Name</p>
                                    <p>{{$fund->fund_name ?? ''}}</p>
                                </td>
                                <td>
                                    <p>Email:</p>
                                    <p class="text-color-primary">{{$fund->contact_person_email ?? ''}}</p>
                                </td>
                                <td>
                                    <p>Status:</p>
                                    <p class="text-color-primary">{{strtoupper($fund->fund_status)}}</p>
                                </td>
                                {{-- <td>
                                    <p>Contact:</p>
                                    <p class="text-color-primary">{{$fund->contact_person_phone ?? ''}}</p>
                                </td> --}}
                                <td>
                                    <a href="{{url('/subscriber-fund-detail/'.$fund->fund_id)}}" class="view-file" title="view">
                                        <img src="assets/images/icons/file-view-icon.svg" alt="view file"> view
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ url('edit-subscriber-fund-detail', ['fund_id' =>  $fund->fund_id]) }}" class="view-file" title="Edit">
                                        <img src="{{asset('assets/images/icons/edit-icon.svg')}}" alt="Edit"> Edit
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        @else
            <h4>NO Record Found</h4>
        @endif
        {{-- <div class="list-item">
            <table class="w-100">
                <tbody>
                    <tr>
                        <td>
                            <p class="font-weight-600 gray-text">Fund Name</p>
                            <p>Company Name</p>
                        </td>
                        <td>
                            <p>Email:</p>
                            <p class="text-color-primary">example@gmail.com</p>
                        </td>
                        <td>
                            <p>Contact:</p>
                            <p class="text-color-primary">+09934898498</p>
                        </td>
                        <td>
                            <a href="#" class="view-file" title="view">
                                <img src="assets/images/icons/file-view-icon.svg" alt="view file"> view
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="list-item">
            <table class="w-100">
                <tbody>
                    <tr>
                        <td>
                            <p class="font-weight-600 gray-text">Fund Name</p>
                            <p>Company Name</p>
                        </td>
                        <td>
                            <p>Email:</p>
                            <p class="text-color-primary">example@gmail.com</p>
                        </td>
                        <td>
                            <p>Contact:</p>
                            <p class="text-color-primary">+09934898498</p>
                        </td>
                        <td>
                            <a href="#" class="view-file" title="view">
                                <img src="assets/images/icons/file-view-icon.svg" alt="view file"> view
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="list-item">
            <table class="w-100">
                <tbody>
                    <tr>
                        <td>
                            <p class="font-weight-600 gray-text">Fund Name</p>
                            <p>Company Name</p>
                        </td>
                        <td>
                            <p>Email:</p>
                            <p class="text-color-primary">example@gmail.com</p>
                        </td>
                        <td>
                            <p>Contact:</p>
                            <p class="text-color-primary">+09934898498</p>
                        </td>
                        <td>
                            <a href="#" class="view-file" title="view">
                                <img src="assets/images/icons/file-view-icon.svg" alt="view file"> view
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="list-item">
            <table class="w-100">
                <tbody>
                    <tr>
                        <td>
                            <p class="font-weight-600 gray-text">Fund Name</p>
                            <p>Company Name</p>
                        </td>
                        <td>
                            <p>Email:</p>
                            <p class="text-color-primary">example@gmail.com</p>
                        </td>
                        <td>
                            <p>Contact:</p>
                            <p class="text-color-primary">+09934898498</p>
                        </td>
                        <td>
                            <a href="#" class="view-file" title="view">
                                <img src="assets/images/icons/file-view-icon.svg" alt="view file"> view
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="list-item">
            <table class="w-100">
                <tbody>
                    <tr>
                        <td>
                            <p class="font-weight-600 gray-text">Fund Name</p>
                            <p>Company Name</p>
                        </td>
                        <td>
                            <p>Email:</p>
                            <p class="text-color-primary">example@gmail.com</p>
                        </td>
                        <td>
                            <p>Contact:</p>
                            <p class="text-color-primary">+09934898498</p>
                        </td>
                        <td>
                            <a href="#" class="view-file" title="view">
                                <img src="assets/images/icons/file-view-icon.svg" alt="view file"> view
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
    </div>
    <div class="paging-buttons">
        <a href="{{url('/')}}" class="btn btn-primary sm" title="BACK">BACK</a>
    </div>
</div>
