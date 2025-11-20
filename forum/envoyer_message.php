<?php
header('Content-Type: application/json');

session_start();

include '../includes/bd.php';
$bdd = getBD();

if (!isset($_SESSION['user'])) {
    echo json_encode(["success" => false, "message" => "Vous devez être connecté."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Méthode non autorisée"]);
    exit;
}

$id_user = $_SESSION['user']['id'];
$message = trim($_POST['message'] ?? '');
$image = trim($_POST['image'] ?? null);

if ($message === "") {
    echo json_encode(["success" => false, "message" => "Message vide"]);
    exit;
}

$req = $bdd->prepare("
    INSERT INTO forum_messages (id_utilisateur, message, image)
    VALUES (?, ?, ?)
");
$req->execute([$id_user, $message, $image]);

echo json_encode(["success" => true, "message" => "Message ajouté !"]);
