function confirmDelete(formId, url) {
    document.getElementById(formId).action = url;
}

document.addEventListener('DOMContentLoaded', function() {
    const mediaInput = document.getElementById('media');
    const mediaLabel = document.querySelector('.custom-file-label');

    mediaInput.addEventListener('change', function() {
        if (mediaInput.files.length > 0) {
            mediaLabel.textContent = mediaInput.files[0].name; // Atualiza o texto com o nome do arquivo
        } else {
            mediaLabel.textContent = 'Escolher arquivo...'; // Texto padrão
        }
    });
});
