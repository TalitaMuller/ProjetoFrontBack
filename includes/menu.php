<?php
// Define o caminho base
$path = (strpos($_SERVER['SCRIPT_NAME'], '/src/') !== false) ? '../../../' : './';
?>

<header class="cabecalho-principal">
    <div class="container-menu">
        <a href="<?php echo $path; ?>home.php" class="logo">
            Súmula Digital
        </a>

        <button class="menu-toggle" aria-label="Abrir Menu">
            ☰
        </button>

        <nav class="nav-links">
            <a href="<?php echo $path; ?>home.php">Home</a>
            <a href="<?php echo $path; ?>src/entidade/views/listar.php">Entidades</a>
            <a href="<?php echo $path; ?>src/turma/views/listar.php">Turmas</a>
            <a href="<?php echo $path; ?>src/ginasta/views/listar.php">Ginastas</a>
            
            <div class="divisor-menu"></div>

            <a href="<?php echo $path; ?>src/usuario/views/perfil.php">Meu Perfil</a>
            
            <a href="<?php echo $path; ?>src/usuario/UsuarioController.php?acao=sair" class="btn-sair">
                Sair
            </a>
            
            <button id="btn-tema-menu" class="btn-tema-toggle">🌙</button>
        </nav>
    </div>
</header>