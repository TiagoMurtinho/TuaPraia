<div class="modal fade" id="deleteAttributeModal{{ $attribute->id }}" tabindex="-1" aria-labelledby="deleteAttributeModalLabel{{ $attribute->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAttributeModalLabel{{ $attribute->id }}">{{__('attribute.attribute_delete')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{__('attribute.sure_to_delete')}} "{{ $attribute->name }}" ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('attribute.cancel')}}</button>
                <form class="ajax-form" id="deleteAttributeForm{{ $attribute->id }}" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{__('attribute.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
