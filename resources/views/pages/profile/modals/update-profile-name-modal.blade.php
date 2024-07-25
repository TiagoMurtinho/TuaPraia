<div class="modal fade" id="editProfileInfoModal" tabindex="-1" aria-labelledby="editProfileInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileInfoModalLabel">{{ __('profile.edit_profile') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileInfoForm" method="POST" action="{{ route('profile.update.name', ['id' => $user->id]) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="editProfileInfoModalProfile_name" class="form-label">{{ __('profile.profile_name') }}</label>
                        <input id="editProfileInfoModalProfile_name" class="form-control" type="text" name="profile_name" value="{{ old('profile_name', $user->name) }}">
                        <div id="editProfileInfoModalProfile_nameError" class="alert alert-danger mt-2 d-none"></div> <!-- Specific error container -->
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
