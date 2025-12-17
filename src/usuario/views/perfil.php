<?php
require_once '../../../includes/verifica_login.php';
require_once '../UsuarioDAO.php';

$dao = new UsuarioDAO();
$meusDados = $dao->buscarPorId($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    
    <link rel="stylesheet" href="../../../assets/css/global.css?v=12">
    <link rel="stylesheet" href="../../../assets/css/pages/perfil.css?v=12">
    <link rel="stylesheet" href="../../../assets/css/components/modal.css?v=12">

    <link rel="shortcut icon" href="../../../assets/img/favicon.ico" type="image/x-icon">
</head>
<body>

    <main class="main-perfil">
        <a href="../../../home.php" class="link-voltar">⬅ Voltar ao Painel</a>
        
        <div class="card-perfil">
            <header>
                <h2>Editar Perfil</h2>
            </header>
            
            <form action="../UsuarioController.php" method="POST" id="formPerfil">
                <input type="hidden" name="acao" value="atualizar">

                <div class="campo">
                    <label>Nome:</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($meusDados['nome']); ?>" required>
                </div>

                <div class="campo">
                    <label>E-mail:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($meusDados['email']); ?>" required>
                </div>

                <hr class="divisor-perfil">
                
                <p class="titulo-senha">Trocar Senha (Opcional):</p>

                <div class="grupo-senha">
                    <input type="password" name="nova_senha" id="nova_senha" placeholder="Nova senha (deixe vazio para manter)">
                    <span class="olho-senha" onclick="alternarSenha('nova_senha', this)" role="button">👁️</span>
                </div>

                <ul class="requisitos-senha" id="lista-requisitos">
                    <li id="req-tamanho">Mínimo 8 caracteres</li>
                    <li id="req-maiuscula">Pelo menos 1 letra maiúscula</li>
                    <li id="req-minuscula">Pelo menos 1 letra minúscula</li>
                    <li id="req-numero">Pelo menos 1 número</li>
                    <li id="req-simbolo">Pelo menos 1 símbolo (!@#$...)</li>
                </ul>

                <button type="submit" id="btn-salvar">
                    Salvar Alterações
                </button>
            </form>

            <div class="area-excluir">
                <a href="../UsuarioController.php?acao=excluir_conta" 
                   class="btn-excluir"
                   onclick="confirmarExclusao(event, 'SUA CONTA (Irreversível)', this.href);">
                   Excluir minha conta
                </a>
            </div>
        </div>
    </main>

    <script src="../../../assets/js/pages/perfil.js?v=12" defer></script>
    <script src="../../../assets/js/components/modal.js?v=12"></script>
    <script src="../../../assets/js/components/darkmode.js?v=12"></script>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'atualizado'): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarSucesso('Seus dados foram atualizados com sucesso!');
            });
        </script>
    <?php endif; ?>

</body>
</html>