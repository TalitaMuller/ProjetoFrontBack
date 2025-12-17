<?php
require_once '../../../includes/verifica_login.php';
require_once '../GinastaDAO.php';

$ginastaDAO = new GinastaDAO();
$listaGinastas = $ginastaDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ginastas - Súmula Digital</title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=18">
    <link rel="stylesheet" href="../../../assets/css/pages/listar.css?v=18">
    <link rel="stylesheet" href="../../../assets/css/components/modal.css?v=18">
    <link rel="stylesheet" href="../../../assets/css/components/menu.css?v=21">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">

</head>
<body>

    <?php include '../../../includes/menu.php'; ?>

    <main>
        <div class="topo-listagem">
            <h2>Ginastas Cadastradas</h2>
            
            <div class="acoes-topo">
                <input type="text" id="input-busca" placeholder="Pesquisar ginasta...">
                
                <a href="cadastrar.php" class="btn-adicionar">
                    + Nova Ginasta
                </a>
            </div>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="msg-sucesso">
                <?php 
                    if($_GET['msg'] == 'cadastrado') echo "Ginasta cadastrada com sucesso!";
                    elseif($_GET['msg'] == 'atualizado') echo "Dados atualizados com sucesso!";
                    elseif($_GET['msg'] == 'excluido') echo "Ginasta excluída com sucesso!";
                    else echo "Ação realizada com sucesso!";
                ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['erro'])): ?>
            <div class="msg-erro">
                <?php 
                    if($_GET['erro'] == 'tem_notas') echo "Não é possível excluir: Esta ginasta já possui notas lançadas!";
                    else echo "Ocorreu um erro na operação.";
                ?>
            </div>
        <?php endif; ?>

        <?php if (count($listaGinastas) > 0): ?>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">Foto</th> 
                            <th>Nome</th>
                            <th>Ano Nasc.</th>
                            <th>Turma</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaGinastas as $g): ?>
                            <tr>
                                <td style="text-align: center;">
                                    <img src="../../../assets/img/<?php echo !empty($g['foto']) ? $g['foto'] : 'perfilPadrao.png'; ?>" 
                                         class="foto-perfil-tabela" 
                                         alt="Foto de <?php echo htmlspecialchars($g['nome']); ?>">
                                </td>
                                
                                <td style="font-weight: 500;"><?php echo htmlspecialchars($g['nome']); ?></td>
                                
                                <td><?php echo htmlspecialchars($g['anoNasc']); ?></td>
                                
                                <td style="color: var(--text-muted);"><?php echo htmlspecialchars($g['nome_turma']); ?></td>
                                
                                <td style="text-align: center;">
                                    <a href="editar.php?id=<?php echo $g['id']; ?>" class="acao-icon" title="Editar Dados">
                                        ✏️
                                    </a>

                                    <a href="../GinastaController.php?acao=excluir&id=<?php echo $g['id']; ?>" 
                                       class="acao-icon" 
                                       onclick="confirmarExclusao(event, '<?php echo htmlspecialchars($g['nome']); ?>', this.href);" 
                                       title="Excluir">
                                        🗑️
                                    </a>
                                    
                                    <a href="../../sumula/views/selecionar.php?idGinasta=<?php echo $g['id']; ?>" 
                                       class="acao-icon" 
                                       style="color: var(--success-color);" 
                                       title="Montar Súmula">
                                        📝
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="msg-erro" style="background: var(--input-bg); color: var(--text-muted); border: 1px solid var(--border-color);">
                Nenhuma ginasta cadastrada ainda.
            </div>
        <?php endif; ?>
    </main>

    <script src="../../../assets/js/components/modal.js?v=12"></script>
    <script src="../../../assets/js/components/darkmode.js?v=12"></script>
    <script src="../../../assets/js/components/menu.js?v=20"></script>


    <script src="../../../assets/js/components/filtro.js?v=1"></script>
</body>
</html>