<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Funds</h3>
        </div>
        <?php
        $session_user = session()->get('userData');
        ?>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Package Name</th>
                        <th>Package Description </th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($all_packages))
                        @foreach($all_packages as $index=>$package)
                            <tr>
                                <td>{{$index+1}}.</td>
                                <td>{{$package->package_name}}</td>
                                <td>{{$package->package_description}}</td>
                                <td>
                                    <a href="{{ route('admin.package.edit-package', ['package_id' => $package->package_id ]) }}"><i class="fa fa-edit"></i>
                                        <a href="javascript:void(0)" class="deleteRecord" data-id="{{$package->package_id}}" used_at='package' data-route = 'delete_package'><i class="fa fa-trash" style="color:red"></i>
                                    </a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
