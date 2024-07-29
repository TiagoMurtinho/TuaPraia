<div class="modal fade" id="deleteDistrictModal{{ $district->id }}" tabindex="-1" aria-labelledby="deleteDistrictModalLabel{{ $district->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDistrictModalLabel{{ $district->id }}">{{ __('district.delete_district') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('district.sure_to_delete')}} "{{$district->name}}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('district.cancel') }}</button>
                <form id="deleteDistrictForm{{ $district->id }}" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('district.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
