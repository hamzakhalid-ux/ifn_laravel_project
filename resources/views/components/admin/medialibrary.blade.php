<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Media Library</h3>
        </div>
        {{-- <form action="{{  url('admin/media/store-images') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="images[]" multiple>
            <button type="submit">Upload Images</button>
        </form> --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <form action="{{ url('admin/media/store-images') }}" method="POST" enctype="multipart/form-data" class="custom-form">
                        @csrf
                        {{-- <input type="file" name="images[]" multiple> --}}
                        <div class="form-group">
                            <label for="images">Choose Images:</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse&hellip; <input type="file" id="imageInput" name="images[]" multiple accept="image/jpeg,image/png">
                                    </span>
                                </span>
                                <input type="text" id="selectedImages" class="form-control" readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Images</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
