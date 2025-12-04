<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../securite/session_secure.php';
require_once '../bd.php';
require_once '../securite/csrf.php';

// Vérification POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Méthode non autorisée."]);
    exit;
}

// Vérification CSRF
if (empty($_POST['csrf_token'])) {
    echo json_encode(["success" => false, "message" => "Token CSRF manquant."]);
    exit;
}

try {
    verif_csrf_token($_POST['csrf_token']);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Sécurité CSRF : " . $e->getMessage()]);
    exit;
}

// Champs
$email = trim($_POST['email'] ?? '');
$mot_de_passe = trim($_POST['mot_de_passe'] ?? '');

if (empty($email) || empty($mot_de_passe)) {
    echo json_encode(["success" => false, "message" => "Veuillez remplir tous les champs."]);
    exit;
}

try {
    $bdd = getBD();

    // ✔ SELECT COMPLET
    $sql = "SELECT id, prenom, nom, mot_de_passe, email, role, image_profil,
                   date_inscription, ville, latitude, longitude, bio, date_naissance
            FROM utilisateurs
            WHERE email = ?";

    $stmt = $bdd->prepare($sql);
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$utilisateur) {
        echo json_encode(["success" => false, "message" => "Aucun compte trouvé."]);
        exit;
    }

    // Vérification MDP
    if (!password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        echo json_encode(["success" => false, "message" => "Mot de passe incorrect."]);
        exit;
    }

    // ✔ Mise en session complète
    $_SESSION['utilisateur'] = [
        'id'               => $utilisateur['id'],
        'prenom'           => $utilisateur['prenom'],
        'nom'              => $utilisateur['nom'],
        'email'            => $utilisateur['email'],
        'role'             => $utilisateur['role'],
        'image_profil'     => $utilisateur['image_profil'],
        'date_inscription' => $utilisateur['date_inscription'],
        'ville'            => $utilisateur['ville'],
        'latitude'         => $utilisateur['latitude'],
        'longitude'        => $utilisateur['longitude'],
        'bio'              => $utilisateur['bio'],
        'date_naissance'   => $utilisateur['date_naissance']
    ];

    echo json_encode([
        "success" => true,
        "prenom" => $utilisateur['prenom'],
        "message" => "Connexion réussie !"
    ]);
    exit;

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erreur serveur : " . $e->getMessage()]);
    exit;
}
?>
