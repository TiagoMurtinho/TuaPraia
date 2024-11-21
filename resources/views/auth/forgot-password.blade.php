<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">{{ __('forgot-password.forgot_password') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('forgot-password.description') }}
                </div>

                <div class="alert alert-success d-none" id="forgotPasswordSuccess"></div>
                <form class="ajax-form" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <label for="forgotPasswordModalEmail" class="form-label">{{ __('forgot-password.email') }}</label>
                        <input id="forgotPasswordModalEmail" type="email" class="form-control" name="email" required>
                        <div id="forgotPasswordModalEmailError" class="alert alert-danger mt-2 d-none"></div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="btn btn-primary">{{ __('forgot-password.send_link') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
