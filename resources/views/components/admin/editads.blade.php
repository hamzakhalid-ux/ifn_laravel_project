@php
    $section = [
        'logo_ad'=> 'Logo Ad',
        'partners_ad'=> 'Partners Ad',
        'report_ad'=> 'Report Ads',
        'section_1'=> 'Section 1',
        'section_2'=> 'Section 2',
        'section_3'=> 'Section 3',
        'section_4'=> 'Section 4',
    ]
@endphp
<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Ad</h3>
        </div>
        <form class="form-horizontal" id=""  method="POST" action="{{ url('admin/ads/update-ads') }}"  enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <input type="hidden" name="ad[ad_id]" value="{{$ads->ad_id}}">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Ad Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="ad[ad_title]" required value="{{$ads->ad_title}}" class="form-control"  placeholder="Title Name">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Ad Link</label>
                            <div class="col-sm-9">
                                <input type="text" name="ad[ad_link]" required value="{{$ads->ad_link ?? ''}}" class="form-control"  placeholder="Ad Link">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Ad Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id=""  name="ad[ad_status]" >
                                    <option @if('hide' == $ads->ad_status) selected @endif value="hide">Hide</option>
                                    <option @if('show' == $ads->ad_status) selected @endif value="show">Show</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="cat_status" class="col-sm-3 col-form-label">Ads Section</label>
                        <div class="col-sm-9">
                            <select class="form-control js-example-basic-multiple" required id="cat_status"  name="ad[ad_type]">
                                @if(!empty($section))
                                    @foreach($section as $index=>$sec)
                                        <option @if($index == $ads->ad_type) selected @endif value="{{$index}}">{{$sec ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="images" class="col-sm-3">Ad Image:</label>
                    <div class="input-group col-sm-9">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse&hellip; <input type="file" id="imageInput" name="ad[ad_image]" accept="image/jpeg,image/png">
                            </span>
                        </span>
                        <input type="text" id="selectedImages" class="form-control" readonly>
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

