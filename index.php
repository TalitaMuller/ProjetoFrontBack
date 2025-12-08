<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Súmula Digital GA</title>
    </head>
<body>
    <div style="width: 300px; margin: 100px auto; text-align: center; border: 1px solid #ccc; padding: 20px;">
        
        <h2>Súmula Digital GA</h2>
        
        <?php if(isset($_GET['erro']) && $_GET['erro'] == 'login_invalido'): ?>
            <p style="color: red;">Email ou senha incorretos!</p>
        <?php endif; ?>

        <form action="src/usuario/UsuarioController.php" method="POST">
            
            <p>
                <label>Email:</label><br>
                <input type="email" name="email" required>
            </p>
            
            <p>
                <label>Senha:</label><br>
                <input type="password" name="senha" required>
            </p>
            
            <button type="submit" name="acao" value="logar">Entrar</button>
        </form>
    </div>
</body>
</html>
