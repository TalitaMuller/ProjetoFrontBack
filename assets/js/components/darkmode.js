/* =========================================
   CONTROLE DO MODO ESCURO (WEB STORAGE API)
   ========================================= */

const toggleBtn = document.getElementById('btn-tema');
const iconBtn = document.getElementById('icon-tema');

// Verifica preferência salva ao carregar
const temaSalvo = localStorage.getItem('tema');

if (temaSalvo === 'escuro') {
    document.body.classList.add('dark-mode');
    if(iconBtn) iconBtn.innerText = '☀️'; // Muda ícone para Sol
}

// Função de Alternar
if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        // Troca a classe no body
        document.body.classList.toggle('dark-mode');

        // Verifica qual tema ficou ativo
        const ehEscuro = document.body.classList.contains('dark-mode');

        // Salva no LocalStorage 
        localStorage.setItem('tema', ehEscuro ? 'escuro' : 'claro');

        // Troca o ícone
        iconBtn.innerText = ehEscuro ? '☀️' : '🌙';
    });
}