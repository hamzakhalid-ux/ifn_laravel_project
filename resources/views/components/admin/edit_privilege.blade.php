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
{!! Form::open(['url' => '/admin/users/update-user-privilege']) !!}
{!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
<div class="card-header">
    <h3 class="card-title">Privileges</h3>
</div>
<div class="row">
    @if(!empty($ifn_privileges))
        @foreach($ifn_privileges as $groupTitle => $privileges)
            <div class="panel panel-default">
                <div class="panel-heading">
                   <a> <h3 class="panel-title">{{ $groupTitle }}</h3></a>   
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($privileges as $privilege)
                            <div class="col-md-3">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('privilege[]', $privilege->priv_id, in_array($privilege->priv_id,array_column($user_prev->toArray(), 'priv_id')), ['class' => 'form-check-input']) !!}
                                        {{ $privilege->title }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="col-md-6">
        {!! Form::submit('Update User', ['class' => 'btn btn-primary mb-2']) !!}
    </div>
</div>
{!! Form::close() !!}
