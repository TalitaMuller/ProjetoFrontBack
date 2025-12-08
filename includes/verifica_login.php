<?php

// Inicia a sessão (se já não estiver iniciada)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se a variável de sessão 'logado' existe
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Se não estiver logado, mata o script e manda pro login
    header("Location: index.php?erro=acesso_negado");
    exit;
}

?>