<div class="">
    <div class="card card-info">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">All Funds</h3>
                <div class="text-right">
                    <a href="{{ route('export.funds') }}" class="btn btn-success">Export</a>
                </div>
            </div>
            <form action="{{ Request::url()}}" method="get">
                <div class="search-filter-new">
                    <input name="search_title" class="form-control  float-right" type="text" value="{{request()->get('search_title')}}" placeholder="search"> <button
                        class="btn btn-info button" type="submit">Search</button>
                </div>
            </form>
        </div>
        <?php
        $session_user = session()->get('userData');
        ?>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Fund Name</th>
                        <th>Country </th>
                        <th>Company </th>
                        <th>Added By</th>
                        <th>Requested By</th>
                        <th>Fact Sheet</th>
                        <th style="width: 200px;">Status </th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($ifn_funds))
                        @foreach($ifn_funds as $index=>$fund)
                            <tr>
                                <td>{{$fund->fund_id}}.</td>
                                <td>{{$fund->fund_name}}</td>
                                <td>{{$fund->loctitle->title ?? ''}}</td>
                                <td>{{$fund->companydetail->company_name}} ( {{$fund->companydetail->company_web}} )</td>
                                <td>{{ !empty($fund->userDetail) && ($fund->userDetail->role == 1 || $fund->userDetail->role == 2) ? $fund->userDetail->first_name . ' '. $fund->userDetail->last_name : ''}}</td>
                                <td>{{ !empty($fund->userDetail) &&  ($fund->userDetail->role > 2) ?  $fund->userDetail->first_name . ' '. $fund->userDetail->last_name : ''}}</td>
                                <td> {{(!empty($fund->attached_file) ? 'True' : 'False')}}</td>
                                <td >
                                    @if(in_array($session_user->role, [1, 2]))
                                        <select class="form-control fund-status " data-id="{{ $fund->fund_id }}">
                                            <option value="pending" {{ $fund->fund_status === 'pending' ? 'selected' : '' }}>PENDING</option>
                                            <option value="confirmed" {{ $fund->fund_status === 'confirmed' ? 'selected' : '' }}>CONFIRMED</option>
                                            <option value="cancelled" {{ $fund->fund_status === 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
                                        </select>
                                    @else
                                        {{ strtoupper($fund->fund_status) }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.fund.edit-fund', ['fund_id' => $fund->fund_id ]) }}"><i class="fa fa-edit"></i>
                                        <a href="javascript:void(0)" class="deleteRecord" data-id="{{$fund->fund_id}}" used_at='fund' data-route = 'delete_fund'><i class="fa fa-trash" style="color:red"></i>
                                    </a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
