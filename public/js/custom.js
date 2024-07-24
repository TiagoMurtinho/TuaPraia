/*
    Esta função recebe 2 parâmetros, "formID" e "url"
    - formId: o ID do formulário a ser modificado.
    - url: a URL para a qual o formulário será enviado quando submetido.
    Por exemplo :
    onclick="confirmDelete('deleteRegionForm','{{ route('regions.destroy', $region->id) }}')
*/

function confirmDelete(formId, url) {
    document.getElementById(formId).action = url;
}

/*
    Este código aguarda o carregamento completo do DOM antes de executar.
    Ele seleciona todos os elementos com a classe 'custom-file-input' e adiciona um evento de 'change' a cada um deles.
    Quando um arquivo é selecionado:
    - Atualiza o texto do rótulo adjacente com o nome do arquivo escolhido.
    Se nenhum arquivo for selecionado:
    - Verifica se há uma imagem com a classe 'img-thumbnail' e, se existir, usa seu atributo 'alt' como texto do rótulo;
    - Se não houver imagem, define um texto padrão 'Escolher arquivo...'.
    Se o input ou o rótulo não forem encontrados, registra uma mensagem no console.
*/

document.addEventListener('DOMContentLoaded', function() {

    document.querySelectorAll('.custom-file-input').forEach(function(mediaInput) {
        const mediaLabel = mediaInput.nextElementSibling;

        if (mediaInput && mediaLabel) {

            mediaInput.addEventListener('change', function() {

                if (mediaInput.files.length > 0) {
                    mediaLabel.textContent = mediaInput.files[0].name; // Atualiza o texto com o nome do arquivo
                } else {
                    const existingImageAlt = document.querySelector('img.img-thumbnail') ? document.querySelector('img.img-thumbnail').alt : 'Escolher arquivo...';
                    console.log('No file selected, setting label to:', existingImageAlt);
                    mediaLabel.textContent = existingImageAlt; // Texto padrão ou alt da imagem existente
                }
            });
        } else {
            console.log('Media input or label not found for:', mediaInput.id);
        }
    });
});

/*document.querySelectorAll('.dropdown-submenu a').forEach(function (submenuToggle) {
    submenuToggle.addEventListener('click', function (e) {
        e.preventDefault();
        const submenu = submenuToggle.nextElementSibling;
        submenu.classList.toggle('show');
    });
});*/

$(document).ready(function() {
    function handleFormSubmission(modalId, isGlobal) {
        var $modal = $('#' + modalId);
        var $form = $modal.find('form');
        var $globalError = $modal.find('#' + modalId + 'GlobalError');

        $form.on('submit', function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            var actionUrl = $form.attr('action');

            // Limpa erros anteriores
            $modal.find('.alert.alert-danger').empty().addClass('d-none');

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: new FormData($form[0]),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    console.log('Erro de validação:', xhr.responseJSON); // Debug: Verificar a resposta do servidor

                    if (isGlobal) {
                        // Exibir erros globais
                        if (xhr.responseJSON.message) {
                            $globalError.text(xhr.responseJSON.message).removeClass('d-none');
                        } else {
                            $globalError.text('Ocorreu um erro.').removeClass('d-none');
                        }
                    } else {
                        // Exibir erros específicos
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, messages) {
                            var errorDiv = $modal.find('#' + key + 'Error');
                            if (errorDiv.length) {
                                errorDiv.text(messages.join(', ')).removeClass('d-none');
                            }
                        });
                    }
                }
            });
        });
    }

    // Inicializa o gerenciamento de formulários para modais de registro e login
    handleFormSubmission('registerModal', false); // Para o modal de registro
    handleFormSubmission('loginModal', true); // Para o modal de login
    handleFormSubmission('editProfileEmailModal', false);
    handleFormSubmission('editProfileInfoModal', false);
    handleFormSubmission('editProfilePasswordModal', false);
    handleFormSubmission('editProfilePhotoModal', false);
});
