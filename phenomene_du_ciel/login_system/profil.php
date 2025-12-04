<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../securite/csrf.php';
require_once "../securite/session_secure.php";

if (!isset($_SESSION['utilisateur'])) {
    header("Location: formulaire_connextion.php");
    exit;
}

$user = $_SESSION['utilisateur'];
$csrf_token = $_SESSION['csrf_token'];

// Détermination de l'image à afficher
$img = $user['image_profil'] ?? null;
if (empty($img) || $img === '../uploads/' || !file_exists($img)) {
    $img = '../uploads/default.png';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mon Profil</title>

<link rel="stylesheet" href="../styles/css_principale.css">
<link rel="stylesheet" href="../styles/css_banieres.css">
<link rel="stylesheet" href="../styles/css.profil.css">

<style>
.edit-btn {
    margin-top: 10px;
    padding: 8px 16px;
    border-radius: 10px;
    border: 2px solid rgba(255,185,80,0.4);
    background: rgba(255,255,255,0.05);
    color: #ffd88a;
    cursor: pointer;
    transition: 0.25s;
    font-size: 0.95em;
}
.edit-btn:hover {
    background: rgba(255,185,80,0.25);
    color: white;
    box-shadow: 0 0 12px rgba(255,185,80,0.45);
}
#edit-mode { display: none; }
</style>

</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="profile-container">
<div class="profile-block">

<h1 class="profile-title">Mon Profil</h1>

<!-- ========================= -->
<!-- MODE LECTURE -->
<!-- ========================= -->
<div id="view-mode" class="profile-info">

    <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom'] ?? '') ?></p>
    <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom'] ?? '') ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>
    <p><strong>Localisation :</strong> <?= htmlspecialchars($user['ville'] ?? '') ?></p>
    <p><strong>Date de naissance :</strong> <?= htmlspecialchars($user['date_naissance'] ?? '') ?></p>

    <p class="bio-line">
    <strong>BIO :</strong>
    <?= nl2br(htmlspecialchars($user['bio'] ?? '')) ?>
</p>

    <button class="edit-btn" id="btnEdit">✏️ Modifier</button>
</div>

<!-- ========================= -->
<!-- MODE ÉDITION -->
<!-- ========================= -->
<form id="edit-mode" class="profile-info" enctype="multipart/form-data">

    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

    <label>Nom :</label>
    <input type="text" name="nom" class="input-premium" value="<?= htmlspecialchars($user['nom'] ?? '') ?>">

    <label>Prénom :</label>
    <input type="text" name="prenom" class="input-premium" value="<?= htmlspecialchars($user['prenom'] ?? '') ?>">

    <label>Email :</label>
    <input type="email" name="email" class="input-premium" value="<?= htmlspecialchars($user['email'] ?? '') ?>">

    <label>Localisation :</label>
    <input type="text" name="ville" class="input-premium" value="<?= htmlspecialchars($user['ville'] ?? '') ?>">

    <label>Date de naissance :</label>
    <input type="date" name="date_naissance" class="input-premium" value="<?= htmlspecialchars($user['date_naissance'] ?? '') ?>">

    <div class="bio-edit-line">
    <label>Bio :</label>
    <textarea name="bio" class="textarea-premium auto-textarea" rows="1"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
</div>
    <!-- ⭐ INPUT PHOTO DANS LE FORMULAIRE (obligatoire) -->
    <div class="upload-zone">
    <button type="button" class="upload-btn" id="btnUpload">📸 Changer la photo</button>
    <input type="file" id="image_profil" name="image_profil" accept="image/*" hidden>
</div>

    <p id="msg_modif"></p>

    <button type="submit" class="save-btn">💾 Enregistrer</button>
    <button type="button" class="edit-btn" id="btnCancel">Annuler</button>
</form>

<!-- ========================= -->
<!-- COLONNE DROITE -->
<!-- ========================= -->
<div class="profile-photo-box">

    <div class="profile-photo-frame">
        <img id="img_preview" src="<?= $img ?>" alt="Photo de profil">
    </div>

    <p class="profile-username">
        <?= htmlspecialchars($user['prenom'] ?? '') . " " . htmlspecialchars($user['nom'] ?? '') ?>
    </p>

    <p class="profile-date">
        Date d'inscription : <?= htmlspecialchars($user['date_inscription'] ?? '—') ?>
    </p>

    <a href="../index.php" class="back-link">← Retour</a>
    <a href="logout.php" class="logout-btn">Se déconnecter</a>
</div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
// Basculer lecture → édition
$("#btnEdit").click(function() {
    $("#view-mode").hide();
    $("#edit-mode").show();
});

// Annuler édition
$("#btnCancel").click(function() {
    $("#edit-mode").hide();
    $("#view-mode").show();
});

// Preview de l'image
$("#image_profil").on("change", function() {
    let file = this.files[0];
    if (file) {
        $("#img_preview").attr("src", URL.createObjectURL(file));
    }
});

// Envoi Ajax
$("#edit-mode").on("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "profil_modif_traitement.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(res){
            if(!res.success){
                $("#msg_modif").css("color","red").html(res.message);
            } else {
                $("#msg_modif").css("color","lime").html(res.message);

                // reload propre après succès
                setTimeout(() => location.reload(), 800);
            }
        },
        error: function(){
            $("#msg_modif").css("color","red").html("Erreur serveur.");
        }
    });
});

// Auto-redimension du textarea BIO
$(".auto-textarea").each(function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
}).on("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});

// Ouvrir la fenêtre de fichier quand on clique sur le bouton
$("#btnUpload").click(function() {
    $("#image_profil").click();
});

// Preview de l'image quand on la sélectionne
$("#image_profil").on("change", function() {
    let file = this.files[0];
    if (file) {
        $("#img_preview").attr("src", URL.createObjectURL(file));
    }
});
</script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
