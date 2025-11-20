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

$id_message = intval($_POST['id_message'] ?? 0);
$reponse = trim($_POST['reponse'] ?? '');
$id_user = $_SESSION['user']['id'];

if ($id_message <= 0 || $reponse === "") {
    echo json_encode(["success" => false, "message" => "Données invalides"]);
    exit;
}

$req = $bdd->prepare("
    INSERT INTO forum_reponses (id_message, id_utilisateur, reponse)
    VALUES (?, ?, ?)
");
$req->execute([$id_message, $id_user, $reponse]);

echo json_encode(["success" => true, "message" => "Réponse ajoutée !"]);
