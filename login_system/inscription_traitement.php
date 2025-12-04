<?php
// === DEBUG (à désactiver en production) ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === INCLUSIONS ===
require_once '../securite/session_secure.php';
require_once "../bd.php";
require_once '../securite/csrf.php';

// === TRAITEMENT DU FORMULAIRE ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérifie que le token CSRF est présent
    if (!isset($_POST['csrf_token'])) {
        die("⚠️ Erreur : token CSRF manquant !");
    }

    // Vérifie le token
    verif_csrf_token($_POST['csrf_token']);

    // === 1️⃣ Nettoyage des données ===
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $ville = htmlspecialchars(trim($_POST['ville']));
    $mot_de_passe_brut = $_POST['mot_de_passe'];

    $mot_de_passe = password_hash($mot_de_passe_brut, PASSWORD_BCRYPT);

    $bio = !empty($_POST['bio']) ? htmlspecialchars(trim($_POST['bio'])) : null;
    $date_naissance = !empty($_POST['date_naissance']) ? $_POST['date_naissance'] : null;

    // === 2️⃣ Gestion de l’image de profil ===
    $image_profil = '../uploads/default.png'; // Valeur par défaut

    if (isset($_FILES['image_profil']) && $_FILES['image_profil']['error'] === 0) {

        $dossier = '../uploads/';
        if (!is_dir($dossier)) mkdir($dossier, 0755, true);

        $extension = pathinfo($_FILES['image_profil']['name'], PATHINFO_EXTENSION);
        $nom_fichier = time() . '_' . uniqid() . '.' . $extension;
        $chemin_complet = $dossier . $nom_fichier;

        if (move_uploaded_file($_FILES['image_profil']['tmp_name'], $chemin_complet)) {
            $image_profil = '../uploads/' . $nom_fichier;
        }
    }

    // === 3️⃣ Conversion ville → coordonnées GPS ===
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($ville),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => "PhenomeneDuCiel/1.0 (contact@tonsite.com)",
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ]);

    $response = curl_exec($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($response) {
        $json = json_decode($response, true);
        if (!empty($json[0])) {
            $latitude = $json[0]['lat'];
            $longitude = $json[0]['lon'];
        } else {
            $latitude = null;
            $longitude = null;
        }
    } else {
        $latitude = null;
        $longitude = null;
    }

    // === 4️⃣ Vérification des erreurs ===
    $erreurs = [];

    if (empty($prenom)) $erreurs['prenom'] = "Le prénom est obligatoire.";
    if (empty($nom)) $erreurs['nom'] = "Le nom est obligatoire.";
    if (empty($email)) $erreurs['email'] = "L’email est obligatoire.";
    if (empty($mot_de_passe_brut)) $erreurs['mot_de_passe'] = "Le mot de passe est obligatoire.";
    if (strlen($mot_de_passe_brut) < 6) $erreurs['mot_de_passe'] = "Minimum 6 caractères.";

    // Email unique
    $bdd = getBD();
    $check = $bdd->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $erreurs['email'] = "Cet email est déjà utilisé.";
    }

    // Retour JSON si erreurs
    if (!empty($erreurs)) {
        echo json_encode(["status" => "error", "errors" => $erreurs]);
        exit;
    }

    // === 5️⃣ Insertion en base ===
    try {

        $sql = "INSERT INTO utilisateurs 
                (prenom, nom, email, mot_de_passe, ville, latitude, longitude, date_naissance, bio, image_profil, role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'utilisateur')";

        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            $prenom, $nom, $email, $mot_de_passe,
            $ville, $latitude, $longitude,
            $date_naissance, $bio, $image_profil
        ]);

        // === 6️⃣ Connexion automatique après inscription ===
        $nouvel_id = $bdd->lastInsertId();

        $stmt2 = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt2->execute([$nouvel_id]);
        $user = $stmt2->fetch(PDO::FETCH_ASSOC);

        $_SESSION['utilisateur'] = [
            "id"             => $user['id'],
            "prenom"         => $user['prenom'],
            "nom"            => $user['nom'],
            "email"          => $user['email'],
            "ville"          => $user['ville'],
            "latitude"       => $user['latitude'],
            "longitude"      => $user['longitude'],
            "image_profil"   => $user['image_profil'],
            "bio"            => $user['bio'],
            "date_naissance" => $user['date_naissance'],
            "date_inscription" => $user['date_inscription'],
            "role"           => $user['role']
        ];

        // === 7️⃣ Réponse JSON succès ===
        echo json_encode([
            'status'  => 'success',
            'prenom'  => $user['prenom'],
            'nom'     => $user['nom'],
            'message' => "Inscription réussie ! Bienvenue, {$user['prenom']} {$user['nom']} 🌍"
        ]);
        exit;

    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Erreur SQL : " . $e->getMessage()
        ]);
        exit;
    }
} else {
    echo "Aucune donnée reçue 💤";
}

?>
