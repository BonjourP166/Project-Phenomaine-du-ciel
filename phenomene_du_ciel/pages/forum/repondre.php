<?php
session_start();
require_once "../../bd.php";
require_once "../../securite/csrf.php";

header('Content-Type: application/json');

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(["success" => false, "message" => "Vous devez être connecté."]);
    exit;
}

verif_csrf_token($_POST['csrf_token']);

if (empty($_POST['message']) || empty($_POST['id_parent'])) {
    echo json_encode(["success" => false, "message" => "Message vide"]);
    exit;
}

$message = trim($_POST['message']);
$id_user = $_SESSION['utilisateur']['id'];
$parent_id = intval($_POST['id_parent']);

$bdd = getBD();
$sql = "INSERT INTO forum_messages (id_utilisateur, parent_id, message, date_publication)
        VALUES (?, ?, ?, NOW())";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id_user, $parent_id, $message]);


echo json_encode(["success" => true, "message" => "Réponse envoyée !"]);
exit;
