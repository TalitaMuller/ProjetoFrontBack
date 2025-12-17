<?php
require_once '../../../includes/verifica_login.php';
require_once '../TurmaDAO.php';

$dao = new TurmaDAO();
$lista = $dao->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Turmas</title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=18">
    <link rel="stylesheet" href="../../../assets/css/pages/listar.css?v=18">
    <link rel="stylesheet" href="../../../assets/css/components/modal.css?v=18">
    <link rel="stylesheet" href="../../../assets/css/components/menu.css?v=22">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">


</head>
<body>
    <?php include '../../../includes/menu.php'; ?>

    <main>
        <div class="topo-listagem">
            <h2>Turmas Cadastradas</h2>
            
            <div class="acoes-topo">
                <input type="text" id="input-busca" placeholder="Pesquisar turma...">
                
                <a href="cadastrar.php" class="btn-adicionar">
                    + Nova Turma
                </a>
            </div>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="msg-sucesso">
                <?php 
                    if($_GET['msg'] == 'cadastrado') echo "Turma cadastrada com sucesso!";
                    elseif($_GET['msg'] == 'atualizado') echo "Turma atualizada com sucesso!";
                    elseif($_GET['msg'] == 'excluido') echo "Turma excluída com sucesso!";
                    else echo "Ação realizada com sucesso!";
                ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['erro']) && $_GET['erro'] == 'tem_ginastas'): ?>
            <div class="msg-erro">
                Não é possível excluir: Existem ginastas vinculadas a esta turma!
            </div>
        <?php endif; ?>

        <?php if (count($lista) > 0): ?>
            <div style="overflow-x: auto;"> 
                <table>
                    <thead>
                        <tr>
                            <th>Turma</th>
                            <th>Entidade (Escola/Clube)</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista as $item): ?>
                        <tr>
                            <td style="font-weight: bold;"><?php echo htmlspecialchars($item['nome']); ?></td>
                            
                            <td style="color: var(--text-muted);"><?php echo htmlspecialchars($item['nome_entidade']); ?></td>
                            
                            <td style="text-align: center;">
                                <a href="editar.php?id=<?php echo $item['id']; ?>" class="acao-icon" title="Editar">✏️</a>
                                
                                <a href="../TurmaController.php?acao=excluir&id=<?php echo $item['id']; ?>" 
                                   class="acao-icon"
                                   onclick="confirmarExclusao(event, '<?php echo htmlspecialchars($item['nome']); ?>', this.href);" 
                                   title="Excluir">🗑️</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="msg-erro" style="background: var(--input-bg); color: var(--text-muted); border: 1px solid var(--border-color);">
                Nenhuma turma cadastrada ainda.
            </div>
        <?php endif; ?>
    </main>

    <script src="../../../assets/js/components/modal.js?v=12"></script>
    <script src="../../../assets/js/components/darkmode.js?v=12"></script>
    <script src="../../../assets/js/components/menu.js?v=21"></script>
    <script src="../../../assets/js/components/filtro.js?v=1"></script>
</body>
</html>