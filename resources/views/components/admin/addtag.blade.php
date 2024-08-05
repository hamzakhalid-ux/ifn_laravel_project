<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{(!empty($tag)) ? 'Update Tag' : 'Add Tag'}}</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{(!empty($tag)) ? url('admin/update-tag') : url('admin/store-tag')  }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <input type="hidden" name="tag[id]" value="{{(!empty($tag)) ? $tag[0]['id'] : ''}}">
                    <label for="cat_name" class="col-sm-2 col-form-label">Tag
                         Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="tag[title]" required value="{{(!empty($tag)) ? $tag[0]['title'] : ''}}" class="form-control" id="cat_name" placeholder="Tag Name">
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Publish</button>
                                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

            </div>
        </form>
    </div>
</div>
