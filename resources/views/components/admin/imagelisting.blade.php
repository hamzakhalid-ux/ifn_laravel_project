<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Library</h3>
        </div>
    </div>
    <div class="row">
        @if(!empty($all_images))
        @foreach ($all_images as $images)
            @foreach ($images as $img)
                @if($img['size_number'] =='l')
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail image-thumbnail" data-toggle="modal" data-target="#imageModal" data-image-name="{{ $img['image_name'] }}">
                        <img src="{{ asset('media/' . $img['image_name']) }}" alt="..." data-image-sizes="{{ json_encode($images) }}" style="height: 180px; width: 100%; display: block;">
                        <span class="delete-icon glyphicon glyphicon-remove-circle"></span>
                    </a>
                </div>
                @endif
            @endforeach
        @endforeach
        @endif
    </div>
</div>
@include('components/admin/imagedetailmodel')
