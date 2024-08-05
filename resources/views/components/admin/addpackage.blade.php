<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Package</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{url('admin/package/store-package') }}">
            @csrf
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Package
                            Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="package[package_title]" required value="" class="form-control"  placeholder="Title Name">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Package
                            Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="package[package_description]" required value="" class="form-control"  placeholder="Title Name">
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
