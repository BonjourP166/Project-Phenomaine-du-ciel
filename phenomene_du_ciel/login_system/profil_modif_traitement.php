<?php
// === DEBUG (à désactiver plus tard) ===
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// === INCLUSIONS ===
require_once '../includes/bd.php';
require_once '../securite/session_secure.php';
require_once '../securite/csrf.php';

// === 1️⃣ Vérifie la méthode ===
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "success" => false,
        "message" => "⚠️ Méthode non autorisée."
    ]);
    exit;
}

// === 2️⃣ Vérifie la session ===
// ✅ Correction ici : ne pas relancer une session déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['utilisateur']['id'])) {
    echo json_encode([
        "success" => false,
        "message" => " Accès refusé : utilisateur non connecté."
    ]);
    exit;
}

$id = $_SESSION['utilisateur']['id'];

// === 3️⃣ Vérifie le token CSRF ===
if (empty($_POST['csrf_token'])) {
    echo json_encode([
        "success" => false,
        "message" => " Token CSRF manquant."
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

// === 4️⃣ Nettoyage et validation des champs ===
$ville = !empty($_POST['ville']) ? htmlspecialchars(trim($_POST['ville'])) : null;
$bio = !empty($_POST['bio']) ? htmlspecialchars(trim($_POST['bio'])) : null;

// === 5️⃣ Gestion de l’image (optionnelle) ===
$image_profil = null;

if (!empty($_FILES['image_profil']) && $_FILES['image_profil']['error'] === 0) {
    $dossier = '../uploads/';
    if (!is_dir($dossier)) {
        mkdir($dossier, 0755, true);
    }

    $extension = strtolower(pathinfo($_FILES['image_profil']['name'], PATHINFO_EXTENSION));
    $nom_fichier = 'profil_' . $id . '_' . time() . '.' . $extension;
    $chemin_complet = $dossier . $nom_fichier;

    if (move_uploaded_file($_FILES['image_profil']['tmp_name'], $chemin_complet)) {
        $image_profil = '../uploads/' . $nom_fichier;
    } else {
        echo json_encode([
            "success" => false,
            "message" => "⚠️ Échec du téléchargement de l’image."
        ]);
        exit;
    }
}

// === 6️⃣ Mise à jour en base ===
try {
    $bdd = getBD();

    // On construit la requête dynamiquement selon les champs reçus
    $sql = "UPDATE utilisateurs SET ";
    $params = [];
    $fields = [];

    if ($ville !== null) {
        $fields[] = "ville = ?";
        $params[] = $ville;
    }

    if ($bio !== null) {
        $fields[] = "bio = ?";
        $params[] = $bio;
    }

    if ($image_profil !== null) {
        $fields[] = "image_profil = ?";
        $params[] = $image_profil;
    }

    // Si aucun champ modifié → inutile de continuer
    if (empty($fields)) {
        echo json_encode([
            "success" => false,
            "message" => "⚠️ Aucun champ à mettre à jour."
        ]);
        exit;
    }

    $sql .= implode(", ", $fields) . " WHERE id = ?";
    $params[] = $id;

    $stmt = $bdd->prepare($sql);
    $stmt->execute($params);

    // === 7️⃣ Met à jour aussi la session ===
    foreach ($params as $index => $value) {
        if (str_contains($fields[$index], 'ville')) {
            $_SESSION['utilisateur']['ville'] = $ville;
        } elseif (str_contains($fields[$index], 'bio')) {
            $_SESSION['utilisateur']['bio'] = $bio;
        } elseif (str_contains($fields[$index], 'image_profil')) {
            $_SESSION['utilisateur']['image_profil'] = $image_profil;
        }
    }

    echo json_encode([
        "success" => true,
        "message" => "✅ Profil mis à jour avec succès.",
        "profil" => [
            "ville" => $ville,
            "bio" => $bio,
            "image_profil" => $image_profil
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "❌ Erreur base de données : " . htmlspecialchars($e->getMessage())
    ]);
}
?>
