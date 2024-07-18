<div class="modal fade" id="editProfilePasswordModal" tabindex="-1" aria-labelledby="editProfilePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfilePasswordModalLabel">{{ __('profile.edit_profile_password') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profile.update.password', ['id' => $user->id]) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">{{ __('profile.current_password') }}</label>
                        <input id="current_password" class="form-control" type="text" name="current_password" required>
                        @error('current_password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">{{ __('profile.new_password') }}</label>
                        <input id="new_password" class="form-control" type="text" name="new_password" required>
                        @error('new_password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">{{ __('profile.confirm_new_password') }}</label>
                        <input id="new_password_confirmation" class="form-control" type="text" name="new_password_confirmation" required>
                        @error('new_password_confirmation')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
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
