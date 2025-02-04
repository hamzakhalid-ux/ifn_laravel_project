<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="imageModalLabel">Image Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="modalImage" src="" alt="Selected Image" style="width: 100%;">
                    </div>
                    <div class="col-md-6">
                        <p><strong>Large Image URL:</strong></p>
                        <p id="imageUrl_l"></p>

                        <p><strong>Medium Image URL:</strong></p>
                        <p id="imageUrl_m"></p>

                        <p><strong>Small Image URL:</strong></p>
                        <p id="imageUrl_s"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
