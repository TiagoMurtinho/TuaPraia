<div class="modal fade" id="addRegionModal" tabindex="-1" aria-labelledby="addRegionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRegionModalLabel">{{ __('region.add_region') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('region.description') }}
                </div>

                <form method="POST" action="{{ route('regions.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="addRegionModalName" class="form-label">{{ __('region.region_name') }}</label>
                        <input id="addRegionModalName" class="form-control" type="text" name="name">
                        <div id="addRegionModalNameError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('region.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('region.add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
