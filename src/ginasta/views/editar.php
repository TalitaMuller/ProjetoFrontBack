<?php
require_once '../../../includes/verifica_login.php';
require_once '../GinastaDAO.php';
require_once '../../turma/TurmaDAO.php'; 

// Validação de ID
if (!isset($_GET['id'])) { header('Location: listar.php'); exit; }

$id = $_GET['id'];

$ginastaDAO = new GinastaDAO();
$ginasta = $ginastaDAO->buscarPorId($id);

// Se não achar, volta
if (!$ginasta) { header('Location: listar.php'); exit; }

// Busca turmas para o select
$turmaDAO = new TurmaDAO(); 
$listaTurmas = $turmaDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ginasta</title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=10">
    
    <link rel="stylesheet" href="../../../assets/css/pages/form-crud.css?v=10">

    <link rel="stylesheet" href="../../../assets/css/components/upload.css?v=10">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">
</head>
<body>

    <main class="crud-container">
        
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="../../../home.php">Home</a> 
            <span>/</span> 
            <a href="listar.php">Ginastas</a>
            <span>/</span> 
            <strong>Editar</strong>
        </nav>

        <header class="form-header">
            <h2>Editar Ginasta</h2>
        </header>

        <form action="../GinastaController.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="acao" value="atualizar">
            <input type="hidden" name="id" value="<?php echo $ginasta['id']; ?>">
            <input type="hidden" name="foto_atual" value="<?php echo $ginasta['foto']; ?>">

            <div style="text-align: center; margin-bottom: 20px;">
                <p style="font-size: 0.85rem; color: #666; margin-bottom: 5px;">Foto Atual:</p>
                <img src="../../../assets/img/<?php echo !empty($ginasta['foto']) ? $ginasta['foto'] : 'perfilPadrao.png'; ?>" 
                     style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #eee; box-shadow: 0 2px 5px rgba(0,0,0,0.1);"
                     alt="Foto Atual">
            </div>

            <div>
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($ginasta['nome']); ?>" required>
            </div>

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label for="anoNasc">Ano Nasc.</label>
                    <input type="number" id="anoNasc" name="anoNasc" value="<?php echo htmlspecialchars($ginasta['anoNasc']); ?>" required>
                </div>
                <div style="flex: 2;">
                    <label for="idTurma">Turma</label>
                    <select name="idTurma" id="idTurma" required>
                        <?php foreach($listaTurmas as $t): ?>
                            <option value="<?php echo $t['id']; ?>" 
                                <?php echo ($t['id'] == $ginasta['idTurma']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($t['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div>
                <label>Trocar Foto (Opcional)</label>
                <label for="foto" class="area-upload" id="drop-zone">
                    <span class="texto-upload" id="texto-upload">
                        📂 Clique ou arraste uma NOVA foto aqui
                    </span>
                    <input type="file" name="foto" id="foto" accept="image/*">
                    <br>
                    <img id="preview" class="preview-img" alt="Prévia da nova foto">
                </label>
            </div>

            <div class="form-actions">
                <a href="listar.php" class="btn-cancelar">Cancelar</a>
                <button type="submit" class="btn-salvar">Salvar Alterações</button>
            </div>
        </form>
    </main>

    <script src="../../../assets/js/components/upload.js" defer></script>
    
    <script src="../../../assets/js/components/darkmode.js"></script>
</body>
</html>