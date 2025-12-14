<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Súmula Digital GA</title>
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        
        .grupo-senha {
            position: relative;
            width: 100%;
        }
        
        /
        .grupo-senha input {
            width: 100%;
            padding-right: 40px; 
            box-sizing: border-box; 
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
            background: none;
            border: none;
        }
        
        .olho-senha:hover {
            color: #1cacbc; 
        }
    </style>
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
                <div class="grupo-senha">
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
                    <span class="olho-senha" onclick="alternarSenha()">👁️</span>
                </div>
            </div>
            
            <button type="submit" name="acao" value="logar">Entrar no Sistema</button>
        </form>

        <a href="src/usuario/views/cadastro.php" style="display: block; margin-top: 15px; color: #666; text-decoration: none; font-size: 0.9rem;">
            Não tem conta? <strong>Cadastre-se aqui</strong>
        </a>
    </div>

    <script>
        function alternarSenha() {
            const input = document.getElementById('senha');
            const icone = document.querySelector('.olho-senha');
            
            if (input.type === "password") {
                input.type = "text";
                icone.textContent = "🙈"; 
            } else {
                input.type = "password";
                icone.textContent = "👁️"; 
        }
    </script>

</body>
</html>