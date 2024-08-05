<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Page</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/page/store-page') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">page
                            Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="page[page_title]" required value="" class="form-control"  placeholder="Page Name">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Parent Page</label>
                        <div class="col-sm-10">
                            <select class="form-control" id=""  name="page[page_parent_id]" >
                                <option value="">Select Parent page</option>
                                @if(!empty($all_pages))
                                    @foreach($all_pages as $page)
                                        <option value="{{$page['page_id']}}">{{$page['page_title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Page Content</label>
                            <div class="col-sm-10">
                                <textarea id="myeditorinstance" name="page[page_content]" rows="4" cols="50"> </textarea>
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="page[page_date]" required value="" class="form-control"  placeholder="Post Date">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="images" class="col-sm-2">Image:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse&hellip; <input type="file" id="imageInput" name="page[image]" accept="image/jpeg,image/png">
                                </span>
                            </span>
                            <input type="text" id="selectedImages" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" required  name="page[page_status]">
                                    <option  value="">Select Category</option>
                                            <option value="published">Published</option>
                                            <option value="pending_review">Pending Review</option>
                                            <option value="draft">Draft</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Order</label>
                            <div class="col-sm-10">
                                <input type="number" name="page[page_order]" value="" class="form-control"  placeholder="Post Order">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Template</label>
                            <div class="col-sm-10">
                                <select class="form-control" required  name="page[page_template]">
                                    <option  value="" >Select Category</option>
                                            <option value="default_temp">Default template</option>
                                            <option value="blank">Blank</option>
                                            <option value="blog">Blog</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Form Id</label>
                            <div class="col-sm-10">
                                <input type="number" name="page[form_id]" value="" class="form-control"  placeholder="Form Id">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Page Class</label>
                            <div class="col-sm-10">
                                <input type="text" name="page[page_class]" value="" class="form-control"  placeholder="Page Class">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="alignleft col-sm-6">
                            <input type="checkbox" name="page[comment_status]" value="1">
                            <span class="checkbox-title">Allow Comments</span>
                        </label>
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
