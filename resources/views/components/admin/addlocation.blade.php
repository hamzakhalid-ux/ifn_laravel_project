<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Location</h3>
        </div>
        <form class="form-horizontal" id=""  method="POST" action="{{ url('admin/location/store-location') }}">
            @csrf
            <div class="card-body row">

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Location Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="location[location_title]" required value="" class="form-control"  placeholder="Title Name">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="cat_status" class="col-sm-2 col-form-label">Locations</label>
                    <div class="col-sm-10">
                        <select class="form-control js-example-basic-multiple" id=""  name="location[location_parent_id]" >
                            <option value="">Select Parent location</option>
                            @if(!empty($locations))
                                @foreach($locations as $location)
                                    <option value="{{$location['loc_id']}}">{{$location['title'] .(!empty($location['parent_title']) ? "(".$location['parent_title'].")" : '' )}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="margin-left: 16px;">
                <button type="submit" class="btn btn-info">Publish</button>
                                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="customItemModal" tabindex="-1" role="dialog" aria-labelledby="customItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customItemModalLabel">Add Custom Item</h5>
                <input type="hidden" value="0" id="customindex">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="customItemForm">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" placeholder="Enter Title" id="custom_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <input type="text" class="form-control" placeholder="WWW.example.com" id="url" name="url" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addCustomItem()">Add</button>
            </div>
        </div>
    </div>
</div>
