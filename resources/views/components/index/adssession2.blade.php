<div class="main-grid sponsors m-t-40">
    @if(!empty($admapper['section_2']))
        @foreach ($admapper['section_2'] as $index=>$ads)
            @if($index == 2)
                @break
            @endif
            <a href="{{$ads['ad_link']}}" target="_blank">
            <div class="image">
                <img style="width: 85%;" src="{{ asset('ads_images/' . $ads['ad_image']) }}" alt="ICIEC logo">
            </div>
            </a>
        @endforeach
    @endif
</div>
