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
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

    <main>
        <a href="../../../home.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg> Voltar ao Painel</a>
        
        <h2>Cadastrar Nova Turma</h2>

        <?php if(isset($_GET['sucesso'])): ?>
            <div class="msg-sucesso">Turma cadastrada com sucesso!</div>
        <?php endif; ?>

        <?php if(isset($_GET['erro'])): ?>
            <div class="msg-erro">Erro ao cadastrar. Verifique os dados.</div>
        <?php endif; ?>

        <form action="../TurmaController.php" method="POST">
            
            <div>
                <label for="nome">Nome da Turma:</label>
                <input type="text" id="nome" name="nome" required placeholder="Ex: Iniciação Tarde">
            </div>

            <div>
                <label for="idEntidade">Entidade (Clube/Escola):</label>
                <select name="idEntidade" id="idEntidade" required>
                    <option value="">Selecione uma entidade...</option>
                    
                    <?php foreach($listaEntidades as $entidade): ?>
                        <option value="<?php echo $entidade['id']; ?>">
                            <?php echo $entidade['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                    
                </select>
            </div>
            
            <button type="submit" name="acao" value="cadastrar">Salvar Turma</button>
        </form>
    </main>

</body>
</html>