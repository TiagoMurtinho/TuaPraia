<div class="modal fade" id="editProfilePhotoModal" tabindex="-1" aria-labelledby="editProfilePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfilePhotoModalLabel">{{ __('profile.update_profile_photo') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfilePhotoForm" method="POST" action="{{ route('profile.update.photo', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="editProfilePhotoModalMedia" class="form-label">{{ __('local.media') }}</label>
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" id="editProfilePhotoModalMedia" name="media">
                            <label class="custom-file-label" for="editProfilePhotoModalMedia">
                                {{ $user->getFirstMediaUrl('users') ? $user->name : 'Escolher arquivo...' }}
                            </label>
                        </div>
                        <div id="editProfilePhotoModalMediaError" class="alert alert-danger mt-2 d-none"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('profile.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('profile.upload_photo') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
