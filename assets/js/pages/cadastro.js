/* =========================================
   LÓGICA DO CADASTRO 
   ========================================= */

const senhaInput = document.getElementById('senha');
const confirmaInput = document.getElementById('confirma_senha');
const btnCadastrar = document.getElementById('btn-cadastrar');
const msgConferir = document.getElementById('msg-conferir');

// Requisitos
const reqs = {
    tamanho: document.getElementById('req-tamanho'),
    maiuscula: document.getElementById('req-maiuscula'),
    minuscula: document.getElementById('req-minuscula'),
    numero: document.getElementById('req-numero'),
    simbolo: document.getElementById('req-simbolo')
};

// Alternar visualização da senha
function alternarSenha(idInput, icone) {
    const input = document.getElementById(idInput);
    if (input.type === 'password') {
        input.type = 'text';
        icone.innerText = '🙈';
    } else {
        input.type = 'password';
        icone.innerText = '👁️';
    }
}

// Validar Senha em Tempo Real
senhaInput.addEventListener('input', validarTudo);
confirmaInput.addEventListener('input', validarTudo);

function validarTudo() {
    const senha = senhaInput.value;
    const confirma = confirmaInput.value;
    let senhaValida = true;

    // A. Valida Tamanho
    if (senha.length >= 8) validarReq('tamanho', true);
    else { validarReq('tamanho', false); senhaValida = false; }

    // B. Valida Maiúscula
    if (/[A-Z]/.test(senha)) validarReq('maiuscula', true);
    else { validarReq('maiuscula', false); senhaValida = false; }

    // C. Valida Minúscula
    if (/[a-z]/.test(senha)) validarReq('minuscula', true);
    else { validarReq('minuscula', false); senhaValida = false; }

    // D. Valida Número
    if (/[0-9]/.test(senha)) validarReq('numero', true);
    else { validarReq('numero', false); senhaValida = false; }

    // E. Valida Símbolo
    if (/[^A-Za-z0-9]/.test(senha)) validarReq('simbolo', true);
    else { validarReq('simbolo', false); senhaValida = false; }

    // F. Valida Confirmação
    let iguais = (senha === confirma && senha.length > 0);
    if (confirma.length > 0 && !iguais) {
        msgConferir.classList.add('visivel');
        confirmaInput.style.borderColor = 'var(--danger-color)';
    } else {
        msgConferir.classList.remove('visivel');
        confirmaInput.style.borderColor = 'var(--border-color)';
    }

    // G. Libera ou Bloqueia Botão
    if (senhaValida && iguais) {
        btnCadastrar.disabled = false;
        btnCadastrar.style.backgroundColor = 'var(--primary-color)';
    } else {
        btnCadastrar.disabled = true;
        
    }
}

// Função auxiliar para pintar de verde/vermelho
function validarReq(chave, valido) {
    if (valido) {
        reqs[chave].classList.add('valido');
    } else {
        reqs[chave].classList.remove('valido');
    }
}