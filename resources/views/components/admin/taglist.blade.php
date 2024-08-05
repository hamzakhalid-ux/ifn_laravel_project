<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Tags</h3>
            <form action="{{ Request::url()}}" method="get">
                <div class="search-filter-new">
                    <input name="search_title" class="form-control  float-right" type="text" value="{{request()->get('search_title')}}" placeholder="search"> <button
                        class="btn btn-info button" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Tag</th>
                        <th>Slug</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($alltags))
                        @foreach($alltags as $index=>$tag)
                            <tr>
                                <td>{{$index+1}}.</td>
                                <td>{{$tag['title']}}</td>
                                <td>{{$tag['slug']}}</td>

                                <td>
                                    <a href="{{ route('admin.edit-tag', ['tag_id' => $tag['id']]) }}"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0)" class="deleteRecord" data-id="{{$tag['id']}}" used_at='tag' data-route='delete_tag'><i class="fa fa-trash" style="color:red"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
