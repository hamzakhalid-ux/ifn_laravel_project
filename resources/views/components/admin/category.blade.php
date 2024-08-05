<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{(!empty($cat_data)) ? 'Update Category' : 'Add Category'}}</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{(!empty($cat_data)) ? url('admin/update-category') : url('admin/store-category') }}">
            @csrf
            <!-- <input type ="hidden" name = "category[user_id]" value ='0'> -->
            <input type ="hidden" name = "category[old_cat_id]" value ='{{(!empty($cat_data[0]['category_id']) ? $cat_data[0]['category_id'] : '')}}'>
            <div class="card-body">
                <div class="form-group row">
                    <label for="cat_name" class="col-sm-2 col-form-label">Category Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="category[title]" required value="{{(!empty($cat_data[0]['title']) ? $cat_data[0]['title'] : '')}}" class="form-control" id="cat_name" placeholder="Category Name">
                        </div>
                </div>
                <!-- <div class="form-group row hide">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="category[description]" id="description" placeholder="Description">
                    </div>
                </div> -->
                <!-- <div class="form-group row hide">
                    <label for="cat_order" class="col-sm-2 col-form-label">Order</label>
                        <div class="col-sm-10">
                            <input type="number" name="category[cat_order]" class="form-control" id="cat_order" placeholder="Order">
                        </div>
                </div> -->
                @if(!empty($allcategories))
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Select parent Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cat_status"  name="category[p_category]">
                                <option  value="">Select Category</option>
                                @foreach($allcategories as $category)
                                    @if((empty($cat_data)) || (!empty($cat_data[0]['category_id']) && $cat_data[0]['category_id'] != $category['category_id']) )
                                        <option @if(!empty($cat_data[0]['title']) && ($cat_data[0]['parent_id'] == $category['category_id'])) selected @endif value="{{$category['category_id']}}">{{$category['title'] ?? ''}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Submit</button>
                                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

            </div>
        </form>
    </div>
</div>
