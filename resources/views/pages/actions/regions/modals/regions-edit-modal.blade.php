@foreach($regions as $region)
    <div class="modal fade" id="editRegionModal{{ $region->id }}" tabindex="-1" aria-labelledby="editRegionModalLabel{{ $region->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRegionModalLabel{{ $region->id }}">{{__('region.edit_region')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('regions.update', ['region' => $region->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('region.region_name') }}</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ ($region->name) }}" required>
                            @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('region.add')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('region.edit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
