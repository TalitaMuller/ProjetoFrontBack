<?php
require_once '../../../includes/verifica_login.php';
require_once '../../ginasta/GinastaDAO.php';
require_once '../../aparelho/AparelhoDAO.php';

// Busca as listas para preencher os selects
$ginastaDAO = new GinastaDAO();
$listaGinastas = $ginastaDAO->listar();

$aparelhoDAO = new AparelhoDAO();
$listaAparelhos = $aparelhoDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Súmula - Súmula Digital</title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=10">
    
    <link rel="stylesheet" href="../../../assets/css/pages/form-crud.css?v=10">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">

</head>
<body>

    <main class="crud-container">
        
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="../../../home.php">Home</a> 
            <span>/</span> 
            <strong>Consultar Súmula</strong>
        </nav>

        <header class="form-header">
            <h2>Ver Resultados</h2>
            <p style="color: #666; font-size: 0.9rem; margin-top: 5px;">
                Selecione a ginasta e o aparelho para visualizar a nota.
            </p>
        </header>

        <form action="boletim.php" method="GET">
            
            <div>
                <label for="idGinasta">Ginasta:</label>
                <select name="idGinasta" id="idGinasta" required>
                    <option value="">Selecione...</option>
                    <?php foreach($listaGinastas as $g): ?>
                        <option value="<?php echo $g['id']; ?>">
                            <?php echo htmlspecialchars($g['nome']); ?> 
                            (<?php echo htmlspecialchars($g['nome_turma']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="idAparelho">Aparelho:</label>
                <select name="idAparelho" id="idAparelho" required>
                    <option value="">Selecione...</option>
                    <?php foreach($listaAparelhos as $a): ?>
                        <option value="<?php echo $a['id']; ?>">
                            <?php echo htmlspecialchars($a['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-actions">
                <a href="../../../home.php" class="btn-cancelar">Cancelar</a>
                
                <button type="submit" class="btn-primary">
                    Ver Súmula
                </button>
            </div>
        </form>

    </main>
    
    <script src="../../../assets/js/components/darkmode.js"></script>
</body>
</html>