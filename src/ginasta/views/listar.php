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
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>

    <main>
        <div style="margin-bottom: 20px;">
            <a href="../../../home.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg> Voltar ao Painel</a> | 
            <a href="cadastrar.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg> Cadastrar Nova Ginasta</a>
        </div>
        
        <h2>Ginastas Cadastradas</h2>

        <?php if(isset($_GET['sucesso'])): ?>
            <div class="msg-sucesso">Ação realizada com sucesso!</div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Ano Nasc.</th>
                    <th>Turma</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaGinastas as $g): ?>
                    <tr>
                        <td>
                            <img src="../../../assets/img/<?php echo $g['foto']; ?>" class="foto-perfil">
                        </td>
                        <td><?php echo $g['nome']; ?></td>
                        <td><?php echo $g['anoNasc']; ?></td>
                        <td><?php echo $g['nome_turma']; ?></td>
                        <td>
                            <a href="#">Editar</a> | 
                            <a href="#">Excluir</a> |
                            <a href="#" style="color: #27ae60;"><strong> Montar Súmula</strong></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                <?php if(empty($listaGinastas)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 20px;">Nenhuma ginasta cadastrada ainda.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

</body>
</html>