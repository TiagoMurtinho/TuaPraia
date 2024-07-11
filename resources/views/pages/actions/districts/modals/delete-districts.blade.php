<div class="modal fade" id="deleteDistrictModal" tabindex="-1" aria-labelledby="deleteDistrictModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDistrictModalLabel">{{ __('district.delete_district') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('district.Are_you_sure_you_want_to_delete_this_attribute?')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('district.cancel') }}</button>
                <form id="deleteDistrictForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('district.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
