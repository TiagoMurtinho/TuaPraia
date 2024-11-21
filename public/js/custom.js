/* ----------------------------------------------------------------------
    Esta função recebe 2 parâmetros, "formID" e "url"
    - formId: o ID do formulário a ser modificado.
    - url: a URL para a qual o formulário será enviado quando submetido.
    Por exemplo :
    onclick="confirmDelete('deleteRegionForm','{{ route('regions.destroy', $region->id) }}')
------------------------------------------------------------------------ */


function confirmDelete(formId, url) {
    document.getElementById(formId).action = url;
}


/* ----------------------------------------------------------------------
    Este código aguarda o carregamento completo do DOM antes de executar.
    Ele seleciona todos os elementos com a classe 'custom-file-input' e adiciona um evento de 'change' a cada um deles.
    Quando um arquivo é selecionado:
    - Atualiza o texto do rótulo adjacente com o nome do arquivo escolhido.
    Se nenhum arquivo for selecionado:
    - Verifica se há uma imagem com a classe 'img-thumbnail' e, se existir, usa seu atributo 'alt' como texto do rótulo;
    - Se não houver imagem, define um texto padrão 'Escolher arquivo...'.
    Se o input ou o rótulo não forem encontrados, registra uma mensagem no console.
------------------------------------------------------------------------- */


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

//Fazer o autocomplete na searchbar da navbar

document.addEventListener('DOMContentLoaded', function() { // Garante que todo o HTML esteja carregado
    var searchBars = [
        {
            searchInput: document.getElementById('search1'),
            searchResults: document.getElementById('search-results1'),
            searchForm: document.getElementById('searchForm1')
        },
        {
            searchInput: document.getElementById('search2'),
            searchResults: document.getElementById('search-results2'),
            searchForm: document.getElementById('searchForm2')
        }
    ];

    var maxSuggestions = 5; // Número máximo de sugestões a exibir

    searchBars.forEach(function(bar) {
        var searchInput = bar.searchInput;
        var searchResults = bar.searchResults;
        var searchForm = bar.searchForm;

        if (searchInput && searchResults && searchForm) {
            var searchUrl = searchInput.getAttribute('data-url'); // Obtém a URL do atributo data-url

            searchInput.addEventListener('keyup', function() { // Sempre que uma tecla se soltar, aciona a função interna
                var query = searchInput.value;

                if (query.length > 1) { // Se a pesquisa for maior que 1 caracter, são mostradas as sugestões
                    var xhr = new XMLHttpRequest(); // Requisição Ajax
                    xhr.open('GET', searchUrl + '?query=' + encodeURIComponent(query), true);
                    xhr.onload = function() { // Define o que deve acontecer quando a resposta da requisição é recebida
                        if (xhr.status === 200) { // Verificar se a requisição foi bem sucedida
                            var data = JSON.parse(xhr.responseText); // Resposta analisada em JSON
                            searchResults.innerHTML = ''; // Limpa o searchResults
                            if (data.length > 0) {
                                // Limita o número de sugestões a maxSuggestions
                                data.slice(0, maxSuggestions).forEach(function(local) {
                                    var li = document.createElement('li');
                                    li.className = 'list-group-item';

                                    // Limita o texto do nome a 30 caracteres, o resto terá reticências
                                    var name = local.name.length > 30 ? local.name.substring(0, 30) + '...' : local.name;

                                    li.innerHTML = '<a href="/locals/' + local.id + '">' + name + '</a>';
                                    searchResults.appendChild(li);
                                });
                            } else {
                                var li = document.createElement('li');
                                li.className = 'list-group-item';
                                li.textContent = 'No results found';
                                searchResults.appendChild(li);
                            }
                        } else {
                            console.error('Erro na requisição:', xhr.status, xhr.statusText);
                        }
                    };
                    xhr.onerror = function() { // Define o que é feito em caso de erro na requisição
                        console.error('Erro na requisição AJAX');
                    };
                    xhr.send();
                } else {
                    searchResults.innerHTML = '';
                }
            });

            // Adicionar um listener para a submissão do formulário
            searchForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita a submissão padrão do formulário

                var query = searchInput.value;

                if (query.length > 1) {
                    var xhr = new XMLHttpRequest(); // Requisição Ajax
                    xhr.open('GET', searchUrl + '?query=' + encodeURIComponent(query), true);
                    xhr.onload = function() { // Define o que deve acontecer quando a resposta da requisição é recebida
                        if (xhr.status === 200) { // Verificar se a requisição foi bem sucedida
                            var data = JSON.parse(xhr.responseText); // Resposta analisada em JSON
                            if (data.length === 1) { // Se houver apenas um resultado, redirecionar para a página desse resultado
                                window.location.href = '/locals/' + data[0].id;
                            } else if (data.length > 1) { // Se houver múltiplos resultados, redirecionar para a página de resultados
                                window.location.href = '/search-results?query=' + encodeURIComponent(query);
                            } else {
                                alert('No results found'); // Exibir uma mensagem de alerta se nenhum resultado for encontrado
                            }
                        } else {
                            console.error('Erro na requisição:', xhr.status, xhr.statusText);
                        }
                    };
                    xhr.onerror = function() { // Define o que é feito em caso de erro na requisição
                        console.error('Erro na requisição AJAX');
                    };
                    xhr.send();
                }
            });
        }
    });
});


