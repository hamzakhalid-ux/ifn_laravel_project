<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Categories</h3>
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
                        <th>Category</th>
                        <th>Breadcrumb </th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($allcategories))
                        @foreach($allcategories as $index=>$category)
                            <tr>
                                <td>{{$index+1}}.</td>
                                <td>{{$category['title']}}</td>
                                <td>{{$category['breadcrumb']}}</td>

                                <td>
                                    <a href="{{ route('admin.edit-category', ['cat_id' => $category['category_id']]) }}"><i class="fa fa-edit"></i>
                                        <a href="javascript:void(0)" class="deleteRecord" data-id="{{$category['category_id']}}" used_at='category' data-route = 'delete_category'><i class="fa fa-trash" style="color:red"></i>
                                    </a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
