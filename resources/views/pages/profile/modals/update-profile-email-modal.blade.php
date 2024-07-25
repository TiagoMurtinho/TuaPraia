<div class="modal fade" id="editProfileEmailModal" tabindex="-1" aria-labelledby="editProfileEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileEmailModalLabel">{{ __('profile.edit_profile') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileEmailForm" method="POST" action="{{ route('profile.update.email', ['id' => $user->id]) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="editProfileEmailModalProfile_email" class="form-label">{{ __('profile.email') }}</label>
                        <input id="editProfileEmailModalProfile_email" class="form-control" type="text" name="profile_email" value="{{ old('profile_email', $user->email) }}" required>
                        <div id="editProfileEmailModalProfile_emailError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('profile.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('profile.save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
