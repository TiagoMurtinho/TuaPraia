document.addEventListener('DOMContentLoaded', function() {
    // Obter o modal
    const loginModal = document.getElementById('loginModal');

    // Verificar se o modal foi encontrado
    if (loginModal) {
        // Obter ou criar uma instância do modal usando o Bootstrap
        var modal = bootstrap.Modal.getOrCreateInstance(loginModal);

        // Adicionar evento de clique no botão de login no dropdown
        const signInButton = document.querySelector('[data-bs-target="#loginModal"]');
        if (signInButton) {
            signInButton.addEventListener('click', function(event) {
                event.preventDefault();
                modal.show();
            });
        }
    } else {
        console.error('Modal not found or could not be initialized.');
    }
});
