<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Post</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/post/store-post') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Post
                            Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="post[post_title]"  value="" class="form-control"  placeholder="Post Name">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Categories</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id=""  name="post[category][]" multiple="multiple">
                               @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option @if(!empty($cat_data[0]['title']) && ($cat_data[0]['parent_id'] == $category['category_id'])) selected @endif value="{{$category['category_id']}}">{{$category['title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Tags</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id="cat_status"  name="post[tag][]" multiple="multiple">
                                @if(!empty($alltags))
                                    @foreach($alltags as $tag)
                                        <option  value="{{$tag['id']}}">{{$tag['title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Sector</label>
                        <div class="col-sm-10">
                            <input type="text" name="post[sector]"  value="" class="form-control"  placeholder="Sector">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="post_location" class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id="post_location"  name="post[location][]" multiple="multiple">
                                @if(!empty($locations))
                                    @foreach($locations as $loc)
                                        <option  value="{{$loc['id']}}">{{$loc['title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Post Content</label>
                            <div class="col-sm-10">
                                <textarea id="myeditorinstance" name="post[post_content]" rows="4" cols="50"> </textarea>
                            </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="podcastTitle">Twitter:</label>
                        <input type="text" class="form-control" value=""  name="post[twitter_link]">
                    </div>

                    <div class="form-group">
                        <label for="podcastTitle">Telegram:</label>
                        <input type="text" class="form-control" value=""  name="post[telegram_link]">
                    </div>
                    <div class="form-group">
                        <label for="podcastTitle">Whatsapp:</label>
                        <input type="text" class="form-control" value="" name="post[watsapp_link]">
                    </div> --}}
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="post[post_date]" value="" class="form-control"  placeholder="Tag Name">
                            </div>
                    </div>

                    {{-- <div class="form-group row"> --}}
                        {{-- <label for="cat_name" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="post[post_password]" value="" class="form-control"  placeholder="Tag Name">
                            </div> --}}
                            <div class="form-group row">
                                <label for="images" class="col-sm-2">Image:</label>
                                <div class="input-group col-sm-10">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse&hellip; <input type="file" id="imageInput" name="post[image]" accept="image/jpeg,image/png">
                                        </span>
                                    </span>
                                    <input type="text" id="selectedImages" class="form-control" readonly>
                                </div>
                            </div>
                    {{-- </div> --}}
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control"  name="post[post_status]">
                                    <option  value="" >Select Category</option>
                                            <option value="published">Published</option>
                                            <option value="pending_review">Pending Review</option>
                                            <option value="draft">Draft</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Allow Article For</label>
                            <div class="col-sm-10">
                                <select class="form-control"  name="post[allow_article]">
                                    <option  value="" >Select Allow Article Type</option>
                                            <option value="public">Public Users</option>
                                            <option value="basic">Basic Users</option>
                                            <option value="premium">Premium Users</option>
                                </select>
                            </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Form id</label>
                            <div class="col-sm-10">
                                <input type="number" name="post[form_id]" value="" class="form-control"  placeholder="Form Id">

                            </div>
                    </div> --}}
                    <div class="row">
                        <div class="checkbox col-sm-4">
                            <label>
                                <input type="radio" name="post[post_type]" value="simple" checked> Simple
                            </label>
                        </div>
                        <div class="checkbox col-sm-4">
                            <label>
                                <input type="radio" name="post[post_type]" value="podcast"> Podcast
                            </label>
                        </div>
                        <div class="checkbox col-sm-4">
                            <label>
                                <input type="radio" name="post[post_type]" value="video"> Video
                            </label>
                        </div>
                    </div>
                    <div class="form-group" id="podcastInput" style="display: none;">
                        <label for="podcastTitle">Podcast Title:</label>
                        <input type="text" class="form-control" id="podcastTitle" name="post[podcastTitle]">
                    </div>

                    <div class="form-group" id="videoInput" style="display: none;">
                        <label for="videoName">Video Name:</label>
                        <input type="text" class="form-control" id="videoName" name="post[videoName]">
                    </div>
                    <div class=" row ">
                        <label class="checkbox col-sm-4">
                            <input type="checkbox" name="post[comment_status]" value="1">Allow Comments
                        </label>
                        {{-- <label class="checkbox col-sm-4">
                            <input type="checkbox" name="post[ping_status]" value="1">Allow Pings
                        </label>
                        <label class="checkbox  col-sm-4">
                            <input type="checkbox" name="post[sticky]" value="1">Make this post sticky
                        </label> --}}
                    </div>
                    {{-- <div class="form-group">
                        <label for="podcastTitle">linkedin:</label>
                        <input type="text" class="form-control" value=""  name="post[linkdin_link]">
                    </div>
                    <div class="form-group">
                        <label for="podcastTitle">Instagram:</label>
                        <input type="text" class="form-control" value=""  name="post[instagram_link]">
                    </div>

                    <div class="form-group">
                        <label for="podcastTitle">FaceBook:</label>
                        <input type="text" class="form-control" value=""  name="post[facebook_link]">
                    </div> --}}

                </div>
            </div>
            <div class="card-footer" style="margin-left: 16px;">
                <button type="submit" class="btn btn-info">Publish</button>
                                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

            </div>
        </form>
    </div>
</div>
