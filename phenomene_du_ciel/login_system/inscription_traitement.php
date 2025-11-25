<?php
// === DEBUG (à désactiver en production) ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === INCLUSIONS ===
require_once '../securite/session_secure.php';
require_once '../bd.php';
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
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $ville = htmlspecialchars(trim($_POST['ville']));
    $bio = !empty($_POST['bio']) ? htmlspecialchars(trim($_POST['bio'])) : null;
    $date_naissance = !empty($_POST['date_naissance']) ? $_POST['date_naissance'] : null;

    // === 2️⃣ Gestion de l’image de profil ===
    $image_profil = '../uploads/default.png'; // Valeur par défaut

    if (isset($_FILES['image_profil']) && $_FILES['image_profil']['error'] === 0) {
        $dossier = '../uploads/';
        if (!is_dir($dossier)) {
            mkdir($dossier, 0755, true);
        }

        $extension = pathinfo($_FILES['image_profil']['name'], PATHINFO_EXTENSION);
        $nom_fichier = time() . '_' . uniqid() . '.' . $extension;
        $chemin_complet = $dossier . $nom_fichier;

        if (move_uploaded_file($_FILES['image_profil']['tmp_name'], $chemin_complet)) {
            $image_profil = '../uploads/' . $nom_fichier;
        }
    }

   // === 3️⃣ Conversion ville → coordonnées GPS (API OpenStreetMap fiable et future-proof) ===

// 🧠 Création d'une requête HTTP sécurisée et compatible
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($ville),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => "PhenomeneDuCiel/1.0 (contact@tonsite.com)",
    CURLOPT_TIMEOUT => 10,
    CURLOPT_SSL_VERIFYPEER => false,  // 🚨 désactive la vérification SSL
    CURLOPT_SSL_VERIFYHOST => false   // 🚨 idem
]);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
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
    echo "<pre>⚠️ Erreur cURL : $curl_error</pre>";
    $latitude = null;
    $longitude = null;
}




    // === 4️⃣ Insertion en base ===
    try {
        $bdd = getBD();
        $sql = "INSERT INTO utilisateurs 
                (prenom, nom, email, mot_de_passe, ville, latitude, longitude, date_naissance, bio, image_profil, role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'utilisateur')";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            $prenom, $nom, $email, $mot_de_passe,
            $ville, $latitude, $longitude,
            $date_naissance, $bio, $image_profil
        ]);

        echo "<div style='text-align:center; padding:20px; background:#d4f6e2; border-radius:10px;'>
                ✅ Inscription réussie ! Bienvenue, $prenom 🌍<br>
                <a href='connexion.php'>Se connecter maintenant</a>
              </div>";

    } catch (PDOException $e) {
        echo "<div style='padding:20px; background:#ffd6d6; border-radius:10px;'>
                ❌ Erreur lors de l'inscription : " . htmlspecialchars($e->getMessage()) . "
              </div>";
    }
} else {
    echo "Aucune donnée reçue 💤";
}
?>