/* --------------------------------------------------------------------------------------

Este código é responsável por gerenciar a exibição de mensagens de erro e sucesso durante o
envio de formulários via AJAX, sem recarregar a página. Quando um formulário é enviado, ele
limpa quaisquer mensagens de erro ou sucesso anteriores e, em seguida, envia os dados para o
servidor. Dependendo da resposta do servidor, o código trata as mensagens de erro de duas
formas: exibe mensagens de erro gerais, como falhas de login ou mensagens de erro globais, e
exibe erros específicos de validação associados aos campos do formulário. Além disso, o código é
flexível, podendo ser aplicado tanto a modais com IDs específicos quanto a modais dinâmicos
identificados pela classe .dynamic-modal. Se a resposta do servidor indica sucesso, o código
pode também exibir uma mensagem de sucesso e redirecionar o usuário para uma nova página, se
necessário.

--------------------------------------------------------------------------------------- */


$(document).ready(function() {
    function handleFormSubmission(modalId, isGlobal, showSuccess) {
        var $modal = $('#' + modalId);
        var $form = $modal.find('form');
        var $globalError = $modal.find('#' + modalId + 'GlobalError');
        var $successAlert = $modal.find('.alert.alert-success');

        $form.on('submit', function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            var actionUrl = $form.attr('action');

            // Limpa erros e mensagens de sucesso anteriores
            $modal.find('.alert.alert-danger').empty().addClass('d-none');
            $successAlert.empty().addClass('d-none');

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: new FormData($form[0]),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                            window.location.href = response.redirect;
                    } else {
                        console.log('Resposta não marcada como sucesso:', response);
                    }
                },
                error: function(xhr) {
                    console.log('Erro ao processar a solicitação:', xhr.responseJSON); // Debug: Verificar a resposta do servidor

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
                            // Construa o ID do campo de erro correspondente
                            var errorDivId = modalId + key.charAt(0).toUpperCase() + key.slice(1) + 'Error';
                            var errorDiv = $modal.find('#' + errorDivId);
                            if (errorDiv.length) {
                                errorDiv.text(messages.join(', ')).removeClass('d-none');
                            } else {
                                console.log('Div de erro não encontrada para o ID:', errorDivId); // Debug: Verifique se a div foi encontrada
                            }
                        });
                    }
                }
            });
        });
    }

    // Inicializa o gerenciamento de formulários para modais
    handleFormSubmission('registerModal', false, true);
    handleFormSubmission('loginModal', true, true);
    handleFormSubmission('editProfileEmailModal', false, true);
    handleFormSubmission('editProfileInfoModal', false, true);
    handleFormSubmission('editProfilePasswordModal', false, true);
    handleFormSubmission('editProfilePhotoModal', false, true);
    handleFormSubmission('addAttributeModal', false, true);
    handleFormSubmission('addRegionModal', false, true);
    handleFormSubmission('addDistrictModal', false, true);
    handleFormSubmission('addLocalModal', false, true);
    handleFormSubmission('deleteProfileModal', false, true);
    handleFormSubmission('editAttributeModal', false, true);
    handleFormSubmission('editDistrictModal', false, true);
    handleFormSubmission('editRegionModal', false, true);
    handleFormSubmission('resetPasswordModal', true, true);
    handleFormSubmission('forgotPasswordModal', false, true);

    $('.dynamic-modal').each(function() {
        var modalId = $(this).attr('id');
        handleFormSubmission(modalId, false, true);
    });
});


