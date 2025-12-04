<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}

function verif_csrf_token($token_recu) {
    if (!isset($_SESSION['csrf_token']) || $token_recu !== $_SESSION['csrf_token']) {
        die("<p style='color:red;'>Erreur de sécurité : action non autorisée ⚠️</p>");
    }
}
?>
