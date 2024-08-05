<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Subscribers</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Transaction Id</th>
                        <th>Payment Status</th>
                        <th>Package name</th>
                        <th>Package Amount</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($users))
                    @foreach($users as $index=>$user)
                    @php
                        $session_user = session()->get('userData');
                    @endphp
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$user->first_name ?? ''}}</td>
                            <td>{{$user->last_name ?? ''}}</td>
                            <td>{{$user->email ?? ''}}</td>
                            <td>{{$user->subscribe_package->transaction_id ?? 'NULL'}}</td>
                            <td>
                                @if(in_array($session_user->role, [1, 2]) && !empty($user->subscribe_package->id))
                                    <select class="form-control payment-status " data-user="{{$user->user_id ?? ''}}" data-id="{{ $user->subscribe_package->id ?? '' }}">
                                        <option value="0" {{ (!empty($user->subscribe_package->status) && $user->subscribe_package->status === 0) ? 'selected' : '' }}>PENDING</option>
                                        <option value="1" {{ (!empty($user->subscribe_package->status) && $user->subscribe_package->status === 1) ? 'selected' : '' }}>CONFIRMED</option>
                                    </select>
                                @elseif (empty($user->subscribe_package->id))
                                        Premium Package Not Selected
                                @else
                                    {{ (!empty($user->subscribe_package->status) && $user->subscribe_package->status == 0) ? 'PENDING' : 'CONFIRMED' }}
                                @endif

                            </td>
                            <td>{{$user->package_detail->package_name ?? ''}}</td>
                            <td>{{$user->subscribe_package_price->price ?? 0}}</td>
                            <td>
                                @if(!empty($loginUserData->role) && in_array($loginUserData->role, [ 1, 2]))
                                    <a href="{{ route('admin.users.edit-privileges', ['user_id' => $user->user_id]) }}"><i class="fa fa-eye"></i>
                                @endif
                                    <a href="javascript:void(0)" class="deleteRecord" data-id="{{$user->user_id}}" used_at='user' data-route='delete_user'><i class="fa fa-trash" style="color:red"></i>
                                    <a href="{{ route('admin.users.edit-user', ['user_id' => $user->user_id]) }}"><i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
