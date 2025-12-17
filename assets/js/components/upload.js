/* =========================================
   LÓGICA DE DRAG AND DROP PARA UPLOAD
   ========================================= */

document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('foto');
    const preview = document.getElementById('preview');
    const textoUpload = document.getElementById('texto-upload');

    // Se não encontrar os elementos, para o script
    if (!dropZone || !fileInput) return;

    //Quando selecionar arquivo pelo clique normal
    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            mostrarPreview(this.files[0]);
        }
    });

    // Prevenir comportamentos padrão do navegador ao arrastar
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Efeito visual quando arrasta por cima 
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'), false);
    });

    // Quando SOLTA o arquivo
    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            fileInput.files = files; // Passa o arquivo solto para o input real
            mostrarPreview(files[0]);
        }
    }

    //
    function mostrarPreview(file) {
        // Verifica se é imagem
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'inline-block';
                textoUpload.innerText = "Arquivo selecionado: " + file.name;
            }
            reader.readAsDataURL(file);
        } else {
            alert('Por favor, solte apenas arquivos de imagem.');
        }
    }
});