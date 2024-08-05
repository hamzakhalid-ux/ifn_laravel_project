<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Posts</h3>
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
                        <th>Post</th>
                        <th>Post Date</th>
                        <th>Post Last Update Upaate</th>
                        <th>Post Status</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($all_posts))
                    @foreach($all_posts as $index=>$post)
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$post['post_title']}}</td>
                            <td>{{$post['post_date']}}</td>
                            <td>{{$post['updated_at']}}</td>
                            <td>{{strtoupper($post['post_status'])}}</td>

                                <td>
                                    <a href="{{ route('admin.post.edit-post', ['post_id' => $post['post_id']]) }}"><i
                                            class="fa fa-edit"></i>
                                        <a href="javascript:void(0)" class="deleteRecord"
                                            data-id="{{ $post['post_id'] }}" used_at='post' data-route='delete_post'><i
                                                class="fa fa-trash" style="color:red"></i>
                                        </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (!empty($all_posts))
                {!! $all_posts->links() !!}
            @endif
        </div>
    </div>
</div>
