<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Filter Setting</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Company Name</th>
                        <th>Template </th>
                        <th>Yearly</th>
                        <th>Tag</th>
                        <th>Location</th>
                        <th>Category</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($settings))
                        @foreach($settings as $index=>$setting)
                            <tr>
                                <td>{{$index+1}}.</td>
                                <td>
                                    @if(!empty($setting['category_detail']['title']))
                                    {{  $setting['category_detail']['title'] ?? ''}}
                                    @elseif (!empty($setting['tag_detail']['title']))
                                    {{  $setting['tag_detail']['title'] ?? ''}}
                                    @elseif (!empty($setting['loc_detail']['title']))
                                    {{ $setting['loc_detail']['title'] ?? ''}}
                                    @endif
                                </td>
                                <td>{{strtoupper($setting['template'])}}</td>
                                <td>{{($setting['yearly'] == 1) ? 'Yes' : 'NO'}}</td>
                                <td>{{($setting['tag'] == 1) ? 'Yes' : 'NO'}}</td>
                                <td>{{($setting['location'] == 1) ? 'Yes' : 'NO'}}</td>
                                <td>{{($setting['category'] == 1) ? 'Yes' : 'NO'}}</td>

                                <td>
                                    <a href="{{ route('admin.setting.edit-filter-setting', ['filter_setting_id' => $setting['filter_setting_id']]) }}"><i class="fa fa-edit"></i>
                                        <a href="javascript:void(0)" class="deleteRecord" data-id="{{$setting['filter_setting_id']}}" used_at='filter_setting' data-route = 'delete_filter_setting'><i class="fa fa-trash" style="color:red"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
