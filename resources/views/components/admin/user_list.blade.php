<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Users</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($users))
                    @foreach($users as $index=>$user)
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(!empty($loginUserData->role) && in_array($loginUserData->role, [ 1, 2]))
                                    <a href="{{ route('admin.users.edit-privileges', ['user_id' => $user->user_id]) }}"><i class="fa fa-eye"></i>
                                    <a href="javascript:void(0)" class="deleteRecord" data-id="{{$user->user_id}}" used_at='user' data-route='delete_user'><i class="fa fa-trash" style="color:red"></i>
                                @endif
                                <a href="{{ route('admin.users.edit-user', ['user_id' => $user->user_id]) }}"><i class="fa fa-edit"></i>
                            </a></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
