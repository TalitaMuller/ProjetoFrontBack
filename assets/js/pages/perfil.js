/* LÓGICA DO PERFIL */

const inputNovaSenha = document.getElementById('nova_senha');
const listaRequisitos = document.getElementById('lista-requisitos');
const btnSalvar = document.getElementById('btn-salvar');

// Elementos da lista
const reqs = {
    tamanho: document.getElementById('req-tamanho'),
    maiuscula: document.getElementById('req-maiuscula'),
    minuscula: document.getElementById('req-minuscula'),
    numero: document.getElementById('req-numero'),
    simbolo: document.getElementById('req-simbolo')
};

// Alternar Olhinho
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

// Validação ao Digitar
if (inputNovaSenha) {
    inputNovaSenha.addEventListener('input', function() {
        const senha = this.value;

        // Se o campo estiver vazio, esconde os requisitos e libera salvar (opcional)
        if (senha.length === 0) {
            listaRequisitos.classList.remove('visivel');
            btnSalvar.disabled = false;
            btnSalvar.style.opacity = '1';
            return;
        }

        // Se digitou algo, mostra a lista
        listaRequisitos.classList.add('visivel');

        let senhaValida = true;

        // Validações
        if (senha.length >= 8) validarReq('tamanho', true);
        else { validarReq('tamanho', false); senhaValida = false; }

        if (/[A-Z]/.test(senha)) validarReq('maiuscula', true);
        else { validarReq('maiuscula', false); senhaValida = false; }

        if (/[a-z]/.test(senha)) validarReq('minuscula', true);
        else { validarReq('minuscula', false); senhaValida = false; }

        if (/[0-9]/.test(senha)) validarReq('numero', true);
        else { validarReq('numero', false); senhaValida = false; }

        if (/[^A-Za-z0-9]/.test(senha)) validarReq('simbolo', true);
        else { validarReq('simbolo', false); senhaValida = false; }

        // Bloqueia salvar se a senha nova for inválida
        if (senhaValida) {
            btnSalvar.disabled = false;
            btnSalvar.style.opacity = '1';
            btnSalvar.style.cursor = 'pointer';
        } else {
            btnSalvar.disabled = true;
            btnSalvar.style.opacity = '0.5';
            btnSalvar.style.cursor = 'not-allowed';
        }
    });
}

function validarReq(chave, valido) {
    if (valido) reqs[chave].classList.add('valido');
    else reqs[chave].classList.remove('valido');
}