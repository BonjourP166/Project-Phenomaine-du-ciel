<?php
// === DEBUG (à désactiver plus tard en production) ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === INCLUSIONS ===
require_once '../securite/session_secure.php';
require_once '../includes/bd.php';
require_once '../securite/csrf.php';

// === 1️⃣ Vérification de la méthode ===
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "success" => false,
        "message" => "⚠️ Méthode non autorisée."
    ]);
    exit;
}

// === 2️⃣ Vérifie le token CSRF ===
if (!isset($_POST['csrf_token'])) {
    echo json_encode([
        "success" => false,
        "message" => "⚠️ Token CSRF manquant."
    ]);
    exit;
}

try {
    verif_csrf_token($_POST['csrf_token']);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "⛔ Sécurité CSRF : " . $e->getMessage()
    ]);
    exit;
}

// === 3️⃣ Nettoyage des données reçues ===
$email = htmlspecialchars(trim($_POST['email'] ?? ''));
$mot_de_passe = trim($_POST['mot_de_passe'] ?? '');

if (empty($email) || empty($mot_de_passe)) {
    echo json_encode([
        "success" => false,
        "message" => "⚠️ Veuillez renseigner tous les champs."
    ]);
    exit;
}

// === 4️⃣ Vérification dans la base ===
try {
    $bdd = getBD();

    $sql = "SELECT id, prenom, nom, mot_de_passe, email, role, image_profil 
            FROM utilisateurs 
            WHERE email = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$utilisateur) {
        echo json_encode([
            "success" => false,
            "message" => "❌ Aucun compte trouvé avec cet email."
        ]);
        exit;
    }

    // === 5️⃣ Vérifie le mot de passe ===
    if (!password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        echo json_encode([
            "success" => false,
            "message" => "🔐 Mot de passe incorrect."
        ]);
        exit;
    }

    // === 6️⃣ Connexion réussie : création de la session ===
    $_SESSION['utilisateur'] = [
        'id' => $utilisateur['id'],
        'prenom' => $utilisateur['prenom'],
        'nom' => $utilisateur['nom'],
        'email' => $utilisateur['email'],
        'role' => $utilisateur['role'],
        'image_profil' => $utilisateur['image_profil']
    ];

    echo json_encode([
        "success" => true,
        "message" => "✅ Connexion réussie ! Bienvenue " . htmlspecialchars($utilisateur['prenom']) . " 🎉"
    ]);
    exit;

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "❌ Erreur serveur : " . htmlspecialchars($e->getMessage())
    ]);
    exit;
}
?>
