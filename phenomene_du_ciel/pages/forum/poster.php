<?php
session_start();
require_once "../../bd.php";
require_once "../../securite/csrf.php";

if (!isset($_SESSION['utilisateur'])) exit("⛔");

verif_csrf_token($_POST['csrf_token']);

$titre = trim($_POST['titre']);
$message = trim($_POST['message']);
$id_user = $_SESSION['utilisateur']['id'];
$imagePath = NULL;

// Upload image
if (!empty($_FILES['image']['name'])) {
    $uploadDir = "images/";
    $fileName = time() . "_" . basename($_FILES['image']['name']);

    // Nettoyage du nom
    $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);

    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $imagePath = "forum/images/" . $fileName;
    }
}

$bdd = getBD();
$sql = "INSERT INTO forum_messages (id_utilisateur, theme, message, image, parent_id, date_publication)
        VALUES (?, ?, ?, ?, NULL, NOW())";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id_user, $titre, $message, $imagePath]);

header("Location: forum.php");
exit;
