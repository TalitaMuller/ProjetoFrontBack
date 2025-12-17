<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Criar Conta - Súmula Digital</title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=15">
    
    <link rel="stylesheet" href="../../../assets/css/pages/cadastro.css?v=15">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">

</head>
<body>

    <main class="card-cadastro">
        <header>
            <h2>Crie sua Conta</h2>
        </header>

        <form action="../UsuarioController.php" method="POST" id="formCadastro">
            <input type="hidden" name="acao" value="cadastrar">

            <div>
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" id="nome" placeholder="Ex: Ana Silva" required>
            </div>
            
            <div>
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="seu@email.com" required>
            </div>
            
            <div class="grupo-senha">
                <input type="password" name="senha" id="senha" placeholder="Crie uma Senha Forte" required>
                <span class="olho-senha" onclick="alternarSenha('senha', this)" role="button">👁️</span>
            </div>
            
            <ul class="requisitos-senha" aria-label="Requisitos da senha">
                <li id="req-tamanho">Mínimo 8 caracteres</li>
                <li id="req-maiuscula">Pelo menos 1 letra maiúscula</li>
                <li id="req-minuscula">Pelo menos 1 letra minúscula</li>
                <li id="req-numero">Pelo menos 1 número</li>
                <li id="req-simbolo">Pelo menos 1 símbolo (!@#$...)</li>
            </ul>

            <div class="grupo-senha">
                <input type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirme sua Senha" required>
                <span class="olho-senha" onclick="alternarSenha('confirma_senha', this)" role="button">👁️</span>
            </div>
            
            <p id="msg-conferir">As senhas não coincidem</p>
            
            <button type="submit" id="btn-cadastrar" disabled>CADASTRAR</button>
        </form>

        <footer style="margin-top: 20px; text-align: center;">
            <a href="../../../index.php" style="color: #666; font-size: 0.9rem;">
                Já tem conta? <strong>Faça Login</strong>
            </a>
        </footer>
    </main>

    <script src="../../../assets/js/pages/cadastro.js" defer></script>

    <script src="../../../assets/js/components/darkmode.js"></script>
</body>
</html>