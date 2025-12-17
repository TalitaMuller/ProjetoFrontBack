<?php
require_once '../../../includes/verifica_login.php';
require_once '../EntidadeDAO.php';

// Validação básica
if (!isset($_GET['id'])) { header('Location: listar.php'); exit; }

$dao = new EntidadeDAO();
$entidade = $dao->buscarPorId($_GET['id']);

// Se não achou no banco, volta pra lista
if (!$entidade) { header('Location: listar.php'); exit; }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entidade</title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=16">
    
    <link rel="stylesheet" href="../../../assets/css/pages/form-crud.css?v=16">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">
</head>
<body>

    <main class="crud-container">
        
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="../../../home.php">Home</a> 
            <span>/</span> 
            <a href="listar.php">Entidades</a>
            <span>/</span> 
            <strong>Editar</strong>
        </nav>

        <header class="form-header">
            <h2>Editar Entidade</h2>
        </header>

        <form action="../EntidadeController.php" method="POST">
            <input type="hidden" name="acao" value="atualizar">
            <input type="hidden" name="id" value="<?php echo $entidade['id']; ?>">

            <div>
                <label for="nome">Nome da Entidade:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($entidade['nome']); ?>" required>
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