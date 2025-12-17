<?php
require_once '../../../includes/verifica_login.php';
require_once '../TurmaDAO.php';
require_once '../../entidade/EntidadeDAO.php';

// Validações de ID
if (!isset($_GET['id'])) { header('Location: listar.php'); exit; }

$dao = new TurmaDAO();
$turma = $dao->buscarPorId($_GET['id']);
if (!$turma) { header('Location: listar.php'); exit; }

// Busca todas as entidades para o select
$entidadeDAO = new EntidadeDAO();
$listaEntidades = $entidadeDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Turma</title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=10">
    
    <link rel="stylesheet" href="../../../assets/css/pages/form-crud.css?v=10">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">

</head>
<body>

    <main class="crud-container">
        
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="../../../home.php">Home</a> 
            <span>/</span> 
            <a href="listar.php">Turmas</a>
            <span>/</span> 
            <strong>Editar</strong>
        </nav>

        <header class="form-header">
            <h2>Editar Turma</h2>
        </header>

        <form action="../TurmaController.php" method="POST">
            <input type="hidden" name="acao" value="atualizar">
            <input type="hidden" name="id" value="<?php echo $turma['id']; ?>">

            <div>
                <label for="nome">Nome da Turma</label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($turma['nome']); ?>" required>
            </div>

            <div>
                <label for="idEntidade">Entidade (Clube/Escola)</label>
                <select name="idEntidade" id="idEntidade" required>
                    <?php foreach($listaEntidades as $e): ?>
                        <option value="<?php echo $e['id']; ?>" 
                            <?php echo ($e['id'] == $turma['idEntidade']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($e['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-actions">
                <a href="listar.php" class="btn-cancelar">Cancelar</a>
                
                <button type="submit" class="btn-salvar">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </main>
    
    <script src="../../../assets/js/components/darkmode.js"></script>
</body>
</html>