<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Pages</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>page</th>
                        <th>page Date</th>
                        <th>page Status</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($all_pages))
                    @foreach($all_pages as $index=>$page)
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$page['page_title']}}</td>
                            <td>{{$page['page_date']}}</td>
                            <td>{{strtoupper($page['page_status'])}}</td>
                            <td>
                                <a href="{{ route('admin.page.edit-page', ['page_id' => $page['page_id']]) }}"><i class="fa fa-edit"></i>
                                <a href="javascript:void(0)" class="deleteRecord" data-id="{{$page['page_id']}}" used_at='page' data-route='delete_page'><i class="fa fa-trash" style="color:red"></i>
                            </a></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
