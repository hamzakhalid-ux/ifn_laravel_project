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
                        <th>Menu</th>
                        <th>Menu Slug</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($all_menus))
                    @foreach($all_menus as $index=>$menu)
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$menu['menu_title']}}</td>
                            <td>{{$menu['menu_slug']}}</td>
                            <td>
                                <a href="{{ route('admin.menu.edit-menu', ['menu_id' => $menu['menu_id']]) }}"><i class="fa fa-edit"></i>
                                <a href="javascript:void(0)" class="deleteRecord" data-id="{{$menu['menu_id']}}" used_at='menu' data-route='delete_menu'><i class="fa fa-trash" style="color:red"></i>
                            </a></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
