/* =========================================
   LÓGICA DO MODAL 
   ========================================= */

document.addEventListener('DOMContentLoaded', () => {
    // Verifica se já existe para não duplicar
    if (!document.getElementById('custom-modal')) {
        const modalHTML = `
            <div id="custom-modal" class="modal-overlay">
                <div class="modal-box">
                    <span id="modal-icon" class="modal-icon">⚠️</span>
                    <h3 id="modal-title" class="modal-title">Tem certeza?</h3>
                    <p id="modal-desc" class="modal-desc">Essa ação não pode ser desfeita.</p>
                    
                    <div class="modal-actions">
                        <button id="btn-cancelar" class="btn-modal btn-modal-cancel" onclick="fecharModal()">Cancelar</button>
                        <button id="btn-confirmar" class="btn-modal btn-modal-confirm">Confirmar</button>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }
});

// Variável para guardar o link
let linkDestino = '';

// CONFIRMAR EXCLUSÃO (VERMELHO) ---
function confirmarExclusao(event, nomeItem, link) {
    event.preventDefault(); 
    linkDestino = link;

    //para modo exclusão
    document.getElementById('modal-icon').innerText = '⚠️';
    document.getElementById('modal-title').innerText = 'Excluir Item?';
    document.getElementById('modal-desc').innerText = `Você deseja realmente apagar "${nomeItem}"?`;
    
    const btnConfirmar = document.getElementById('btn-confirmar');
    btnConfirmar.innerText = 'Sim, Excluir';
    btnConfirmar.className = 'btn-modal btn-modal-confirm'; 
    btnConfirmar.onclick = function() { window.location.href = linkDestino; };

    document.getElementById('btn-cancelar').style.display = 'inline-block';

    abrirModal();
}

// ---MENSAGEM DE SUCESSO ---
function mostrarSucesso(mensagem) {
    // Muda visual para sucesso
    document.getElementById('modal-icon').innerText = '✅';
    document.getElementById('modal-title').innerText = 'Sucesso!';
    document.getElementById('modal-desc').innerText = mensagem;

    const btnConfirmar = document.getElementById('btn-confirmar');
    btnConfirmar.innerText = 'OK';
    btnConfirmar.className = 'btn-modal'; 
    btnConfirmar.style.backgroundColor = '#28a745';
    btnConfirmar.style.color = 'white';
    
    btnConfirmar.onclick = fecharModal;

    document.getElementById('btn-cancelar').style.display = 'none';

    abrirModal();
}

function abrirModal() {
    document.getElementById('custom-modal').classList.add('active');
}

function fecharModal() {
    document.getElementById('custom-modal').classList.remove('active');
}

// Fecha ao clicar fora
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal-overlay')) {
        fecharModal();
    }
});