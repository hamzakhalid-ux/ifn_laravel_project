<div class="database m-t-50">
    <h3 class="label-title">
        DATABASE & DIRECTORY
    </h3>
    <h4>Overview of IFN Investor Fund Database</h4>
    <div class="stats">
        <div class="item">
            <p>TOTAL FUNDS</p>{{$reports['total_funds']}}
        </div>
        <div class="item">
            <p>TOTAL AUM</p>US$ {{$reports['total_amount_funds']}}
        </div>
        <div class="item">
            <p>TOTAL COMPANIES</p>{{$reports['total_companies']}}
        </div>
    </div>
    <div class="main-grid">
        <div class="graph-wrapper">
            <h5>Total Funds By Sector / Asset Class</h5>
            <div class="graph">
                <div id="barChart"></div>
            </div>
            <a href="{{url('/subscriber-fund-list')}}" class="btn btn-secondary w-100 sm text-transform-normal" title="Go To Fund Database">Go To Fund Database</a>
        </div>
        <div class="graph-wrapper">
            <h5>Total Funds By Region</h5>
            <div class="graph">
                <div id="polarChart"></div>
            </div>
            <a href="{{url('/directory-list')}}" class="btn btn-secondary w-100 sm text-transform-normal" title="Go To Fund Directory">Go To Fund Directory</a>
        </div>
    </div>
</div>

<script>  

result_reigon = {!! json_encode($chart_data) !!}

</script>
