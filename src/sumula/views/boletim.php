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

// 1. Carrega TODOS os exercícios possíveis (para montar a tabela vazia)
$nivelDAO = new NivelDAO();
$todosExercicios = $nivelDAO->listarPorAparelho($idAparelho);

// 2. Carrega QUAIS exercícios a ginasta já fez (IDs marcados no banco)
$itemSumulaDAO = new ItemSumulaDAO();
$idsMarcados = $itemSumulaDAO->buscarExerciciosRealizados($idGinasta);

// 3. Organiza a tabela e CALCULA A NOTA
$dadosOrganizados = [];
$notaFinal = 0;

foreach ($todosExercicios as $item) {

    $nomeGrupo = $item['nome_grupo'];
    if (!empty($item['num_grupo'])) {
        $nomeGrupo = "<b>G" . $item['num_grupo'] . "</b><br>" . $nomeGrupo;
    } else {
        $nomeGrupo = "<b>Livres</b>";
    }
    
    // Verifica se esse exercício está na lista de marcados
    $foiFeito = in_array($item['id_nivel'], $idsMarcados);
    $item['checked'] = $foiFeito; // Adiciona um campo "checked" no array
    
    // Se foi feito, soma na nota final
    if ($foiFeito) {
        $notaFinal += $item['ponto'];
    }

    $ponto = $item['ponto'];
    $dadosOrganizados[$nomeGrupo][$ponto][] = $item;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletim - <?php echo $ginasta['nome']; ?></title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; padding: 20px; color: #333; }
        
        .cabecalho-resultado {
            display: flex; justify-content: space-between; align-items: center;
            background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-left: 5px solid #28a745; /* Verde para resultado */
        }
        .ginasta-info { display: flex; align-items: center; gap: 15px; }
        .foto { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; }
        
        .placar-nota {
            text-align: center; background: #28a745; color: white;
            padding: 10px 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }
        .placar-nota h1 { margin: 0; font-size: 2.5rem; }
        .placar-nota span { font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; }

        .container-tabela { overflow-x: auto; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 10px; }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        th { background-color: #666; color: white; padding: 10px; font-size: 0.9rem; border: 1px solid #555; }
        td { border: 1px solid #ddd; padding: 5px; width: 18%; vertical-align: top; }
        .coluna-grupo { background-color: #eee; text-align: center; vertical-align: middle; width: 10%; font-size: 0.85rem; }

        .card-resultado {
            display: block; background: #f9f9f9; border: 1px solid #e0e0e0;
            border-radius: 4px; padding: 8px; margin-bottom: 5px;
            font-size: 0.85rem; line-height: 1.3; color: #aaa; 
        }

        .feito {
            background-color: #d4edda; 
            border-color: #c3e6cb;
            color: #155724; 
            font-weight: bold;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .feito::before { content: "✔ "; color: #28a745; font-weight: 800; }

        @media print {
            .btn-voltar, .no-print { display: none; }
            body { background: white; }
            .cabecalho-resultado { border: 1px solid #ccc; box-shadow: none; }
        }
    </style>
</head>
<body>

    <a href="../../../home.php" class="btn-voltar" style="text-decoration: none; color: #666; font-weight: bold;">⬅ Voltar ao Início</a>

    <div class="cabecalho-resultado">
        <div class="ginasta-info">
            <img src="../../../assets/img/<?php echo $ginasta['foto'] ? $ginasta['foto'] : 'perfilPadrao.png'; ?>" class="foto">
            <div>
                <h2 style="margin:0"><?php echo $ginasta['nome']; ?></h2>
                <p style="margin:0; font-size: 0.9rem; color: #666;"><?php echo $aparelho['nome']; ?></p>
            </div>
        </div>
        
        <div class="placar-nota">
            <span>Pontuação Total</span>
            <h1><?php echo $notaFinal; ?></h1>
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
                                        // Define a classe CSS baseada se foi feito ou não
                                        $classeCSS = $ex['checked'] ? 'card-resultado feito' : 'card-resultado';
                                        ?>
                                        <div class="<?php echo $classeCSS; ?>">
                                            <?php echo $ex['exercicio']; ?>
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
    
    <br>
    <button onclick="window.print()" class="no-print" style="padding: 10px 20px; cursor: pointer;">🖨 Imprimir Boletim</button>

</body>
</html>