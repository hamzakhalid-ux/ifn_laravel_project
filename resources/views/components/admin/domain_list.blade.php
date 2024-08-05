<div class="card">
    <div class="card card-info">
        <div class="card-header">
            <div class="row">
                <h3 class="card-title " style="margin-left: 20px;">All Domains
                    <a href="{{ route('admin.domain.add-domain') }}" style="margin-right: 20px;" class="btn btn-primary pull-right">Add New Domain</a>
                </h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 40px">#</th>
                        <th style="width: 40px">Domain</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($domains))
                    @foreach($domains as $index=>$domain)
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$domain['domain']}}</td>
                            <td>
                                <a href="{{ route('admin.domain.edit-domain', ['domain_id' => $domain['id']]) }}"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
