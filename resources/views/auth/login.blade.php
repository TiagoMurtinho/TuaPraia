<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">{{ __('login.login') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="loginModalGlobalError"></div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <label for="loginModalEmail" class="form-label">{{ __('login.email') }}</label>
                        <input id="loginModalEmail" type="text" class="form-control" name="email">
                        <div id="loginModalEmailError" class="alert alert-danger d-none"></div>
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <label for="loginModalPassword" class="form-label">{{ __('login.password') }}</label>
                        <input id="loginModalPassword" type="password" class="form-control" name="password">
                        <div id="loginModalPasswordError" class="alert alert-danger d-none"></div>
                    </div>
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span class="ms-2 text-sm">{{ __('login.remember') }}</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="#" id="forgotPasswordLink">{{ __('login.forgot_password') }}</a>
                        <button type="submit" class="btn btn-primary ms-3">{{ __('login.go_in') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
