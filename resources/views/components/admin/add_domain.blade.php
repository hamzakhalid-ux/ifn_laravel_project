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


{!! Form::open(['url' => '/admin/domain/store-domain']) !!}
<div class="card-header">
    <h3 class="card-title">Add Domin</h3>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="mb-2 col-md-6">
            {!! Form::label('domain', 'Domain', ['class' => 'form-label']) !!}
            {!! Form::text('domain', '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::submit('Add Domain', ['class' => 'btn btn-primary mb-2']) !!}
    </div>

</div>
{!! Form::close() !!}
