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

//Fazer o autocomplete na searchbar da navbar

document.addEventListener('DOMContentLoaded', function() { //Garante que todo o HTML esteja carregado
    var searchInput = document.getElementById('search');
    var searchResults = document.getElementById('search-results');
    var searchForm = document.getElementById('searchForm');

    if (searchInput) {
        var searchUrl = searchInput.getAttribute('data-url'); // Obtém a URL do atributo data-url
        searchInput.addEventListener('keyup', function() { //Sempre que uma tecla se soltar, aciona a função interna
            var query = searchInput.value;

            if (query.length > 1) { //Se a pesquisa for maior que 1 caracter, são mostradas as sugestões
                var xhr = new XMLHttpRequest(); //Requisição Ajax
                xhr.open('GET', searchUrl + '?query=' + encodeURIComponent(query), true);
                xhr.onload = function() { //Define o que deve acontecer quando a resposta da requisição é recebida
                    if (xhr.status === 200) { //Verificar se a requisição foi bem sucedida
                        var data = JSON.parse(xhr.responseText); //Resposta analisada em JSON
                        searchResults.innerHTML = ''; //Limpa o searchResults
                        if (data.length > 0) {
                            data.forEach(function(local) {
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
                xhr.onerror = function() { //Define o que é feito em caso de erro na requisição
                    console.error('Erro na requisição AJAX');
                };
                xhr.send();
            } else {
                searchResults.innerHTML = '';
            }
        });
/*    } else {
        console.error('Elemento de busca não encontrado');
    }
});*/

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
    } else {
        console.error('Elemento de busca não encontrado');
    }
});

