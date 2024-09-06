<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">{{ __('reset-password.title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="resetPasswordGlobalError"></div>
                <form id="resetPasswordForm" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ request('token') }}">

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="resetPasswordEmail" class="form-label">{{ __('reset-password.email') }}</label>
                        <input id="resetPasswordEmail" type="email" class="form-control" name="email" value="{{ old('email', request('email')) }}" required autofocus>
                        <div id="resetPasswordEmailError" class="alert alert-danger d-none"></div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="resetPasswordPassword" class="form-label">{{ __('reset-password.password') }}</label>
                        <input id="resetPasswordPassword" type="password" class="form-control" name="password" required>
                        <div id="resetPasswordPasswordError" class="alert alert-danger d-none"></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="resetPasswordPasswordConfirmation" class="form-label">{{ __('reset-password.password_confirmation') }}</label>
                        <input id="resetPasswordPasswordConfirmation" type="password" class="form-control" name="password_confirmation" required>
                        <div id="resetPasswordPasswordConfirmationError" class="alert alert-danger d-none"></div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">{{ __('reset-password.reset_password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
