<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../../login_system/login.php");
    exit;
}
require_once "../../securite/csrf.php";
generer_csrf();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouveau sujet</title>
<link rel="stylesheet" href="../../styles/css_principale.css">
</head>
<body>

<?php include "../includes/header.php"; ?>

<h1 class="jaune">Créer un nouveau sujet</h1>

<form action="poster.php" method="POST" enctype="multipart/form-data" class="form-forum">

    <label>Titre :</label>
    <input type="text" name="titre" required>

    <label>Message :</label>
    <textarea name="message" required></textarea>

    <label>Image (optionnel) :</label>
    <input type="file" name="image" accept="image/*">

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <button type="submit" class="btn-gold">Publier</button>
</form>
<div class="quick-post-box">
    <h3>📝 Nouveau sujet</h3>
    <form action="poster.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="Titre du sujet..." required>
        <textarea name="message" placeholder="Votre message..." required></textarea>
        <input type="file" name="image" accept="image/*">

        <button type="submit" class="btn-gold-small">Publier ➜</button>
    </form>
</div>

</body>
</html>
