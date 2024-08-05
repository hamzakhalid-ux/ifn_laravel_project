<div class="">
    <div class="card card-info">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">All Directories</h3>
                <div class="text-right">
                    <a href="{{ route('export.companies') }}" class="btn btn-success">Export</a>
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
                        <th>Comapny Name</th>
                        <th>Comapny Website </th>
                        <th>Company Phone</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($ifn_companies))
                        @foreach($ifn_companies as $index=>$company)
                            <tr>
                                <td>{{$index+1}}.</td>
                                <td>{{$company->company_name}}</td>
                                <td>{{$company->company_web}}</td>
                                <td>{{$company->company_phone}}</td>
                                <td>
                                    <a href="{{ route('admin.company.edit-company', ['company_id' => $company->company_id ]) }}"><i class="fa fa-edit"></i>
                                        <a href="javascript:void(0)" class="deleteRecord" data-id="{{$company->company_id}}" used_at='company' data-route = 'delete_company'><i class="fa fa-trash" style="color:red"></i>
                                    </a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
