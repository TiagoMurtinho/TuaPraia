@foreach($districts as $district)
    <div class="modal fade" id="editDistrictModal{{ $district->id }}" tabindex="-1" aria-labelledby="editDistrictModalLabel{{ $district->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDistrictModalLabel{{ $district->id }}">{{ __('district.edit_district') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('districts.update', ['district' => $district->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('district.name') }}</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ ($district->name) }}" required>
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
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('district.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('district.edit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

