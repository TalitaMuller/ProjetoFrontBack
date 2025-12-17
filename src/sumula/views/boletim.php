<?php
require_once '../../../includes/verifica_login.php';
require_once '../../ginasta/GinastaDAO.php';
require_once '../../aparelho/AparelhoDAO.php';
require_once '../../nivel/NivelDAO.php';
require_once '../ItemSumulaDAO.php'; 

// Verifica IDs
if (!isset($_GET['idGinasta']) || !isset($_GET['idAparelho'])) {
    header('Location: ../../../home.php');
    exit;
}

$idGinasta = $_GET['idGinasta'];
$idAparelho = $_GET['idAparelho'];

// Carrega dados básicos
$ginastaDAO = new GinastaDAO();
$ginasta = $ginastaDAO->buscarPorId($idGinasta);

$aparelhoDAO = new AparelhoDAO();
$aparelho = $aparelhoDAO->buscarPorId($idAparelho);

// Carrega TODOS os exercícios possíveis
$nivelDAO = new NivelDAO();
$todosExercicios = $nivelDAO->listarPorAparelho($idAparelho);

// Carrega QUAIS exercícios a ginasta já fez
$itemSumulaDAO = new ItemSumulaDAO();
$idsMarcados = $itemSumulaDAO->buscarExerciciosRealizados($idGinasta);

// rganiza a tabela e CALCULA A NOTA
$dadosOrganizados = [];
$notaFinal = 0;

foreach ($todosExercicios as $item) {
    $nomeGrupo = $item['nome_grupo'];
    
    // Formatação visual do grupo
    if (!empty($item['num_grupo'])) {
        $nomeGrupo = "<span>G" . $item['num_grupo'] . "</span><br><small>" . $nomeGrupo . "</small>";
    } else {
        $nomeGrupo = "<strong>Livres</strong>";
    }
    
    // Verifica se foi feito
    $foiFeito = in_array($item['id_nivel'], $idsMarcados);
    $item['checked'] = $foiFeito;
    
    // Soma nota
    if ($foiFeito) {
        $notaFinal += $item['ponto'];
    }

    $ponto = $item['ponto'];
    $dadosOrganizados[$nomeGrupo][$ponto][] = $item;
}

// Formata a nota para 1 casa decimal (ex: 15.0)
$notaFormatada = number_format($notaFinal, 1, ',', '.');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletim - <?php echo htmlspecialchars($ginasta['nome']); ?></title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=18">
    
    <link rel="stylesheet" href="../../../assets/css/pages/boletim.css??v=18">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">

</head>
<body>

    <main>
        
        <a href="../../../home.php" class="link-voltar no-print">⬅ Voltar ao Início</a>

        <div class="cabecalho-resultado">
            <div class="ginasta-info">
                <img src="../../../assets/img/<?php echo !empty($ginasta['foto']) ? $ginasta['foto'] : 'perfilPadrao.png'; ?>" 
                     class="foto-boletim" alt="Foto">
                
                <div>
                    <h2><?php echo htmlspecialchars($ginasta['nome']); ?></h2>
                    <p>
                        <strong>Aparelho:</strong> <?php echo htmlspecialchars($aparelho['nome']); ?> | 
                        <strong>Turma:</strong> <?php echo htmlspecialchars($ginasta['nome_turma']); ?>
                    </p>
                </div>
            </div>
            
            <div class="placar-nota">
                <span>Pontuação Total</span>
                <h1><?php echo $notaFormatada; ?></h1>
            </div>
        </div>

        <div class="container-tabela">
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">GRUPO</th>
                        <th>NÍVEL 1 (1.0)</th>
                        <th>NÍVEL 2 (2.0)</th>
                        <th>NÍVEL 3 (3.0)</th>
                        <th>NÍVEL 4 (4.0)</th>
                        <th>NÍVEL 5 (5.0)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dadosOrganizados as $nomeGrupo => $colunas): ?>
                        <tr>
                            <td class="coluna-grupo"><?php echo $nomeGrupo; ?></td>
                            
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <td>
                                    <?php 
                                    if (isset($colunas[$i])) {
                                        foreach ($colunas[$i] as $ex) {
                                            $classeCSS = $ex['checked'] ? 'card-resultado feito' : 'card-resultado';
                                            ?>
                                            <div class="<?php echo $classeCSS; ?>">
                                                <?php echo htmlspecialchars($ex['exercicio']); ?>
                                            </div>
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
        
        <button onclick="window.print()" class="btn-imprimir no-print">
            Imprimir Súmula
        </button>

    </main>
    
    <script src="../../../assets/js/components/darkmode.js"></script>
</body>
</html>