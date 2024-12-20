@foreach($regions as $region)
    <div class="modal fade dynamic-modal" id="editRegionModal{{ $region->id }}" tabindex="-1" aria-labelledby="editRegionModalLabel{{ $region->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRegionModalLabel{{ $region->id }}">{{ __('region.edit_region') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('regions.update', ['region' => $region->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">

                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('region.description') }}
                        </div>

                        <div class="mb-3">
                            <label for="editRegionModalName{{ $region->id }}" class="form-label">{{ __('region.region_name') }}</label>
                            <input id="editRegionModalName{{ $region->id }}" class="form-control" type="text" name="name" value="{{ $region->name }}">
                            <div id="editRegionModal{{ $region->id }}NameError" class="alert alert-danger mt-2 d-none"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('region.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('region.edit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
