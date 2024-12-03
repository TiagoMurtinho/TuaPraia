<div class="modal fade dynamic-modal" id="editLocalModal{{ $local->id }}" tabindex="-1" aria-labelledby="editLocalModalLabel{{ $local->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLocalModalLabel{{ $local->id }}">{{ __('local.edit_local') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('local.modal_description') }}
                </div>

                <form id="editLocalForm{{ $local->id }}" method="POST" action="{{ route('locals.update', $local->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editLocalModalName{{ $local->id }}" class="form-label">{{ __('local.local_name') }}</label>
                        <input id="editLocalModalName{{ $local->id }}" class="form-control" type="text" name="name" value="{{ $local->name }}">
                        <div id="editLocalModal{{ $local->id }}NameError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editLocalModalDescription{{ $local->id }}" class="form-label">{{ __('local.local_description') }}</label>
                        <textarea id="editLocalModalDescription{{ $local->id }}" class="form-control" name="description" rows="3">{{ $local->description }}</textarea>
                        <div id="editLocalModal{{ $local->id }}DescriptionError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editLocalModalCoordinates{{ $local->id }}" class="form-label">{{ __('local.local_coordinates') }}</label>
                        <input id="editLocalModalCoordinates{{ $local->id }}" class="form-control" type="text" name="coordinates" value="{{ $local->coordinates }}">
                        <div id="editLocalModal{{ $local->id }}CoordinatesError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editLocalModalType{{ $local->id }}" class="form-label">{{ __('local.local_type') }}</label>
                        <select id="editLocalModalType{{ $local->id }}" class="form-select" name="type">
                            @foreach(\App\Models\Local::LOCALTYPES as $type)
                                <option value="{{ $type }}" {{ $type == $local->type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                        <div id="editLocalModal{{ $local->id }}TypeError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editLocalModalDistrict{{ $local->id }}" class="form-label">{{ __('local.local_district') }}</label>
                        <select id="editLocalModalDistrict{{ $local->id }}" class="form-select" name="districts_id">
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ $district->id == $local->districts_id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                        <div id="editLocalModal{{ $local->id }}Districts_idError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editLocalModalRegion{{ $local->id }}" class="form-label">{{ __('local.local_region') }}</label>
                        <select id="editLocalModalRegion{{ $local->id }}" class="form-select" name="regions_id">
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}" {{ $region->id == $local->regions_id ? 'selected' : '' }}>{{ $region->name }}</option>
                            @endforeach
                        </select>
                        <div id="editLocalModal{{ $local->id }}Regions_idError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('local.attributes') }}</label>
                        @foreach($attributes as $attribute)
                            <div class="form-check">
                                <input type="checkbox" id="editLocalModalAttribute_{{ $attribute->id }}" name="attributes[]" value="{{ $attribute->id }}" {{ $local->attributes->contains($attribute->id) ? 'checked' : '' }} class="form-check-input">
                                <label for="editLocalModalAttribute_{{ $attribute->id }}" class="form-check-label">{{ $attribute->name }}</label>
                            </div>
                        @endforeach
                        <div id="editLocalModal{{ $local->id }}AttributesError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="editLocalModalMedia{{ $local->id }}" class="form-label">{{ __('local.media') }}</label>
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" id="editLocalModalMedia{{ $local->id }}" name="media">
                            <label class="custom-file-label" for="editLocalModalMedia{{ $local->id }}">
                                {{ $local->getFirstMediaUrl('locals') ? 'Arquivo atual: ' . $local->name : 'Escolher arquivo...' }}
                            </label>
                        </div>
                        <div id="editLocalModal{{ $local->id }}MediaError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('local.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('local.edit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
