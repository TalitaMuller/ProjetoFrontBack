<?php
require_once '../../../includes/verifica_login.php';
require_once '../../ginasta/GinastaDAO.php';
require_once '../../aparelho/AparelhoDAO.php';
require_once '../../nivel/NivelDAO.php';

// Verifica parâmetros
if (!isset($_GET['idGinasta']) || !isset($_GET['idAparelho'])) {
    header('Location: selecionar.php');
    exit;
}

$idGinasta = $_GET['idGinasta'];
$idAparelho = $_GET['idAparelho'];

$ginastaDAO = new GinastaDAO();
$ginasta = $ginastaDAO->buscarPorId($idGinasta);

$aparelhoDAO = new AparelhoDAO();
$aparelho = $aparelhoDAO->buscarPorId($idAparelho);

$nivelDAO = new NivelDAO();
$todosExercicios = $nivelDAO->listarPorAparelho($idAparelho);

// LÓGICA DE ORGANIZAÇÃO (MATRIZ)
$dadosOrganizados = [];
foreach ($todosExercicios as $item) {
    $nomeGrupo = $item['nome_grupo'];
    
    // Formatação visual do grupo
    if (!empty($item['num_grupo'])) {
        $nomeGrupo = "<span>G" . $item['num_grupo'] . "</span><br><small>" . $nomeGrupo . "</small>";
    } else {
        $nomeGrupo = "<strong>Livres</strong>";
    }
    
    $ponto = $item['ponto']; // 1 a 5
    $dadosOrganizados[$nomeGrupo][$ponto][] = $item;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação - <?php echo htmlspecialchars($aparelho['nome']); ?></title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=16">
    <link rel="stylesheet" href="../../../assets/css/pages/sumula.css?v=16">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">

</head>
<body>

    <main style="max-width: 1400px;"> <div class="link-voltar">
            <a href="selecionar.php">⬅ Voltar para Seleção</a>
        </div>

        <div class="cabecalho-sumula">
            <img src="../../../assets/img/<?php echo !empty($ginasta['foto']) ? $ginasta['foto'] : 'perfilPadrao.png'; ?>" 
                 class="foto-ginasta" alt="Foto">
            
            <div class="info-texto">
                <h2><?php echo htmlspecialchars($ginasta['nome']); ?></h2>
                <p>
                    <strong>Aparelho:</strong> <?php echo htmlspecialchars($aparelho['nome']); ?> 
                    <span style="margin: 0 10px; color: var(--border-color);">|</span>
                    <strong>Turma:</strong> <?php echo htmlspecialchars($ginasta['nome_turma']); ?>
                </p>
            </div>
        </div>

        <form action="../ItemSumulaController.php" method="POST">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="idGinasta" value="<?php echo $idGinasta; ?>">
            <input type="hidden" name="idAparelho" value="<?php echo $idAparelho; ?>">

            <?php if (empty($dadosOrganizados)): ?>
                <div class="msg-erro">
                    <h3>Ops! 😕</h3>
                    <p>Nenhum exercício cadastrado para este aparelho.</p>
                </div>
            <?php else: ?>

                <div class="container-tabela">
                    <table class="tabela-sumula">
                        <thead>
                            <tr>
                                <th style="width: 8%;">GRUPO</th>
                                <th style="width: 18.4%;">NÍVEL 1 <br><small>(1.0 pt)</small></th>
                                <th style="width: 18.4%;">NÍVEL 2 <br><small>(2.0 pts)</small></th>
                                <th style="width: 18.4%;">NÍVEL 3 <br><small>(3.0 pts)</small></th>
                                <th style="width: 18.4%;">NÍVEL 4 <br><small>(4.0 pts)</small></th>
                                <th style="width: 18.4%;">NÍVEL 5 <br><small>(5.0 pts)</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dadosOrganizados as $nomeGrupo => $colunas): ?>
                                <tr>
                                    <td class="coluna-grupo">
                                        <?php echo $nomeGrupo; ?>
                                    </td>

                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <td>
                                            <?php 
                                            if (isset($colunas[$i])) {
                                                foreach ($colunas[$i] as $ex) {
                                                    ?>
                                                    <label class="card-exercicio">
                                                        <input type="checkbox" name="exercicios_selecionados[]" value="<?php echo $ex['id_nivel']; ?>">
                                                        <span><?php echo htmlspecialchars($ex['exercicio']); ?></span>
                                                    </label>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn-salvar-avaliacao">
                    Salvar Súmula
                </button>

            <?php endif; ?>
        </form>

    </main>
    
    <script src="../../../assets/js/components/darkmode.js?v=16"></script>
</body>
</html>