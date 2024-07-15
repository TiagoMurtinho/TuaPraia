function confirmDelete(formId, url) {
    document.getElementById(formId).action = url;
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');

    document.querySelectorAll('.custom-file-input').forEach(function(mediaInput) {
        const mediaLabel = mediaInput.nextElementSibling;

        if (mediaInput && mediaLabel) {
            console.log('Media input and label found for:', mediaInput.id);

            mediaInput.addEventListener('change', function() {
                console.log('Change event triggered on media input:', mediaInput.id);

                if (mediaInput.files.length > 0) {
                    console.log('File selected:', mediaInput.files[0].name);
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