/* ------------------------------------------------------------------------------

Este código recebe a mensagem de sucesso exibida,
cado essa mensagem tenha a classe ".alert-success-custom" ela será exibida por 5 segundos, em seguida a sua opacidade é reduzida gradualmente até desaparecer.

-------------------------------------------------------------------------------- */


document.addEventListener('DOMContentLoaded', function() {
    // Bloco para mensagem de sucesso
    var successMessage = document.querySelector('.alert-success-custom');

    if (successMessage) {
        // Configura um timeout para esconder a mensagem após 5 segundos
        setTimeout(function() {
            successMessage.style.opacity = 0;
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 500); // Tempo para a animação de desaparecimento
        }, 5000); // 5 segundos
    }
});


/* -----------------------------------------------------------------------------------------

Esre código é responsável por exibir e controlar o comportamento do botão " voltar para o topo "
Quando o conteúdo da view é carregado ele adiciona um listener para controlar a scroll da página,
Se o user fizer scroll mais de 200 pixels para baixo o botão aparece, ao fazer scroll para cima caso estiver a menos de 200 pixels ele desaparece.
Quando o botão é clicado ele impede o comportamento padrão e faz com que a página volte suavemente ao topo

------------------------------------------------------------------------------------------ */
document.addEventListener('DOMContentLoaded', function () {
    var backToTopButton = document.getElementById('back-to-top');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 200) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    backToTopButton.addEventListener('click', function (event) {
        event.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});


/* ----------------------------------------------------------------------------------------

Este código é responsável por criar o sistema de avaliação por estrelas.
Ele começa por selecionar todos os elementos de estrela dentro do container com a classe
" . rating-stars " e o campo oculto com o id "#rating".
Quando o user passa o rato sobre uma estrela, o código captura o valor associado a essa estrela alem de modificar a aparência da estrela. Isso ajuda o user a ver a classificação que está a selecionar.
Se retirar o rato das estrelas, o sistema retorna às estrelas destacadas conforme a classificação que já tinha sido selecionada, o que assegura que a seleção anterior permanece visível.
Ao clicar em uma estrela, o valor da estrela é armazenado e atribuído ao campo oculto o que permite que o valor da avaliação seja enviado com o comentário.

------------------------------------------------------------------------------------------ */


document.addEventListener('DOMContentLoaded', function() {
    // Bloco para as estrelas de avaliação
    const stars = document.querySelectorAll('.rating-stars .star');
    const ratingInput = document.getElementById('rating');
    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const value = this.getAttribute('data-value');
            updateStars(value);
        });

        star.addEventListener('mouseout', function() {
            updateStars(selectedRating);
        });

        star.addEventListener('click', function() {
            selectedRating = this.getAttribute('data-value');
            ratingInput.value = selectedRating;
            updateStars(selectedRating);
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            star.classList.remove('selected');
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('selected');
            }
        });
    }
});


/* ----------------------------------------------------------------------------------------

Este código faz a gestão da exibição de dois comportamentos distintos, o formulário de feedback
e a lista de comentários.
Basicamente o código é responsavel por permitir alternar entre o formulário de feedback
e a lista de comentários dentro do mesmo container através de dois botões.

---------------------------------------------------------------------------------------- */


