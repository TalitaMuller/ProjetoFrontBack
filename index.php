<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login - Súmula Digital GA</title>
    
    <link rel="stylesheet" href="assets/css/global.css?v=15">
    
    <link rel="stylesheet" href="assets/css/pages/login.css?v=15">

    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
</head>
<body>

    <main class="login-container">
        
        <header>
            <h1>Súmula Digital GA</h1>
        </header>
        
        <?php if(isset($_GET['erro'])): ?>
            <div class="msg-erro" role="alert"> <?php
                    if ($_GET['erro'] == 'login_invalido') {
                        echo "Email ou senha incorretos!";
                    } else if ($_GET['erro'] == 'campos_vazios') {
                        echo "Preencha todos os campos!";
                    } else if ($_GET['erro'] == 'acesso_negado') {
                        echo "Faça login para acessar o sistema.";
                    }
                ?>
            </div>
        <?php endif; ?>

        <form action="src/usuario/UsuarioController.php" method="POST">
            
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required>
            </div>
            
            <div>
                <label for="senha">Senha:</label>
                <div class="grupo-senha">
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
                    <span class="olho-senha" onclick="alternarSenha()" role="button" aria-label="Mostrar senha">👁️</span>
                </div>
            </div>
            
            <button type="submit" name="acao" value="logar">Entrar no Sistema</button>
        </form>

        <footer>
            <a href="src/usuario/views/cadastro.php" class="link-cadastro">
                Não tem conta? <strong>Cadastre-se aqui</strong>
            </a>
        </footer>
    </main>

    <script src="assets/js/pages/login.js" defer></script>

    <script src="assets/js/components/darkmode.js"></script>

</body>
</html>