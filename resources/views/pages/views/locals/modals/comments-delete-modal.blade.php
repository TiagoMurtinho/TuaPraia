<div class="modal fade" id="deleteCommentModal{{ $feedback->id }}" tabindex="-1" aria-labelledby="deleteCommentModalLabel{{ $feedback->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCommentModalLabel{{ $feedback->id }}">{{ __('local.delete_comment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('local.sure_to_delete_comment') }} "{{ Str::limit($feedback->comment, 50) }}" ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('local.cancel') }}</button>
                <form id="deleteCommentForm{{ $feedback->id }}" action="{{ route('feedback.destroy', $feedback->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('local.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