document.addEventListener('DOMContentLoaded', function () {
    const showFormButton = document.getElementById('show-form-button');
    const showCommentsButton = document.getElementById('show-comments-button');
    const feedbackFormContainer = document.getElementById('feedback-form-container');
    const commentsListContainer = document.getElementById('comments-list-container');

    showFormButton.addEventListener('click', function () {
        feedbackFormContainer.style.display = 'block';
        commentsListContainer.style.display = 'none';
    });

    showCommentsButton.addEventListener('click', function () {
        feedbackFormContainer.style.display = 'none';
        commentsListContainer.style.display = 'block';
    });

    // Código para manipulação das estrelas
    const stars = document.querySelectorAll('.rating-stars .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach(s => {
                s.classList.remove('selected');
                if (s.getAttribute('data-value') <= value) {
                    s.classList.add('selected');
                }
            });
        });
    });
});

/* -------------------------------------------------------------------------------------

Este código faz a gestão entre dois modais.
Quando o user clica no botão com id "#loginBtn" o modal de login é exibido,
ao clicar no link com o id "#forgotPasswordLink" o código impede o comportamento padrão do
link e fecha o modal de login exibindo de seguida o modal de recuperação de pass.
Caso o modal de recuperação seja fechado voluntáriamente ou seja sem fazer o processo de
recuperação, ele faz com que o modal de login seja reexibido automaticamente.

--------------------------------------------------------------------------------------- */


document.addEventListener('DOMContentLoaded', function() {
    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
    var forgotPasswordModal = new bootstrap.Modal(document.getElementById('forgotPasswordModal'));

    // Abre o modal de login
    document.getElementById('loginBtn').addEventListener('click', function() {
        loginModal.show();
    });

    // Abre o modal de recuperação de senha
    document.getElementById('forgotPasswordLink').addEventListener('click', function(event) {
        event.preventDefault();
        loginModal.hide();
        forgotPasswordModal.show();
    });

    // Fecha o modal de recuperação de senha e volta ao modal de login
    document.getElementById('forgotPasswordModal').addEventListener('hidden.bs.modal', function () {
        loginModal.show();
    });
});


/* ----------------------------------------------------------------------------------

Este código verifica se o parâmetro "showResetPasswordModal" está presente e se o seu
valor é igual a 1.
Caso esteja presente e seja igual a 1 o código cria uma instância do modal para ser
exibido automaticamente na tela.

------------------------------------------------------------------------------------- */


document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const showResetPasswordModal = urlParams.get('showResetPasswordModal');

    if (showResetPasswordModal === '1') {
        const resetPasswordModal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
        console.log('Showing modal');
        resetPasswordModal.show();
    }
});


/* ---------------------------------------------------------------------------------------

Este código assegura que o formulário de redefinição de password não seja enviado da forma
tradicional e em vez disso ele realiza uma requisição AJAX para a ulr /password/reset com o
método POST

------------------------------------------------------------------------------------------ */


$(document).ready(function() {
    $('#resetPasswordForm').on('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        $.ajax({
            url: '/password/reset', // URL da sua API
            method: 'POST',
            data: $(this).serialize(), // Serializa os dados do formulário
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect; // Redirecionar, se necessário
                } else {
                    console.log('Erros:', response.errors);
                    // Exibir erros na interface do usuário
                }
            },
            error: function(xhr) {
                console.log('Erro ao processar a solicitação:', xhr.responseJSON); // Verificar a resposta do servidor
            }
        });
    });
});


/* --------------------------------------------------------------------------------

Este código está projetado para interceptar o envio de qualquer formulário e
processar o envio de forma assíncrona utilizando AJAX.
Em resumo, o código permite o envio de formulários de forma assíncrona, fornecendo feedback e redirecionamento baseados na resposta do servidor, além de lidar com possíveis erros de forma adequada.

----------------------------------------------------------------------------------------- */


$(document).ready(function() {
    $('.ajax-form').on('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        var $form = $(this);
        var url = $form.attr('action');
        var method = $form.find('input[name="_method"]').val() || 'POST'; // Pega o método especificado ou usa POST como padrão

        $.ajax({
            url: url,
            method: method, // Usa o método especificado pelo formulário
            data: new FormData(this),
            processData: false,
            contentType: false,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }
            }
        });
    });
});
