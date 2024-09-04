<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">{{ __('register.register') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="registerModalName" class="form-label">{{ __('register.name') }}</label>
                        <input id="registerModalName" type="text" class="form-control" name="name">
                        <div id="registerModalNameError" class="alert alert-danger d-none mt-2"></div>
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="registerModalEmail" class="form-label">{{ __('register.email') }}</label>
                        <input id="registerModalEmail" type="text" class="form-control" name="email">
                        <div id="registerModalEmailError" class="alert alert-danger d-none mt-2"></div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="registerModalRegister-password" class="form-label">{{ __('register.password') }}</label>
                        <input id="registerModalRegister-password" type="password" class="form-control" name="password">
                        <div id="registerModalPasswordError" class="alert alert-danger d-none mt-2"></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="registerModalPassword_confirmation" class="form-label">{{ __('register.confirm_password') }}</label>
                        <input id="registerModalPassword_confirmation" type="password" class="form-control" name="password_confirmation">
                        <div id="registerModalPasswordConfirmationError" class="alert alert-danger d-none mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label for="registerModalMedia" class="form-label">{{ __('register.upload') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="registerModalMedia" name="media" accept="image/*">
                            <label class="custom-file-label" for="registerModalMedia">{{ __('register.upload_photo') }}</label>
                        </div>
                        <div class="alert alert-danger d-none mt-2" id="registerModalMediaError"></div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('register.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('register.confirm_register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

