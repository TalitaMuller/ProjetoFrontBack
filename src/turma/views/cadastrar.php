<?php

require_once '../../../includes/verifica_login.php';

// Importa o DAO de Entidade para preencher o select
require_once '../../entidade/EntidadeDAO.php';

$entidadeDAO = new EntidadeDAO();
$listaEntidades = $entidadeDAO->listar();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Turma - Súmula Digital</title>
</head>
<body>
    <a href="../../../home.php">Voltar ao Painel</a>
    <hr>

    <h2>Cadastrar Nova Turma</h2>

    <?php if(isset($_GET['sucesso'])): ?>
        <p style="color: green;">Turma cadastrada com sucesso!</p>
    <?php endif; ?>

    <form action="../TurmaController.php" method="POST">
        
        <label>Nome da Turma:</label><br>
        <input type="text" name="nome" required placeholder="Ex: Iniciação Tarde">
        <br><br>

        <label>Entidade (Clube/Escola):</label><br>
        <select name="idEntidade" required>
            <option value="">Selecione uma entidade...</option>
            
            <?php foreach($listaEntidades as $entidade): ?>
                <option value="<?php echo $entidade['id']; ?>">
                    <?php echo $entidade['nome']; ?>
                </option>
            <?php endforeach; ?>
            
        </select>
        <br><br>
        
        <button type="submit" name="acao" value="cadastrar">Salvar Turma</button>
    </form>

</body>
</html>



