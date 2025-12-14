<?php

require_once '../../../includes/verifica_login.php';
require_once '../../ginasta/GinastaDAO.php';
require_once '../../aparelho/AparelhoDAO.php';
require_once '../../nivel/NivelDAO.php';

// Verifica se recebeu os IDs
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
// $dadosOrganizados[NomeDoGrupo][Ponto] = Array de exercícios
$dadosOrganizados = [];

foreach ($todosExercicios as $item) {
    // Define o nome do grupo
    $nomeGrupo = $item['nome_grupo'];
    
    if (!empty($item['num_grupo'])) {

        // Ex: "G1 - Suspensão" ou apenas "Suspensão"
        $nomeGrupo = "<b>G" . $item['num_grupo'] . "</b><br>" . $nomeGrupo;
    } else {
        $nomeGrupo = "<b>Livres</b>";
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
    <title>Avaliação - <?php echo $aparelho['nome']; ?></title>
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; color: #333; }
        
        .cabecalho-sumula {
            display: flex; align-items: center; gap: 20px;
            background: #fff; padding: 15px 20px;
            border-radius: 8px; margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-left: 5px solid #1cacbc;
        }
        .foto-ginasta { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #eee; }
        .info-texto h2 { margin: 0; font-size: 1.2rem; color: #2c3e50; }
        .info-texto p { margin: 2px 0 0 0; color: #666; font-size: 0.9rem; }
        
        .btn-salvar {
            background-color: #28a745; color: white; border: none; padding: 15px 30px;
            font-size: 1.1rem; border-radius: 5px; cursor: pointer; font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: 0.2s;
            margin-top: 20px; display: block; width: 100%; max-width: 300px; margin-left: auto; margin-right: auto;
        }
        .btn-salvar:hover { background-color: #218838; transform: translateY(-2px); }

        .container-tabela {
            overflow-x: auto; 
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px; 
        }

        
        th {
            background-color: #1cacbc;
            color: white;
            padding: 10px;
            text-transform: uppercase;
            font-size: 0.9rem;
            border: 1px solid #158f9e;
        }

        
        td {
            border: 1px solid #ddd;
            vertical-align: top; 
            padding: 5px;
            width: 18%; 
        }

        
        .coluna-grupo {
            background-color: #eee;
            font-weight: normal;
            text-align: center;
            vertical-align: middle;
            width: 10%;
            font-size: 0.9rem;
            border-right: 2px solid #ccc;
        }

        .card-exercicio {
            display: block;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 5px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.85rem;
            line-height: 1.3;
            position: relative;
        }

        .card-exercicio input {
            position: absolute; opacity: 0; cursor: pointer; height: 0; width: 0;
        }

        .card-exercicio:hover { background-color: #f0fbff; border-color: #1cacbc; }

        .card-exercicio:has(input:checked) {
            background-color: #1cacbc;
            color: white;
            border-color: #158f9e;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(28, 172, 188, 0.4);
        }

        .card-exercicio input:checked + span { font-weight: bold; }
        
    </style>
</head>
<body>

    <main>
        <a href="selecionar.php" style="text-decoration: none; color: #666; font-weight: bold;">⬅ Voltar</a>

        <div class="cabecalho-sumula">
            <img src="../../../assets/img/<?php echo $ginasta['foto'] ? $ginasta['foto'] : 'perfilPadrao.png'; ?>" 
                 class="foto-ginasta">
            <div class="info-texto">
                <h2><?php echo $ginasta['nome']; ?></h2>
                <p><strong>Aparelho:</strong> <?php echo $aparelho['nome']; ?> | <strong>Turma:</strong> <?php echo $ginasta['nome_turma']; ?></p>
            </div>
        </div>

        <form action="salvar.php" method="POST">
            <input type="hidden" name="idGinasta" value="<?php echo $idGinasta; ?>">
            <input type="hidden" name="idAparelho" value="<?php echo $idAparelho; ?>">

            <?php if (empty($dadosOrganizados)): ?>
                <p style="text-align: center; color: red;">Nenhum exercício encontrado para este aparelho.</p>
            <?php else: ?>

                <div class="container-tabela">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%;">GRUPO</th>
                                <th>NÍVEL 1 <br><small>(1.0 pt)</small></th>
                                <th>NÍVEL 2 <br><small>(2.0 pts)</small></th>
                                <th>NÍVEL 3 <br><small>(3.0 pts)</small></th>
                                <th>NÍVEL 4 <br><small>(4.0 pts)</small></th>
                                <th>NÍVEL 5 <br><small>(5.0 pts)</small></th>
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
                                                        <span><?php echo $ex['exercicio']; ?></span>
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

                <button type="submit" class="btn-salvar">SALVAR AVALIAÇÃO</button>

            <?php endif; ?>
        </form>

    </main>

</body>
</html>