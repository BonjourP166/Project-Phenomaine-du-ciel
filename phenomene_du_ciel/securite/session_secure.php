<?php
// ✅ Si la session n'est pas encore démarrée
if (session_status() !== PHP_SESSION_ACTIVE) {

    // ⚙️ Paramètres de sécurité AVANT session_start()
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 0); // 1 si HTTPS
    ini_set('session.cookie_samesite', 'Strict');

    session_start(); // ✅ démarre la session ici
}

// 🧩 Crée un token CSRF s’il n’existe pas déjà
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}
?>
