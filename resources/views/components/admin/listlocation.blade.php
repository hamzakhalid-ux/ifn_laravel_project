<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Locations</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Parent Title</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($locations))
                    @foreach($locations as $index=>$location)
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$location['title']}}</td>
                            <td>{{$location['parent_title']}}</td>
                            <td>
                                <a href="{{ route('admin.location.edit-location', ['location_id' => $location['loc_id']]) }}"><i class="fa fa-edit"></i>
                                <a href="javascript:void(0)" class="deleteRecord" data-id="{{$location['loc_id']}}" used_at='location' data-route='delete_location'><i class="fa fa-trash" style="color:red"></i>
                            </a></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
