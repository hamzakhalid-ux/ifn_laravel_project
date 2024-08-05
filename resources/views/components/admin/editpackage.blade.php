<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Package</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{url('admin/package/update-package') }}">
            @csrf
            <input type="hidden" name="package[package_id]]" value="{{$package->package_id ?? ''}}">
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Package
                            Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="package[package_title]" required value="{{$package->package_name ?? ''}}" class="form-control"  placeholder="Title Name">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Package
                            Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="package[package_description]" required value="{{$package->package_description ?? ''}}" class="form-control"  placeholder="Title Name">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Defult Package Deals</label>
                        <div class="col-sm-7">
                            <input type="text" id="packageInput" class="form-control" placeholder="Add Deal">
                        </div>
                        <button onclick="addItem()" class=" col-sm-2 btn btn-primary mt-2">Add</button>

                    </div>
                    <ul id="packageList" class="list-group">
                        <!-- List items will be added dynamically here -->
                        @if(!empty($package->default_deals))
                            @foreach ($package->default_deals as $index=>$default_deal)
                                <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $default_deal->deal_name ?? ''}}
                                    <button onclick="deleteItem(this)" class="btn btn-danger btn-sm" style="margin-left: 500px">Delete</button>
                                    <input type="hidden" name="package[defult_deal][{{$index}}][deal_name]" value="{{$default_deal->deal_name ?? ''}}">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Publish</button>
                                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

            </div>
        </form>
    </div>
</div>
