<div class="modal fade" id="deleteRegionModal" tabindex="-1" aria-labelledby="deleteRegionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRegionModalLabel">{{__('region.delete_region')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{__('region.sure_to_delete')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('region.cancel')}}</button>
                <form id="deleteRegionForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{__('region.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
