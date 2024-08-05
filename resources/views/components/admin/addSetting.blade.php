<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Setting</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/setting/store-setting') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Top Menu 1</label>
                        <div class="col-sm-10">
                            <select class="form-control "  id=""  name="setting[top_menu_1]" >
                                <option value="">Select Menu</option>
                               @if(!empty($all_menus))
                                    @foreach($all_menus as $menu)
                                        <option @if(!empty($setting) && $setting['top_menu_1'] == $menu['menu_id'] ) selected @endif value="{{$menu['menu_id']}}">{{$menu['menu_title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Top Menu 2</label>
                        <div class="col-sm-10">
                            <select class="form-control "  id=""  name="setting[top_menu_2]" >
                                <option value="">Select Menu</option>
                                @if(!empty($all_menus))
                                    @foreach($all_menus as $menu)
                                        <option @if(!empty($setting) && $setting['top_menu_2'] == $menu['menu_id'] ) selected @endif  value="{{$menu['menu_id']}}">{{$menu['menu_title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Footer menu 1</label>
                        <div class="col-sm-10">
                            <select class="form-control "  id=""  name="setting[footer_menu_1]" >
                                <option value="">Select Menu</option>
                                @if(!empty($all_menus))
                                    @foreach($all_menus as $menu)
                                        <option @if(!empty($setting) && $setting['footer_menu_1'] == $menu['menu_id'] ) selected @endif  value="{{$menu['menu_id']}}">{{$menu['menu_title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Footer menu 2</label>
                        <div class="col-sm-10">
                            <select class="form-control "  id=""  name="setting[footer_menu_2]" >
                                <option value="">Select Menu</option>
                                @if(!empty($all_menus))
                                    @foreach($all_menus as $menu)
                                        <option @if(!empty($setting) && $setting['footer_menu_2'] == $menu['menu_id'] ) selected @endif  value="{{$menu['menu_id']}}">{{$menu['menu_title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Footer menu 3</label>
                        <div class="col-sm-10">
                            <select class="form-control "  id=""  name="setting[footer_menu_3]" >
                                <option value="">Select Menu</option>
                                @if(!empty($all_menus))
                                    @foreach($all_menus as $menu)
                                        <option @if(!empty($setting) && $setting['footer_menu_3'] == $menu['menu_id'] ) selected @endif  value="{{$menu['menu_id']}}">{{$menu['menu_title'] ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'bottom_left';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Roundups</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][bottom_left][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(!empty($filteredRecords) && $filteredRecords[0]['status'] == 1) checked @endif name="setting[bottom_left_status]" class="onoff-switch-checkbox" id="onoff-switch-1">
                            <label class="onoff-switch-label" for="onoff-switch-1"></label>
                        </div>
                    </div>
                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'bottom_right';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Reviews</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][bottom_right][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif name="setting[bottom_right_status]" class="onoff-switch-checkbox" id="onoff-switch-2">
                            <label class="onoff-switch-label" for="onoff-switch-2"></label>
                        </div>
                    </div>
                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'correspondents_left';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Correspondents Left</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][correspondents_left][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif name="setting[correspondents_left_status]"  class="onoff-switch-checkbox" id="onoff-switch-3">
                            <label class="onoff-switch-label" for="onoff-switch-3"></label>
                        </div>
                    </div>
                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'correspondents_right';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Correspondents Right</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][correspondents_right][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif name="setting[correspondents_right_status]"  class="onoff-switch-checkbox" id="onoff-switch-4">
                            <label class="onoff-switch-label" for="onoff-switch-4"></label>
                        </div>
                    </div>
                </div>
                @php
                    $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                        return $record['session'] === 'slider_session';
                    });
                @endphp
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Slider Session(All Posts)</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][slider_session][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif name="setting[slider_session_status]" class="onoff-switch-checkbox" id="onoff-switch-4">
                            <label class="onoff-switch-label" for="onoff-switch-4"></label>
                        </div>
                    </div>
                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'middle_left';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Reports</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][middle_left][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif name="setting[middle_left_status]" class="onoff-switch-checkbox" id="onoff-switch-5">
                            <label class="onoff-switch-label" for="onoff-switch-5"></label>
                        </div>
                    </div>
                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'middle_right';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">News</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][middle_right][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif name="setting[middle_right_status]" class="onoff-switch-checkbox" id="onoff-switch-6">
                            <label class="onoff-switch-label" for="onoff-switch-6"></label>
                        </div>
                    </div>
                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'last_session';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Last Session</label>
                        <div class="col-sm-8">
                            <select class="form-control " id="" name="setting[session_data][last_session][]">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($all_posts))
                                    @foreach($all_posts as $post)
                                        <option  @if(in_array($post['post_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $post['post_id'] }}">{{ $post['post_title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif  name="setting[last_session_status]" class="onoff-switch-checkbox" id="onoff-switch-7">
                            <label class="onoff-switch-label" for="onoff-switch-7"></label>
                        </div>


                    </div>


                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'features_left';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Features Left</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][features_left][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif name="setting[features_left_status]"  class="onoff-switch-checkbox" id="onoff-switch-15">
                            <label class="onoff-switch-label" for="onoff-switch-15"></label>
                        </div>
                    </div>
                    @php
                        $filteredRecords = array_filter($setting['settingmapper'], function($record) {
                            return $record['session'] === 'features_right';
                        });
                    @endphp
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Features Right</label>
                        <div class="col-sm-8">
                            <select class="form-control js-example-basic-multiple" id="" name="setting[session_data][features_right][]" multiple="multiple">
                                {{-- <option value="" disabled selected>Select Posts</option> <!-- Placeholder option --> --}}
                                @if(!empty($allcategories))
                                    @foreach($allcategories as $category)
                                        <option  @if(in_array($category['category_id'], array_column($filteredRecords, 'object_id'))) selected @endif value="{{ $category['category_id'] }}">{{ $category['title'] ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="onoff-switch col-sm-2">
                            <input type="checkbox" @if(in_array(1, array_column($filteredRecords, 'status'))) checked @endif name="setting[features_right_status]"  class="onoff-switch-checkbox" id="onoff-switch-14">
                            <label class="onoff-switch-label" for="onoff-switch-14"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="margin-left: 16px;">
                <button type="submit" class="btn btn-info">Publish</button>
                                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

            </div>
        </form>
    </div>
</div>
