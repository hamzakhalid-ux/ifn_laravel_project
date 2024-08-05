<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Menu</h3>
        </div>
        <form  class="form" id="frmEdit">
            <input type="hidden" class="item-menu" name="text" id="text">
            <input type="hidden" class="item-menu" name="href" id="href">
            <input type="hidden" class="item-menu" name="target" id="target">
            <input type="hidden" class="item-menu" name="title" id="title">
            <input type="hidden" class="item-menu" name="data_type" id="data_type">
            <input type="hidden" class="item-menu" name="data_id" id="data_id">
            <input type="hidden" class="" name="" id="btnUpdate">
        </form>
        <form class="form-horizontal" id="mainForm" method="POST" action="{{ url('admin/menu/update-menu') }}">
            @csrf
            <div class="card-body row">
                <input type="hidden" name="menu[menu_id]" value="{{(!empty($menu_data) ? $menu_data[0]['menu_id'] : '')}}" class="form-control"  placeholder="Title Name">
                <input type="hidden" name="menu[sorted_order]" value="{{(!empty($menu_data)) ? $menu_data[0]['json_menu_items'] : ''}}" id="sorted-order">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-3 col-form-label">Menu
                            Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="menu[menu_title]" required value="{{(!empty($menu_data) ? $menu_data[0]['menu_title'] : '')}}" class="form-control"  placeholder="Title Name">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customItemModal">
                                Add Custom Item
                            </button>
                        </div>
                    </div>
                </div>
                <div id="faq2" role="tablist" class="col-sm-6" aria-multiselectable="true">

                    <div class="float-right">
                        <h4>Add Menu Item</h4>
                    </div>

                    <div class="panel panel-default"  data-toggle="collapse" data-target="#pages" data-parent="#faq2">
                        <div class="panel-heading" role="tab" id="questionThree">
                            <h5 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#faq2" href="#pages" aria-expanded="true" aria-controls="pages">
                                    Pages
                                </a>
                            </h5>
                        </div>
                        <div id="pages" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionThree">
                            <div class="panel-body" style="max-height: 150px; overflow-y: auto;overflow-x: auto;">
                            @if(!empty($all_pages))
                                @foreach ($all_pages as $page)
                                        <label class="col-sm-6">
                                            <input type="checkbox"  id="{{$page['page_id'] . "page"}}"  @if(!empty($menu_data[0]['menu_objects']['page']) && in_array($page['page_id'],$menu_data[0]['menu_objects']['page'] )) checked disabled @endif class="checkbox-dropdown-input addInMenuStructure" name="menu[page][]" data-type="page" data-titel="{{$page['page_title']}}" value="{{$page['page_id']}}">
                                            {{$page['page_title']}}
                                        </label>
                                @endforeach
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" data-toggle="collapse" data-target="#posts" data-parent="#faq2">
                        <div class="panel-heading" role="tab" id="questionThree">
                            <h5 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#faq2" href="#posts" aria-expanded="true" aria-controls="posts">
                                    Posts
                                </a>
                            </h5>
                        </div>
                        <div id="posts" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionThree">
                            <div class="panel-body" style="max-height: 150px; overflow-y: auto;overflow-x: auto;">
                                @if(!empty($all_posts))
                                    @foreach ($all_posts as $post)
                                        <label class="col-sm-6">
                                        <input type="checkbox" id="{{$post['post_id'] . "post"}}" @if(!empty($menu_data[0]['menu_objects']['post']) && in_array($post['post_id'],$menu_data[0]['menu_objects']['post'] )) checked disabled @endif class="checkbox-dropdown-input addInMenuStructure" name="menu[post][]" data-type="post" data-titel="{{$post['post_title']}}" value="{{$post['post_id']}}">
                                        {{$post['post_title']}}
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" data-toggle="collapse" data-target="#category" data-parent="#faq2">
                        <div class="panel-heading" role="tab" id="questionThree">
                            <h5 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#faq2" href="#category" aria-expanded="true" aria-controls="category">
                                    Categories
                                </a>
                            </h5>
                        </div>
                        <div id="category" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionThree">
                            <div class="panel-body" style="max-height: 150px; overflow-y: auto;overflow-x: auto;">
                                @if(!empty($allcategories))
                                    @foreach ($allcategories as $category)
                                            <label class="col-sm-6">
                                                <input type="checkbox" id="{{$category['category_id']. "category"}}" @if(!empty($menu_data[0]['menu_objects']['category']) && in_array($category['category_id'],$menu_data[0]['menu_objects']['category'] )) checked disabled @endif class="checkbox-dropdown-input addInMenuStructure" name="menu[category][]" data-type="category"  data-titel="{{$category['title']}}" value="{{$category['category_id']}}">
                                                {{$category['title']}}
                                            </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" data-toggle="collapse" data-target="#alltags" data-parent="#faq2">
                        <div class="panel-heading" role="tab" id="questionThree">
                            <h5 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#faq2" href="#alltags" aria-expanded="true" aria-controls="alltags">
                                    Tags
                                </a>
                            </h5>
                        </div>
                        <div id="alltags" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionThree">
                            <div class="panel-body"  style="max-height: 150px; overflow-y: auto;overflow-x: auto;">
                                @if(!empty($alltags))
                                    @foreach ($alltags as $tag)
                                            <label class="col-sm-6">
                                            <input type="checkbox" id="{{$tag['id'] . "tag"}}" @if(!empty($menu_data[0]['menu_objects']['tag']) && in_array($tag['id'],$menu_data[0]['menu_objects']['tag'] )) checked disabled @endif class="checkbox-dropdown-input addInMenuStructure" name="menu[tag][]"  data-type="tag" data-titel="{{$tag['title']}}" value="{{$tag['id']}}">
                                            {{$tag['title']}}
                                            </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" data-toggle="collapse" data-target="#allloc" data-parent="#faq2">
                        <div class="panel-heading" role="tab" id="questionThree">
                            <h5 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#faq2" href="#allloc" aria-expanded="true" aria-controls="allloc">
                                    Locations
                                </a>
                            </h5>
                        </div>
                        <div id="allloc" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionThree">
                            <div class="panel-body"  style="max-height: 150px; overflow-y: auto;overflow-x: auto;">
                                @if(!empty($locations))
                                    @foreach ($locations as $loc)
                                            <label class="col-sm-6">
                                            <input type="checkbox" @if(!empty($menu_data[0]['menu_objects']['location']) && in_array($loc['loc_id'],$menu_data[0]['menu_objects']['location'] )) checked disabled @endif class="checkbox-dropdown-input addInMenuStructure" id="{{$loc['loc_id'] . "location"}}" name="menu[location][]"  data-type="location" data-titel="{{$loc['title']}}" value="{{$loc['loc_id']}}">
                                            {{$loc['title']}}
                                            </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" data-toggle="collapse" data-target="#allregion" data-parent="#faq2">
                        <div class="panel-heading" role="tab" id="questionThree">
                            <h5 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#faq2" href="#allregion" aria-expanded="true" aria-controls="allregion">
                                    Region
                                </a>
                            </h5>
                        </div>
                        <div id="allregion" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionThree">
                            <div class="panel-body"  style="max-height: 150px; overflow-y: auto;overflow-x: auto;">
                                @if(!empty($uniqueRegions))
                                    @foreach ($uniqueRegions as $key =>$region)
                                        @if($region != '')
                                            <label class="col-sm-6">
                                            <input type="checkbox" class="checkbox-dropdown-input addInMenuStructure" id="{{$region . "region"}}" name="menu[region][]"  data-type="region" data-titel="{{$region}}" value="{{$key}}">
                                            {{$region}}
                                            </label>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
                {{-- <div class="col-sm-6">
                    <div style="float: left;">
                        <span class="caption" style="width: 255px; display: block;">
                            Menu Structure
                        </span>
                        <div class="assigned-limit-box">

                            <div id="room_sort" class="list-group col p-2 ui-sortable">
                                @if(!empty($menu_data[0]['db_menu_objects']))
                                    @foreach ($menu_data[0]['db_menu_objects'] as $db_menu_objects)
                                    <div style='background-color: aliceblue; margin: 5px; position: relative; left: 0px; top: 0px;' id='{{$db_menu_objects['object_type'].$db_menu_objects['object_id']}}' class='list-group-item ui-sortable-handle' data-title='{{$db_menu_objects['object_title']}}'  data-type='{{$db_menu_objects['object_type']}}' data-id='{{$db_menu_objects['object_id']}}' >{{$db_menu_objects['object_title']}}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-sm-6">
                    <div class="float-right">
                        <h4>Menu structure</h4>
                    </div>
                    <div class="card-body">
                        <ul id="myEditor" class="sortableLists list-group col-sm-12">
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
