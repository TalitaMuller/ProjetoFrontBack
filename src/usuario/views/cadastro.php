<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Súmula Digital</title>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <style>
        body {
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh; background-color: #eef2f3;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-cadastro {
            background: white; padding: 40px; border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px;
        }
        
        input[type="text"], input[type="email"] {
            width: 100%; padding: 12px; margin: 10px 0;
            border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;
        }

        .grupo-senha {
            position: relative;
            width: 100%;
            margin: 10px 0;
        }
        .grupo-senha input {
            width: 100%;
            padding: 12px;
            padding-right: 40px; 
            border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;
            margin: 0; 
        }
        .olho-senha {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #666;
            user-select: none; 
        }
        .olho-senha:hover { color: #1cacbc; }

        button {
            width: 100%; padding: 12px; background-color: #1cacbc;
            color: white; border: none; border-radius: 5px; cursor: pointer;
            font-size: 1rem; font-weight: bold; margin-top: 10px;
        }
        button:disabled { background-color: #ccc; cursor: not-allowed; }
        
        .requisitos-senha {
            list-style: none; padding: 0; margin: 5px 0 15px 0;
            font-size: 0.85rem; text-align: left;
        }
        .requisitos-senha li {
            color: #999; margin-bottom: 3px; transition: 0.3s;
        }
        .requisitos-senha li::before { content: "✖ "; color: red; }
        .requisitos-senha li.valido { color: green; font-weight: bold; }
        .requisitos-senha li.valido::before { content: "✔ "; color: green; }
    </style>
</head>
<body>

    <div class="card-cadastro">
        <h2 style="text-align: center; color: #333;">Crie sua Conta 🚀</h2>

        <form action="../UsuarioController.php" method="POST" id="formCadastro">
            <input type="hidden" name="acao" value="cadastrar">

            <input type="text" name="nome" placeholder="Seu Nome Completo" required>
            <input type="email" name="email" placeholder="Seu E-mail" required>
            
            <div class="grupo-senha">
                <input type="password" name="senha" id="senha" placeholder="Crie uma Senha Forte" required>
                <span class="olho-senha" onclick="alternarSenha('senha', this)">👁️</span>
            </div>
            
            <ul class="requisitos-senha">
                <li id="req-tamanho">Mínimo 8 caracteres</li>
                <li id="req-maiuscula">Pelo menos 1 letra maiúscula</li>
                <li id="req-minuscula">Pelo menos 1 letra minúscula</li>
                <li id="req-numero">Pelo menos 1 número</li>
                <li id="req-simbolo">Pelo menos 1 símbolo (!@#$...)</li>
            </ul>

            <div class="grupo-senha">
                <input type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirme sua Senha" required>
                <span class="olho-senha" onclick="alternarSenha('confirma_senha', this)">👁️</span>
            </div>
            
            <p id="msg-conferir" style="font-size: 0.8rem; color: red; display: none;">As senhas não coincidem</p>
            
            <button type="submit" id="btn-cadastrar" disabled>CADASTRAR</button>
        </form>

        <div style="text-align: center; margin-top: 15px;">
            <a href="../../../index.php" style="color: #666; font-size: 0.9rem;">Já tem conta? Faça Login</a>
        </div>
    </div>

    <script>
        const senhaInput = document.getElementById('senha');
        const confirmaInput = document.getElementById('confirma_senha');
        const btnSubmit = document.getElementById('btn-cadastrar');
        const msgConferir = document.getElementById('msg-conferir');

        const reqTamanho = document.getElementById('req-tamanho');
        const reqMaiuscula = document.getElementById('req-maiuscula');
        const reqMinuscula = document.getElementById('req-minuscula');
        const reqNumero = document.getElementById('req-numero');
        const reqSimbolo = document.getElementById('req-simbolo');

        function alternarSenha(idInput, icone) {
            const input = document.getElementById(idInput);
            if (input.type === "password") {
                input.type = "text";
                icone.textContent = "🙈"; 
            } else {
                input.type = "password";
                icone.textContent = "👁️"; 
            }
        }

        function validarSenha() {
            const senha = senhaInput.value;
            let formValido = true;

            // 1. Valida Tamanho
            if (senha.length >= 8) reqTamanho.classList.add('valido');
            else { reqTamanho.classList.remove('valido'); formValido = false; }

            // 2. Valida Maiúscula
            if (/[A-Z]/.test(senha)) reqMaiuscula.classList.add('valido');
            else { reqMaiuscula.classList.remove('valido'); formValido = false; }

            // 3. Valida Minúscula
            if (/[a-z]/.test(senha)) reqMinuscula.classList.add('valido');
            else { reqMinuscula.classList.remove('valido'); formValido = false; }

            // 4. Valida Número
            if (/[0-9]/.test(senha)) reqNumero.classList.add('valido');
            else { reqNumero.classList.remove('valido'); formValido = false; }

            // 5. Valida Símbolo
            if (/[^A-Za-z0-9]/.test(senha)) reqSimbolo.classList.add('valido');
            else { reqSimbolo.classList.remove('valido'); formValido = false; }

            return formValido;
        }

        function conferirSenhas() {
            const senha = senhaInput.value;
            const confirma = confirmaInput.value;
            
            if (confirma.length > 0 && senha !== confirma) {
                msgConferir.style.display = 'block';
                return false;
            } else {
                msgConferir.style.display = 'none';
                return true;
            }
        }

        function atualizarBotao() {
            const senhaForte = validarSenha();
            const senhasIguais = conferirSenhas();
            const confirmaPreenchido = confirmaInput.value.length > 0;

            if (senhaForte && senhasIguais && confirmaPreenchido) {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
        }

        senhaInput.addEventListener('keyup', atualizarBotao);
        confirmaInput.addEventListener('keyup', atualizarBotao);
    </script>

</body>
</html>