@foreach($attributes as $attribute)
    <div class="modal fade" id="editAttributeModal{{ $attribute->id }}" tabindex="-1" aria-labelledby="editAttributeModalLabel{{ $attribute->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAttributeModalLabel{{ $attribute->id }}">{{__('attribute.attribute_edit')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('attributes.update', ['attribute' => $attribute->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('attribute.attribute_name') }}</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ ($attribute->name) }}" required>
                            @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('attribute.cancel')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('attribute.edit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

