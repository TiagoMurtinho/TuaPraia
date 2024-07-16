<div class="modal fade" id="editLocalModal{{ $local->id }}" tabindex="-1" aria-labelledby="editLocalModalLabel{{ $local->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLocalModalLabel{{ $local->id }}">{{ __('local.edit_local') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('locals.update', $local->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('local.local_name') }}</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ $local->name }}" required>
                        @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('local.description') }}</label>
                        <textarea id="description" class="form-control" name="description" rows="3">{{ $local->description }}</textarea>
                        @error('description')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="coordinates" class="form-label">{{ __('local.coordinates') }}</label>
                        <input id="coordinates" class="form-control" type="text" name="coordinates" value="{{ $local->coordinates }}">
                        @error('coordinates')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">{{ __('local.type') }}</label>
                        <select id="type" class="form-select" name="type">
                            @foreach(\App\Models\Local::LOCALTYPES as $type)
                                <option value="{{ $type }}" {{ $type == $local->type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="districts_id" class="form-label">{{ __('local.district') }}</label>
                        <select id="districts_id" class="form-select" name="districts_id" required>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ $district->id == $local->districts_id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                        @error('districts_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="regions_id" class="form-label">{{ __('local.region') }}</label>
                        <select id="regions_id" class="form-select" name="regions_id" required>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}" {{ $region->id == $local->regions_id ? 'selected' : '' }}>{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @error('regions_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>{{ __('local.attributes') }}</label>
                        @foreach($attributes as $attribute)
                            <div class="form-check">
                                <input type="checkbox" id="attribute_{{ $attribute->id }}" name="attributes[]" value="{{ $attribute->id }}" {{ $local->attributes->contains($attribute->id) ? 'checked' : '' }} class="form-check-input">
                                <label for="attribute_{{ $attribute->id }}" class="form-check-label">{{ $attribute->name }}</label>
                            </div>
                        @endforeach
                        @error('attributes')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="media" class="form-label">{{ __('local.media') }}</label>
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" id="media_{{ $local->id }}" name="media">
                            <label class="custom-file-label" for="media_{{ $local->id }}">
                                {{ $local->getFirstMediaUrl('locals') ? $local->name : 'Escolher arquivo...' }}
                            </label>
                        </div>
                        @error('media')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
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
