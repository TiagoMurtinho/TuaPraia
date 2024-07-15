<div class="modal fade" id="addDistrictModal" tabindex="-1" aria-labelledby="addDistrictModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDistrictModalLabel">{{ __('district.add_district') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('districts.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('district.name') }}</label>
                        <input id="name" class="form-control" type="text" name="name" required>
                        @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="region" class="form-label">{{ __('district.region') }}</label>
                        <select name="regions_id" id="region" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            @foreach($regions as $region)
                                <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
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