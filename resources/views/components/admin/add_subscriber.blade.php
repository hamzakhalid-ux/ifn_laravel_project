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


{!! Form::open(['url' => '/admin/users/add-user', 'enctype' => 'multipart/form-data']) !!}
<div class="row">
    <div class="col-md-8">
        <div class="mb-2 col-md-6">
            {!! Form::label('first_name', 'First Name', ['class' => 'form-label']) !!}
            {!! Form::text('first_name', '', ['class' => 'form-control']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('last_name', 'Last Name', ['class' => 'form-label']) !!}
            {!! Form::text('last_name', '', ['class' => 'form-control']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
            {!! Form::email('email', '', ['class' => 'form-control']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'passwordvalidate']) !!}
            <div id="passwordValidationMessage"></div>

        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('retype_password', 'Retype Password', ['class' => 'form-label']) !!}
            {!! Form::password('retype_password', ['class' => 'form-control', 'id' => 'passwordvalidate']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('package_id', 'Package', ['class' => 'form-label']) !!}
            {!! Form::select('package_id', $dropdown_roles, 'male' , ['class' => 'form-control']) !!}
        </div>
            {!! Form::hidden('role', 6, ['class' => 'form-control']) !!}
            {!! Form::hidden('subscriber', 1, ['class' => 'form-control']) !!}


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
            {!! Form::submit('Add User', ['class' => 'btn btn-primary mb-2']) !!}
        </div>

    </div>

</div>
{!! Form::close() !!}
