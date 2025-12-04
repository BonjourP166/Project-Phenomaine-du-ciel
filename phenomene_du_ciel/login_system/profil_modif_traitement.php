<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once '../bd.php';
require_once '../securite/session_secure.php';
require_once '../securite/csrf.php';

// Vérifie méthode
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Méthode non autorisée."]);
    exit;
}

// Vérifie session
if (!isset($_SESSION['utilisateur']['id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non connecté."]);
    exit;
}

$id = $_SESSION['utilisateur']['id'];

// Vérifie token CSRF
if (empty($_POST['csrf_token'])) {
    echo json_encode(["success" => false, "message" => "Token CSRF manquant."]);
    exit;
}
verif_csrf_token($_POST['csrf_token']);


// 📌 Nettoyage des champs
$nom            = trim($_POST['nom'] ?? '');
$prenom         = trim($_POST['prenom'] ?? '');
$email          = trim($_POST['email'] ?? '');
$ville          = trim($_POST['ville'] ?? '');
$date_naissance = !empty($_POST['date_naissance']) ? $_POST['date_naissance'] : null;
$bio            = trim($_POST['bio'] ?? '');


// 📌 Récupérer l'image actuelle
$image_profil = $_SESSION['utilisateur']['image_profil'] ?? '../uploads/default.png';


// 📌 Nouvelle photo uploadée ?
if (!empty($_FILES['image_profil']['name']) && $_FILES['image_profil']['error'] === 0) {

    $dossier = '../uploads/';
    if (!is_dir($dossier)) {
        mkdir($dossier, 0755, true);
    }

    $extension = strtolower(pathinfo($_FILES['image_profil']['name'], PATHINFO_EXTENSION));
    $nom_fichier = 'profil_' . $id . '_' . time() . '.' . $extension;
    $chemin_complet = $dossier . $nom_fichier;

    if (move_uploaded_file($_FILES['image_profil']['tmp_name'], $chemin_complet)) {
        $image_profil = '../uploads/' . $nom_fichier;
    }
}


// 🌍 📌 Recalcul de la latitude / longitude si la ville a changé
$latitude = $_SESSION['utilisateur']['latitude'] ?? null;
$longitude = $_SESSION['utilisateur']['longitude'] ?? null;

if (!empty($ville) && $ville !== $_SESSION['utilisateur']['ville']) {

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($ville),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => "PhenomeneDuCiel/1.0",
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $json = json_decode($response, true);
        if (!empty($json[0])) {
            $latitude = $json[0]['lat'];
            $longitude = $json[0]['lon'];
        }
    }
}


// 📌 Mise à jour SQL
try {
    $bdd = getBD();

    $sql = "UPDATE utilisateurs SET 
            nom = ?, 
            prenom = ?, 
            email = ?, 
            ville = ?, 
            latitude = ?, 
            longitude = ?, 
            date_naissance = ?, 
            bio = ?, 
            image_profil = ?
            WHERE id = ?";

    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        $nom,
        $prenom,
        $email,
        $ville,
        $latitude,
        $longitude,
        $date_naissance,
        $bio,
        $image_profil,
        $id
    ]);

    // 📌 Mise à jour session
    $_SESSION['utilisateur'] = array_merge($_SESSION['utilisateur'], [
        "nom"            => $nom,
        "prenom"         => $prenom,
        "email"          => $email,
        "ville"          => $ville,
        "latitude"       => $latitude,
        "longitude"      => $longitude,
        "bio"            => $bio,
        "date_naissance" => $date_naissance,
        "image_profil"   => $image_profil
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Profil mis à jour avec succès !"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false, 
        "message" => "Erreur SQL : " . $e->getMessage()
    ]);
}
?>
