{{-- @dd($all_privs) --}}
@if(session()->has('messages'))
    <div class="alert alert-success">
        {{ session()->get('messages') }}
    </div>
@endif
@if (!empty(session()->has('errors')))
    <div class="alert alert-danger">
        <ul>
            @foreach (session()->get('errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(!empty($user[0]->package_id) && $user[0]->package_id == 1)
    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary updateplan"  data-toggle="modal" data-target="#updateplan" style="width: 150px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"  >Update</button>
        </div>
    </div>
@endif
{!! Form::open(['url' => '/admin/users/update-user', 'enctype' => 'multipart/form-data']) !!}
{!! Form::hidden('user_id', $user[0]->user_id, ['class' => 'form-control']) !!}
{{-- @dd($user) --}}

<div class="row">
    <div class="col-md-8">
        <div class="mb-2 col-md-6">
            {!! Form::label('first_name', 'First Name', ['class' => 'form-label']) !!}
            {!! Form::text('first_name', $user[0]->first_name, ['class' => 'form-control']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('last_name', 'Last Name', ['class' => 'form-label']) !!}
            {!! Form::text('last_name', $user[0]->last_name, ['class' => 'form-control']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
            {!! Form::email('email', $user[0]->email, ['class' => 'form-control','disabled' => 'disabled']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        {{-- <div class="mb-2 col-md-6">
            {!! Form::label('gender', 'Gender', ['class' => 'form-label']) !!}
            {!! Form::select('gender', ['male' => 'Male' , 'fe-male' => 'Fe-Male'], $user[0]->gender , ['class' => 'form-control']) !!}
        </div> --}}
        <div class="mb-2 col-md-6">
            {!! Form::label('salutation', 'Salutation', ['class' => 'form-label']) !!}
            {!! Form::text('salutation', $user[0]->user_details->salutation ?? '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('company', 'Company Name', ['class' => 'form-label']) !!}
            {!! Form::text('company', $user[0]->user_details->company ?? '', ['class' => 'form-control']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('designation', 'Designation', ['class' => 'form-label']) !!}
            {!! Form::text('designation', $user[0]->user_details->designation ?? '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('region', 'Region', ['class' => 'form-label']) !!}
            {!! Form::select('role', $uniqueRegions, $user[0]->user_details->region ?? '' , ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('city', 'City Name', ['class' => 'form-label']) !!}
            {!! Form::text('city',  $user[0]->user_details->city ?? '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('country', 'country Name', ['class' => 'form-label']) !!}
            {!! Form::select('country', $all_countries->pluck('name', 'iso'), $user[0]->user_details->country ?? '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('phone_number', 'Phone Number', ['class' => 'form-label']) !!}
            {!! Form::text('phone_number', $user[0]->user_details->phone_number ?? '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('direct_line', 'Direct line', ['class' => 'form-label']) !!}
            {!! Form::text('direct_line', $user[0]->user_details->direct_line ?? '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('role', 'Role', ['class' => 'form-label']) !!}
            {!! Form::select('role', $roles, $user[0]->role ?? '' , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group mb-2 col-md-6">
            {!! Form::label('images', 'Image:', ['class' => 'form-label']) !!}
            <div class="input-group col-sm-12">
                <span class="input-group-btn">
                    <span class="btn btn-default btn-file">
                        Browse&hellip; {!! Form::file('profile_image', ['id' => 'imageInput', 'accept' => 'image/jpeg,image/png']) !!}
                    </span>
                </span>
                {!! Form::text('selectedImages', null, ['id' => 'selectedImages', 'class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-6">
            {!! Form::submit('Update User', ['class' => 'btn btn-primary mb-2']) !!}
        </div>

    </div>

</div>
{!! Form::close() !!}


<div class="modal fade" id="updateplan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" >Update Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => '/admin/users/update-user-plan', 'enctype' => 'multipart/form-data']) !!}

            <div class="modal-body">
                <input type="hidden" value="{{ $user[0]->user_id}}" name='plan_user_id'>
                <input type="hidden" value="{{ $user[0]->package_id ?? ''}}" name='old_package_id'>
                <div class="form-group">
                    <label for="label">Select Plan Users:</label>
                    {{-- <input type="text" class="form-control" id="field_label" name="label" placeholder="Enter Label"> --}}
                    <select class="form-control" id="users_in_plan"  name="users_in_plan" >
                        @if(!empty($plan_list))
                            @foreach($plan_list as $plan)
                                <option class="planselected"value="{{$plan->id}}">{{$plan->number_of_subscriber+1}} Subscriber   {{$plan->currency}} {{$plan->price}} nett / year</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary">Save changes</button>

            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
