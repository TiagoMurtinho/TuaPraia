<div class="modal fade" id="addDistrictModal" tabindex="-1" aria-labelledby="addDistrictModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDistrictModalLabel">{{ __('district.add_district') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDistrictForm" method="POST" action="{{ route('districts.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="addDistrictModalName" class="form-label">{{ __('district.district_name') }}</label>
                        <input id="addDistrictModalName" class="form-control" type="text" name="name">
                        <div id="addDistrictModalNameError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="addDistrictModalRegion" class="form-label">{{ __('district.district_region') }}</label>
                        <select name="regions_id" id="addDistrictModalRegion" class="form-select form-select-sm">
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                        <div id="addDistrictModalRegions_idError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('district.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('district.add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
