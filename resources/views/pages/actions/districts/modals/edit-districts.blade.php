@foreach($districts as $district)
    <div class="modal fade dynamic-modal" id="editDistrictModal{{ $district->id }}" tabindex="-1" aria-labelledby="editDistrictModalLabel{{ $district->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDistrictModalLabel{{ $district->id }}">{{ __('district.edit_district') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('district.description') }}
                    </div>

                    <form id="editDistrictForm{{ $district->id }}" method="POST" action="{{ route('districts.update', ['district' => $district->id]) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="editDistrictModalName{{ $district->id }}" class="form-label">{{ __('district.district_name') }}</label>
                            <input id="editDistrictModalName{{ $district->id }}" class="form-control" type="text" name="name" value="{{ $district->name }}" required>
                            <div id="editDistrictModal{{ $district->id }}NameError" class="alert alert-danger mt-2 d-none"></div>
                        </div>

                        <div class="mb-3">
                            <label for="editDistrictModalRegion{{ $district->id }}" class="form-label">{{ __('district.district_region') }}</label>
                            <select name="regions_id" id="editDistrictModalRegion{{ $district->id }}" class="form-select form-select-sm">
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ $region->id == $district->regions_id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                            <div id="editDistrictModal{{ $district->id }}Region_idError" class="alert alert-danger mt-2 d-none"></div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('district.cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('district.edit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

