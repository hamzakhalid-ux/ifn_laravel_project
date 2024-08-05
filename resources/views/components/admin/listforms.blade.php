<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Forms</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th >#</th>
                        <th>Form Name</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($all_forms))
                        @foreach($all_forms as $index=>$form)
                            <tr>
                                <td>{{$index+1}}.</td>
                                <td>{{$form->form_name}}</td>
                                <td>
                                    <a href="{{ route('admin.form.edit-form', ['form_id' => $form->form_id]) }}"><i class="fa fa-edit"></i>
                                        <a href="javascript:void(0)" class="deleteRecord" data-id="{{$form->form_id}}" used_at='form' data-route = 'delete_form'><i class="fa fa-trash" style="color:red"></i>
                                    </a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
