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
    <title>Nova Súmula - Seleção</title>
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

    <main>
        <a href="../../../home.php">⬅ Voltar ao Painel</a>
        <hr>

        <h2>Nova Avaliação</h2>
        <p style="text-align: center; color: #666; margin-bottom: 20px;">
            Selecione a ginasta e o aparelho para começar a montar a súmula.
        </p>

        <form action="montar.php" method="GET">
            
            <div>
                <label for="idGinasta">Ginasta:</label>

                <select name="idGinasta" id="idGinasta" required>
                    <option value="">Selecione...</option>

                    <?php foreach($listaGinastas as $g): ?>

                        <option value="<?php echo $g['id']; ?>">
                            <?php echo $g['nome']; ?> (<?php echo $g['nome_turma']; ?>)
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
                            <?php echo $a['nome']; ?>
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>
            
            <button type="submit">Iniciar Avaliação </button>
        </form>

    </main>

</body>
</html>