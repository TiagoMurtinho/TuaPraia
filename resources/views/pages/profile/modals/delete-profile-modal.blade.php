<div class="modal fade" id="deleteProfileModal" tabindex="-1" aria-labelledby="deleteProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"> {{ __('profile.delete_account') }}</h5>
            </div>

            <div class="modal-body">
                <div id="deleteProfileMessage" class="d-none"></div>
                <!-- Mensagem de erro será exibida aqui -->
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <!-- Mensagem de erro será exibida aqui -->
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <!-- Mensagem de sucesso será exibida aqui -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('profile.destroy', Auth::id()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('profile.confirm_password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-danger">{{ __('profile.delete_account') }}</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Os botões são atualizados via JavaScript -->
            </div>

        </div>
    </div>
</div>
