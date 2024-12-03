<div class="modal fade" id="addAttributeModal" tabindex="-1" aria-labelledby="addAttributeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAttributeModalLabel">{{ __('attribute.add_attribute') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('attribute.description') }}
                </div>

                <form method="POST" action="{{ route('attributes.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="addAttributeModalName" class="form-label">{{ __('attribute.attribute_name') }}</label>
                        <input id="addAttributeModalName" class="form-control" type="text" name="name">
                        <div id="addAttributeModalNameError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('attribute.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('attribute.add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
