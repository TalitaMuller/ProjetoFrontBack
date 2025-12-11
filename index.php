<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Súmula Digital GA</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="login-container">
        
        <h2>Súmula Digital GA</h2>
        
        <?php if(isset($_GET['erro'])): ?>
            <div class="msg-erro">
                <?php
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
                <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
            </div>
            
            <button type="submit" name="acao" value="logar">Entrar no Sistema</button>
        </form>

    </div>

</body>
</html>