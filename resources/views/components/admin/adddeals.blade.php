<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Custom Deals</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{url('admin/deal/store-deal') }}">
            @csrf
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Package Name</label>
                            <div class="col-sm-9">
                                <select class="form-control" required id=""  name="deal[package_id]">
                                    <option  value="">Please select Package</option>
                                    @if(!empty($all_packages))
                                        @foreach($all_packages as $index=>$package)
                                            <option value="{{$package->package_id}}">{{$package->package_name ?? ''}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Deals Title</label>
                        <div class="col-sm-4">
                            <input type="text" id="deal_title" class="form-control" placeholder="Deal Title">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" id="deal_description" class="form-control" placeholder="Add Deal description">
                        </div>
                        <button onclick="adddeals()" class=" col-sm-2 btn btn-primary mt-2">Add</button>

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
