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
            <h3 class="card-title">All Ads</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 100px">Ad Title</th>
                        <th style="width: 100px">Ad Type</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($all_ads))
                    @foreach($all_ads as $index=>$ad)
                        <tr>
                            <td>{{$index+1}}.</td>
                            <td>{{$ad['ad_title']}}</td>
                            <td>{{$section[$ad['ad_type']]}}</td>
                            <td>
                                <a href="{{ route('admin.ads.edit-ads', ['ads_id' => $ad['ad_id']]) }}"><i class="fa fa-edit"></i>
                                <a href="javascript:void(0)" class="deleteRecord" data-id="{{$ad['ad_id']}}" used_at='ads' data-route='delete_ads'><i class="fa fa-trash" style="color:red"></i>
                            </a></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
