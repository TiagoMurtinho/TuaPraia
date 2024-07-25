<div class="modal fade" id="addLocalModal" tabindex="-1" aria-labelledby="addLocalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLocalModalLabel">{{ __('local.add_local') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLocalForm" method="POST" action="{{ route('locals.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="addLocalModalName" class="form-label">{{ __('local.local_name') }}</label>
                        <input id="addLocalModalName" class="form-control" type="text" name="name">
                        <div id="addLocalModalNameError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="addLocalModalDescription" class="form-label">{{ __('local.description') }}</label>
                        <textarea id="addLocalModalDescription" class="form-control" name="description" rows="3"></textarea>
                        <div id="addLocalModalDescriptionError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="addLocalModalCoordinates" class="form-label">{{ __('local.coordinates') }}</label>
                        <input id="addLocalModalCoordinates" class="form-control" type="text" name="coordinates">
                        <div id="addLocalModalCoordinatesError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="addLocalModalType" class="form-label">{{ __('local.type') }}</label>
                        <select id="addLocalModalType" class="form-select" name="type">
                            @foreach(\App\Models\Local::LOCALTYPES as $type)
                                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                        <div id="addLocalModalTypeError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="addLocalModalDistrict" class="form-label">{{ __('local.district') }}</label>
                        <select id="addLocalModalDistrict" class="form-select" name="districts_id">
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        <div id="addLocalModalDistricts_idError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label for="addLocalModalRegion" class="form-label">{{ __('local.region') }}</label>
                        <select id="addLocalModalRegion" class="form-select" name="regions_id">
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                        <div id="addLocalModalRegions_idError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="mb-3">
                        <label>{{ __('local.attributes') }}</label>
                        @foreach($attributes as $attribute)
                            <div class="form-check">
                                <input type="checkbox" id="addLocalModalAttribute_{{ $attribute->id }}" name="attributes[]" value="{{ $attribute->id }}" class="form-check-input">
                                <label for="addLocalModalAttribute_{{ $attribute->id }}" class="form-check-label">{{ $attribute->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="addLocalModalMedia" class="form-label">{{ __('local.media') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="addLocalModalMedia" name="media">
                            <label class="custom-file-label" for="addLocalModalMedia">Escolher arquivo...</label>
                            <div id="addLocalModalMediaError" class="alert alert-danger mt-2 d-none"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('local.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('local.add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
