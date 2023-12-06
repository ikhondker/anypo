<!-- <span data-bs-toggle="modal" data-bs-target="#infoModal">
    <a class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Enable">
        <x-icons.enable :enable="$dept->enable"/>
    </a>
</span> -->


<!-- start infoModal -->
<div wire:ignore.self class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><x-icons.info/> Action Forbidden!1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Oppss!!!! We are sorry, but this action is not allowed by current user!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- end infoModal -->