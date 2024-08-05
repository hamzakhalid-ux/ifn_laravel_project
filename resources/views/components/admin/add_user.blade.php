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
            {!! Form::label('role', 'Role', ['class' => 'form-label']) !!}
            {!! Form::select('role', $roles, '' , ['class' => 'form-control']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'passwordvalidate']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('retype_password', 'Retype Password', ['class' => 'form-label']) !!}
            {!! Form::password('retype_password', ['class' => 'form-control', 'id' => 'passwordvalidate']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('salutation', 'Salutation', ['class' => 'form-label']) !!}
            {!! Form::text('salutation', '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('company', 'Company Name', ['class' => 'form-label']) !!}
            {!! Form::text('company', '', ['class' => 'form-control']) !!}
        </div>
        <div class="mb-2 col-md-6">
            {!! Form::label('designation', 'Designation', ['class' => 'form-label']) !!}
            {!! Form::text('designation', '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('region', 'Region', ['class' => 'form-label']) !!}
            {!! Form::select('region', $uniqueRegions, '' , ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('city', 'City Name', ['class' => 'form-label']) !!}
            {!! Form::text('city', '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('country', 'country Name', ['class' => 'form-label']) !!}
            {!! Form::select('country', $all_countries->pluck('name', 'iso'), null, ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('phone_number', 'Phone Number', ['class' => 'form-label']) !!}
            {!! Form::text('phone_number', '', ['class' => 'form-control']) !!}
        </div>

        <div class="mb-2 col-md-6">
            {!! Form::label('direct_line', 'Direct line', ['class' => 'form-label']) !!}
            {!! Form::text('direct_line', '', ['class' => 'form-control']) !!}
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
            {!! Form::submit('Add User', ['class' => 'btn btn-primary mb-2']) !!}
        </div>

    </div>

</div>
{!! Form::close() !!}
