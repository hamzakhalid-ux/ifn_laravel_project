<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Package</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{url('admin/deal/update-deal') }}">
            @csrf
            <input type="hidden" name="deal[deal_id]]" value="{{$deal->deal_id ?? ''}}">
            {{-- @dd($package->default_deals) --}}
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Package Name</label>
                            <div class="col-sm-9">
                                <select class="form-control" required id=""  name="deal[package_id]">
                                    <option  value="">Please select Package</option>
                                    @if(!empty($all_packages))
                                        @foreach($all_packages as $index=>$package)
                                            <option @if(!empty($deal->package_id) && $deal->package_id == $package->package_id) selected @endif value="{{$package->package_id}}">{{$package->package_name ?? ''}}</option>
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
                        @if(!empty($deal->default_deals))
                            @foreach ($deal->default_deals as $index=>$default_deal)
                                <li class="list-group-item d-flex justify-content-between align-items-center"> {{ ($default_deal->deal_name ?? '') .'-' . ($default_deal->deal_description ?? '')}}
                                    <button onclick="deleteItem(this)" class="btn btn-danger btn-sm" style="margin-left: 500px">Delete</button>
                                    <input type="hidden" name="deal[custom_deals][{{$default_deal->deal_name }}][description]" value="{{$default_deal->deal_description}}">
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
