<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Page</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/page/update-page') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="page[page_id]" value="{{(!empty($page_data[0])) ? $page_data[0]['page_id'] : ''}}" enctype="multipart/form-data">
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">page
                            Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="page[page_title]" required value="{{(!empty($page_data[0])) ? $page_data[0]['page_title'] : ''}}" class="form-control"  placeholder="Page Name">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Parent Page</label>
                        <div class="col-sm-10">
                            <select class="form-control" id=""  name="page[page_parent_id]" >
                                <option value="">Select Parent page</option>
                                @if(!empty($all_pages))
                                    @foreach($all_pages as $page)
                                        @if((!empty($page_data[0]['page_id']) && $page_data[0]['page_id'] != $page['page_id']))
                                            <option @if(!empty($page_data[0]['page_parent_id']) && ($page_data[0]['page_parent_id'] == $page['page_id'])) selected @endif value="{{$page['page_id']}}">{{$page['page_title'] ?? ''}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Page Content</label>
                            <div class="col-sm-10">
                                <textarea id="myeditorinstance" name="page[page_content]" rows="4" cols="50">{{(!empty($page_data[0])) ? $page_data[0]['page_content'] : ''}} </textarea>
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="page[page_date]" required value="{{(!empty($page_data[0])) ? $page_data[0]['page_date'] : ''}}" class="form-control"  placeholder="Post Date">
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
                            <input type="hidden" id="oldPostImage" name="page[oldPostImage]" class="form-control" value="{{$page_data[0]['page_image'] ?? ''}}" readonly>
                        </div>
                    </div>
                    @if(!empty($page_data[0]['page_image']))
                        <div class="row">
                            <div class="col-xs-10 col-md-10" style="margin: 2%;  margin-left: 68px">
                                <div style="position: relative; overflow: hidden;">
                                    <a href="#" class="">
                                        <img src="{{ asset('page/' . $page_data[0]['page_image']) }}" alt="..." style="height: 180px; width: 100%; display: block;">
                                    </a>
                                    <span style="position: absolute; top: 10px; right: 10px; color: red; cursor: pointer; font-size: 24px; opacity: 0.7; transition: all 0.3s ease;" class="glyphicon glyphicon-remove-circle removepostimage"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" required  name="page[page_status]">
                                    <option  value="">Select Category</option>
                                    <option @if(!empty($page_data[0]['page_status']) && ($page_data[0]['page_status'] == 'published')) selected @endif value="published" >Published</option>
                                    <option @if(!empty($page_data[0]['page_status']) && ($page_data[0]['page_status'] == 'pending_review')) selected @endif value="pending_review">Pending Review</option>
                                    <option @if(!empty($page_data[0]['page_status']) && ($page_data[0]['page_status'] == 'draft')) selected @endif value="draft">Draft</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Order</label>
                            <div class="col-sm-10">
                                <input type="number" name="page[page_order]" value="{{(!empty($page_data[0])) ? $page_data[0]['page_order'] : ''}}" class="form-control"  placeholder="Post Order">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Template</label>
                            <div class="col-sm-10">
                                <select class="form-control" required  name="page[page_template]">
                                    <option  value="" >Select Category</option>
                                            <option  @if(!empty($page_data[0]['page_template']) && ($page_data[0]['page_template'] == 'default_temp')) selected @endif value="default_temp">Default template</option>
                                            <option @if(!empty($page_data[0]['page_template']) && ($page_data[0]['page_template'] == 'blank')) selected @endif value="blank">Blank</option>
                                            <option @if(!empty($page_data[0]['page_template']) && ($page_data[0]['page_template'] == 'blog')) selected @endif value="blog">Blog</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Form Id</label>
                            <div class="col-sm-10">
                                <input type="number" name="page[form_id]" value="{{(!empty($page_data[0])) ? $page_data[0]['form_id'] : ''}}" class="form-control"  placeholder="Form Id">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Page Class</label>
                            <div class="col-sm-10">
                                <input type="text" name="page[page_class]" value="{{ $page_data[0]['page_class'] ?? ''}}" class="form-control"  placeholder="Page Class">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="alignleft col-sm-6">
                            <input type="checkbox" name="page[comment_status]" {{(!empty($page_data[0]) && $page_data[0]['comment_status'] == 1) ? 'checked' : ''}} value="1">
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
