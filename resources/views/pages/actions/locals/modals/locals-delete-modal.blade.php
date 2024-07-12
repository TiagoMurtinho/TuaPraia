<div class="modal fade" id="deleteLocalModal{{ $local->id }}" tabindex="-1" aria-labelledby="deleteLocalModalLabel{{ $local->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLocalModalLabel{{ $local->id }}">{{__('local.delete_local')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{__('local.sure_to_delete')}} "{{ $local->name }}" ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('local.cancel')}}</button>
                <form id="deleteLocalForm{{ $local->id }}" action="{{ route('locals.destroy', $local->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{__('local.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
