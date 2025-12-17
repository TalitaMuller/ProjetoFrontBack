/* =========================================================
   FILTRO DE PESQUISA EM TABELAS
   ========================================================= */

const inputBusca = document.getElementById('input-busca');

if (inputBusca) {
    inputBusca.addEventListener('input', function() {
        const termo = this.value.toLowerCase();
        const tbody = document.querySelector('tbody');
        
        if (!tbody) return;

        // Pega todas as linhas da tabela
        const linhas = document.querySelectorAll('tbody tr');

        // Transformamos o NodeList em Array real para usar métodos avançados
        const arrayLinhas = Array.from(linhas);

        // Cria um novo array apenas com quem NÃO bate com a busca
        const linhasEsconder = arrayLinhas.filter(linha => {
            const texto = linha.innerText.toLowerCase();
            return !texto.includes(termo); // Retorna verdadeiro se NÃO tem o texto
        });

        // Cria um novo array apenas com quem BATE com a busca
        const linhasMostrar = arrayLinhas.filter(linha => {
            const texto = linha.innerText.toLowerCase();
            return texto.includes(termo);
        });

        // Aplica a visibilidade 
        linhasEsconder.forEach(linha => linha.style.display = 'none');
        linhasMostrar.forEach(linha => linha.style.display = '');
    });
}