<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Custom Deals</h3>
        </div>
        <?php
        $session_user = session()->get('userData');
        ?>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Package Name</th>
                        <th>Custom Deal count </th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($custom_deals))
                        @foreach($custom_deals as $index=>$deal)
                            <tr>
                                <td>{{$index+1}}.</td>
                                <td>{{$deal->package_detail->package_name}}</td>
                                <td>{{count($deal->default_deals)}}</td>
                                <td>
                                    <a href="{{ route('admin.deal.edit-deal', ['deal_id' => $deal->deal_id ]) }}"><i class="fa fa-edit"></i>
                                        <a href="javascript:void(0)" class="deleteRecord" data-id="{{$deal->deal_id}}" used_at='deal' data-route = 'delete_deal'><i class="fa fa-trash" style="color:red"></i>
                                    </a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
