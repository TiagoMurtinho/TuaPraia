<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="registerModalName" class="form-label">{{ __('Name') }}</label>
                        <input id="registerModalName" type="text" class="form-control" name="name" required autofocus autocomplete="name">
                        <div id="registerModalNameError" class="alert alert-danger d-none mt-2"></div>
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="registerModalEmail" class="form-label">{{ __('Email') }}</label>
                        <input id="registerModalEmail" type="text" class="form-control" name="email" required autocomplete="email">
                        <div id="registerModalEmailError" class="alert alert-danger d-none mt-2"></div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="registerModalRegister-password" class="form-label">{{ __('Password') }}</label>
                        <input id="registerModalRegister-password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        <div id="registerModalPasswordError" class="alert alert-danger d-none mt-2"></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="registerModalPassword_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="registerModalPassword_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <div id="registerModalPasswordConfirmationError" class="alert alert-danger d-none mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label for="registerModalPhoto" class="form-label">{{ __('Upload de Imagem') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="registerModalPhoto" name="photo" accept="image/*">
                            <label class="custom-file-label" for="photo">Escolher arquivo...</label>
                        </div>
                        <div class="alert alert-danger d-none mt-2" id="registerModalPhotoError"></div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

