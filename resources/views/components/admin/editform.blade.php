<div class="container" style="width: 100%">
    <div class="card card-info">
        <div class="card-header  text-white">
            <h3 class="card-title">Add Form</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/form/update-form') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value='{{ intval(count($form_data) + 1) }}' id="count_index">
            <input type="hidden" value='{{ $form_data['form_id'] ?? '' }}' name="form_id" id="">
            <div class="card-body row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="label">Form name:</label>
                        <input type="text" class="form-control" id="" value="{{ $form_data['form_name'] }}" name="form_name" required placeholder="Enter Form Name">
                    </div>
                    <div class="form-group row">
                        <ul class="list-inline" style="padding: 0;">
                            @foreach($form_fields as $field)
                                <li style="margin: 10px;">
                                    <button type="button" class="btn btn-primary formmodel"  data-toggle="modal" data-target="#formModel" style="width: 150px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" data-field_id="{{$field->id}}" data-field_type="{{$field->field_type}}" >{{ strtoupper($field->field_type) }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="text-align: right;">
                <button type="submit" class="btn btn-info">Publish</button>
                <a href="#" class="btn btn-default">Cancel</a>
            </div>
            <div class="card-body row" id="form_structure">
                @if(!empty($form_data['form_fields']))
                @foreach ($form_data['form_fields'] as $index=>$form_field)
                <div class="form-group row" style="display: flex; align-items: center; margin: 10px">
                    <label for="label" class="col-sm-2">{{ (($form_field['field_label'] === '') ? strtoupper($form_field['field_type']) : strtoupper($form_field['field_label'])) }}:</label>
                    <input type="{{$form_field['field_type'] ?? ''}}" disabled class="form-control col-sm-10" id="" name="label" placeholder="{{strtoupper($form_field['field_type'])}} Field:">
                    <input type="hidden" value="{{$form_field['field_id']}}" name="form_fields[{{ $index }}][field_id]">
                    <input type="hidden" value="{{$form_field['field_type'] ?? ''}}" name="form_fields[{{ $index }}][field_type]">
                    <input type="hidden" value="{{$form_field['field_label']}}" name="form_fields[{{ $index }}][field_label]">
                    <input type="hidden" value="{{$form_field['field_class']}}" name="form_fields[{{ $index }}][field_class]">
                    <input type="hidden" value="{{$form_field['field_required']}}" name="form_fields[{{ $index }}][field_required]">
                    <button type="button" style="margin-left: 15px" class=" col-sm-1 btn btn-danger btn-sm delete-field" data-index="{{ $index }}" onclick="deleteField(this)"><i class="fa fa-times"></i></button>
                </div>
                @endforeach
                @endif
            </div>
        </form>

    </div>
</div>
<div class="modal fade" id="formModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" >Form Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="label">Input Label:</label>
                    <input type="text" class="form-control" id="field_label" name="label" placeholder="Enter Label">
                </div>
                <div class="form-group">
                    <label for="class">Input Class:</label>
                    <input type="text" class="form-control" id="field_class" name="class" placeholder="Enter Class">
                </div>
                <div class="form-group">
                    <label for="class">Input Name:</label>
                    <input type="text" class="form-control" id="field_name" name="class" placeholder="Enter Name">
                </div>
                <div class="form-group form-inline row">
                    <label class="mr-2 col-sm-2">Required:</label>
                    <div class="form-check col-sm-3">
                        <input class="form-check-input" type="radio" name="required" id="requiredYes" value="1">
                        <label class="form-check-label mr-3" for="requiredYes">Yes</label>
                    </div>
                    <div class="form-check col-sm-3">
                        <input class="form-check-input" type="radio" name="required" id="requiredNo" value="0" checked>
                        <label class="form-check-label" for="requiredNo">No</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" data-dismiss="modal" class="btn btn-primary saveFieldRecord">Save changes</button>
            </div>
        </div>
    </div>
</div>
