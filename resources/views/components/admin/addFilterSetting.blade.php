<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Setting</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/setting/store-filter-setting') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="col-sm-6">
                    <input type="hidden" name="listing_filter[filter_setting_id]" value="{{$setting['filter_setting_id'] ?? ''}}">
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Categories</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id="" name="listing_filter[category_id]" >
                                <option value="">Select Category</option>
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option @if(!empty($setting['category_id']) && $setting['category_id'] == $category['category_id']) selected @endif value="{{$category['category_id']}}">{{$category['title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Locations</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id="" name="listing_filter[loc_id]" >
                                <option value="">Select location</option>
                                @if(!empty($locations))
                                    @foreach($locations as $loc)
                                        <option @if(!empty($setting['loc_id']) && $setting['loc_id'] == $loc['loc_id']) selected @endif value="{{$loc['loc_id']}}">{{$loc['title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label class="alignleft col-sm-6">
                            <input type="checkbox" name="listing_filter[yearly]" {{(!empty($setting['yearly']) && $setting['yearly'] == 1) ? 'checked' : ''}} value="1">
                            <span class="checkbox-Category">Yearly</span>
                        </label>
                        <label class="alignleft col-sm-6">
                            <input type="checkbox" name="listing_filter[category]" {{(!empty($setting['category']) && $setting['category'] == 1) ? 'checked' : ''}} value="1">
                            <span class="checkbox-title">Category</span>
                        </label>
                        <label class="alignleft col-sm-6">
                            <input type="checkbox" name="listing_filter[tag]" {{(!empty($setting['tag']) && $setting['tag'] == 1) ? 'checked' : ''}} value="1">
                            <span class="checkbox-title">Tag</span>
                        </label>
                        {{-- <label class="alignleft col-sm-6">
                            <input type="checkbox" name="listing_filter[location]" {{(!empty($setting['location']) && $setting['location'] == 1) ? 'checked' : ''}} value="1">
                            <span class="checkbox-title">Location</span>
                        </label> --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Template</label>
                            <div class="col-sm-10">
                                <select class="form-control"  @if(!empty($setting)) disabled @else required @endif   name="listing_filter[template]">
                                    <option  value="" >Select Category</option>
                                            <option  @if(!empty($setting['template']) && $setting['template']  == 'default_template') selected @endif value="default_template">Default Template</option>
                                            <option @if(!empty($setting['template']) && $setting['template'] == 'blank_template') selected @endif value="blank_template">Blank Template</option>
                                            <option @if(!empty($setting['template']) && $setting['template'] == 'news_template') selected @endif value="news_template">News Template</option>
                                            <option @if(!empty($setting['template']) && $setting['template'] == 'newsletter_template') selected @endif value="newsletter_template">Newsletter Template</option>
                                            <option @if(!empty($setting['template']) && $setting['template'] == 'press_release') selected @endif value="press_release">Press Release</option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Tags</label>
                        <div class="col-sm-10">
                            <select class="form-control js-example-basic-multiple"  id="" name="listing_filter[tag_id]" >
                                <option value="">Select Tag</option>
                                @if(!empty($alltags))
                                    @foreach($alltags as $tag)
                                        <option @if(!empty($setting['tag_id']) && $setting['tag_id'] == $tag['id']) selected @endif value="{{$tag['id']}}">{{$tag['title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
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
