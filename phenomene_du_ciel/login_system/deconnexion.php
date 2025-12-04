<?php

// === DEBUG (à désactiver en production) ===
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// === 1️⃣ Démarrage de la session si nécessaire ===
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// === 2️⃣ Suppression de toutes les variables de session ===
$_SESSION = [];

// === 3️⃣ Suppression du cookie de session si existant ===
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// === 4️⃣ Destruction complète de la session ===
session_destroy();

// === 5️⃣ Réponse JSON claire pour le front/interac ===
echo json_encode([
    "success" => true,
    "message" => "👋 Déconnexion réussie ! À bientôt."
]);
exit;
?>
