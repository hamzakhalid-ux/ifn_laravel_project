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


{!! Form::open(['url' => '/admin/domain/update-domain']) !!}
<div class="card-header">
    <h3 class="card-title">Update Domin</h3>
</div>
{!! Form::hidden('id', $domain['id'] ?? '' , ['class' => 'form-control']) !!}
<div class="row">
    <div class="col-md-8">
        <div class="mb-2 col-md-6">
            {!! Form::label('domain', 'Domain', ['class' => 'form-label']) !!}
            {!! Form::text('domain', $domain['domain'] ?? '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::submit('Update Domain', ['class' => 'btn btn-primary mb-2']) !!}
    </div>

</div>
{!! Form::close() !!}
