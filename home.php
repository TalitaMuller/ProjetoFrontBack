<?php

require_once 'includes/verifica_login.php'; 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Súmula Digital</title>
</head>
<body>
    <h1>Bem-vindo(a), <?php echo $_SESSION['usuario_nome']; ?>!</h1>
    
    <p>Você está no sistema de Súmula Digital.</p>

    <a href="src/entidade/views/cadastrar.php">Cadastrar Entidade</a> <br>
    <a href="src/turma/views/cadastrar.php">Cadastrar Turma</a> <br>
    <a href="src/usuario/UsuarioController.php?acao=sair">Sair do Sistema</a>
</body>
</html>