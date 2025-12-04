<?php
// === DEBUG (à désactiver plus tard) ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === INCLUSIONS ===
require_once '../includes/bd.php';
require_once '../securite/session_secure.php';

// === 1️⃣ Vérifie que l'utilisateur est connecté ===
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['utilisateur']['id'])) {
    echo json_encode([
        "success" => false,
        "message" => "⛔ Accès refusé : utilisateur non connecté."
    ]);
    exit;
}

$id = $_SESSION['utilisateur']['id'];

// === 2️⃣ Récupération des infos en base ===
try {
    $bdd = getBD();
    $sql = "SELECT id, prenom, nom, email, ville, latitude, longitude, bio, date_naissance, image_profil, role 
            FROM utilisateurs 
            WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode([
            "success" => false,
            "message" => "⚠️ Utilisateur introuvable."
        ]);
        exit;
    }

    // === 3️⃣ Réponse JSON (en lecture seule) ===
    echo json_encode([
        "success" => true,
        "message" => "✅ Profil récupéré avec succès.",
        "profil" => [
            "id" => $user["id"],
            "prenom" => $user["prenom"],
            "nom" => $user["nom"],
            "email" => $user["email"],
            "ville" => $user["ville"],
            "latitude" => $user["latitude"],
            "longitude" => $user["longitude"],
            "bio" => $user["bio"],
            "date_naissance" => $user["date_naissance"],
            "image_profil" => $user["image_profil"],
            "role" => $user["role"]
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "❌ Erreur base de données : " . htmlspecialchars($e->getMessage())
    ]);
}
?>
