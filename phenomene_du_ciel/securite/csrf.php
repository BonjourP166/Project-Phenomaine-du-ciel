<?php
// Génère un token unique s'il n'existe pas déjà
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); // 32 caractères aléatoires
}

// Fonction de vérification du token reçu
function verif_csrf_token($token_recu) {
    if (!isset($_SESSION['csrf_token']) || $token_recu !== $_SESSION['csrf_token']) {
        die("<p style='color:red;'>Erreur de sécurité : action non autorisée ⚠️</p>");
    }
}
?>
