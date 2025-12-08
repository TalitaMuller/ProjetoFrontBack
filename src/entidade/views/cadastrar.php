<?php

require_once '../../../includes/verifica_login.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Entidade - Súmula Digital</title>
</head>
<body>
    <a href="../../../home.php">Voltar ao Painel</a>
    <hr>

    <h2>Cadastrar Nova Entidade</h2>

    <?php if(isset($_GET['sucesso'])): ?>
        <p style="color: green;">Entidade cadastrada com sucesso!</p>
    <?php endif; ?>

    <?php if(isset($_GET['erro'])): ?>
        <p style="color: red;">Erro ao cadastrar.</p>
    <?php endif; ?>

    <form action="../EntidadeController.php" method="POST">

        <label>Nome da Entidade:</label><br>
        <input type="text" name="nome" required placeholder="Ex: Grêmio Náutico União">
        <br><br>
        
        <button type="submit" name="acao" value="cadastrar">Salvar</button>

    </form>

</body>
</html>