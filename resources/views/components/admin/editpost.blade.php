<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Post</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/post/update-post') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <input type="hidden" name="old_post_id" value="{{(!empty($edit_post[0])) ? $edit_post[0]['post_id'] : ''}}">
                        <label for="cat_name" class="col-sm-2 col-form-label">Post
                            Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="post[post_title]"  value="{{(!empty($edit_post)) ? $edit_post[0]['post_title'] : ''}}" class="form-control"  placeholder="Tag Name">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Categories</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id="" name="post[category][]" multiple="multiple">
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option @if(in_array($category['category_id'], array_column($edit_post[0]['post_category'], 'category_id'))) selected @endif value="{{$category['category_id']}}">{{$category['title'] ?? ''}}</option>
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
                                        <option @if(in_array($tag['id'], array_column($edit_post[0]['post_tag'], 'tag_id'))) selected @endif  value="{{$tag['id']}}">{{$tag['title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="post_location" class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id="post_location"  name="post[location][]" multiple="multiple">
                                @if(!empty($locations))
                                    @foreach($locations as $loc)
                                        <option @if(in_array($loc['loc_id'], array_column($edit_post[0]['post_location'], 'loc_id'))) selected @endif   value="{{$loc['loc_id']}}">{{$loc['title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Sector</label>
                        <div class="col-sm-10">
                            <input type="text" name="post[sector]"  value="{{(!empty($edit_post)) ? $edit_post[0]['sector'] : ''}}" class="form-control"  placeholder="Sector">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Post Content</label>
                            <div class="col-sm-10">
                                <textarea id="myeditorinstance" name="post[post_content]" rows="4" cols="50">{{(!empty($edit_post)) ? $edit_post[0]['post_content'] : ''}} </textarea>
                            </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="podcastTitle">Twitter:</label>
                        <input type="text" class="form-control" value="{{$edit_post[0]['twitter_link'] ?? ''}}"  name="post[twitter_link]">
                    </div>

                    <div class="form-group">
                        <label for="podcastTitle">Telegram:</label>
                        <input type="text" class="form-control" value="{{$edit_post[0]['telegram_link'] ?? ''}}"  name="post[telegram_link]">
                    </div>
                    <div class="form-group">
                        <label for="podcastTitle">Whatsapp:</label>
                        <input type="text" class="form-control" value="{{$edit_post[0]['watsapp_link'] ?? ''}}" name="post[watsapp_link]">
                    </div> --}}
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="post[post_date]" value="{{(!empty($edit_post)) ? $edit_post[0]['post_date'] : ''}}" class="form-control"  placeholder="Tag Name">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="images" class="col-sm-2">Image:</label>
                        <div class="input-group col-sm-10">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse&hellip; <input type="file" id="imageInput" name="post[image]" accept="image/jpeg,image/png">
                                </span>
                            </span>
                            <input type="text" id="selectedImages" class="form-control" readonly>
                            <input type="hidden" id="oldPostImage" name="post[oldPostImage]" class="form-control" value="{{$edit_post[0]['post_image'] ?? ''}}" readonly>
                        </div>
                    </div>
                    @if(!empty($edit_post[0]['post_image']))
                        <div class="row">
                            <div class="col-xs-10 col-md-10" style="margin: 2%;  margin-left: 68px">
                                <div style="position: relative; overflow: hidden;">
                                    <a href="#" class="">
                                        <img src="{{ asset('post/' . $edit_post[0]['post_image']) }}" alt="..." style="height: 180px; width: 100%; display: block;">
                                    </a>
                                    <span style="position: absolute; top: 10px; right: 10px; color: red; cursor: pointer; font-size: 24px; opacity: 0.7; transition: all 0.3s ease;" class="glyphicon glyphicon-remove-circle removepostimage"></span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control"   name="post[post_status]">
                                    <option  value="" >Select Category</option>
                                            <option @if(!empty($edit_post[0]['post_status']) && ($edit_post[0]['post_status'] == 'published')) selected @endif value="published" >Published</option>
                                            <option @if(!empty($edit_post[0]['post_status']) && ($edit_post[0]['post_status'] == 'pending_review')) selected @endif value="pending_review">Pending Review</option>
                                            <option @if(!empty($edit_post[0]['post_status']) && ($edit_post[0]['post_status'] == 'draft')) selected @endif value="draft">Draft</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Allow Article For</label>
                            <div class="col-sm-10">
                                <select class="form-control"  name="post[allow_article]">
                                    <option  value="" >Select Allow Article Type</option>
                                            <option @if(!empty($edit_post[0]['allow']) && ($edit_post[0]['allow'] == 'public')) selected @endif  value="public">Public Users</option>
                                            <option @if(!empty($edit_post[0]['allow']) && ($edit_post[0]['allow'] == 'basic')) selected @endif  value="basic">Basic Users</option>
                                            <option @if(!empty($edit_post[0]['allow']) && ($edit_post[0]['allow'] == 'premium')) selected @endif  value="premium">Premium Users</option>
                                </select>
                            </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Form id</label>
                            <div class="col-sm-10">
                                <input type="number" name="post[form_id]" value="{{(!empty($edit_post)) ? $edit_post[0]['form_id'] : ''}}" class="form-control"  placeholder="Form Id">

                            </div>
                    </div> --}}
                    <div class="row">
                        <div class="checkbox col-sm-4">
                            <label>
                                <input type="radio" @if(!empty($edit_post[0]['post_type']) && ($edit_post[0]['post_type'] == 'simple')) checked @endif name="post[post_type]" value="simple" checked> Simple
                            </label>
                        </div>
                        <div class="checkbox col-sm-4">
                            <label>
                                <input type="radio" @if(!empty($edit_post[0]['post_type']) && ($edit_post[0]['post_type'] == 'podcast')) checked @endif name="post[post_type]" value="podcast"> Podcast
                            </label>
                        </div>
                        <div class="checkbox col-sm-4">
                            <label>
                                <input type="radio" @if(!empty($edit_post[0]['post_type']) && ($edit_post[0]['post_type'] == 'video')) checked @endif  name="post[post_type]" value="video"> Video
                            </label>
                        </div>
                    </div>
                    <div class="form-group" id="podcastInput" @if(!empty($edit_post[0]['post_type']) && ($edit_post[0]['post_type'] != 'podcast')) style="display: none;" @endif>
                        <label for="podcastTitle">Podcast Title:</label>
                        <input type="text" class="form-control" value="{{$edit_post[0]['podcast'] ?? ''}}" id="podcastTitle" name="post[podcast]">
                    </div>

                    <div class="form-group" id="videoInput" @if(!empty($edit_post[0]['post_type']) && ($edit_post[0]['post_type'] != 'video')) style="display: none;" @endif >
                        <label for="videoName">Video Name:</label>
                        <input type="text" class="form-control" value="{{$edit_post[0]['videoName'] ?? ''}}" id="videoName" name="post[videoName]">
                    </div>
                    <div class=" row ">
                        <label class="checkbox col-sm-4">
                            <input type="checkbox" name="post[comment_status]" @if(!empty($edit_post[0]['comment_status']) && ($edit_post[0]['comment_status'] == 1)) checked @endif  value="1">Allow Comments
                        </label>
                        {{-- <label class="checkbox col-sm-4">
                            <input type="checkbox" name="post[ping_status]"  @if(!empty($edit_post[0]['ping_status']) && ($edit_post[0]['ping_status'] == 1)) checked @endif value="1">Allow Pings
                        </label>
                        <label class="checkbox  col-sm-4">
                            <input type="checkbox" name="post[sticky]" @if(!empty($edit_post[0]['sticky']) && ($edit_post[0]['sticky'] == 1)) checked @endif value="1">Make this post sticky
                        </label> --}}
                    </div>
                    {{-- <div class="form-group">
                        <label for="podcastTitle">linkedin:</label>
                        <input type="text" class="form-control" value="{{$edit_post[0]['linkdin_link'] ?? ''}}"  name="post[linkdin_link]">
                    </div>
                    <div class="form-group">
                        <label for="podcastTitle">Instagram:</label>
                        <input type="text" class="form-control" value="{{$edit_post[0]['instagram_link'] ?? ''}}"  name="post[instagram_link]">
                    </div>

                    <div class="form-group">
                        <label for="podcastTitle">FaceBook:</label>
                        <input type="text" class="form-control" value="{{$edit_post[0]['facebook_link'] ?? ''}}"  name="post[facebook_link]">
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
