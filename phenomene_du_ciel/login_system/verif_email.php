<?php
require_once '../bd.php';

header('Content-Type: application/json');

$email = trim($_POST['email'] ?? '');

$bdd = getBD();
$stmt = $bdd->prepare("SELECT id FROM utilisateurs WHERE email = ?");
$stmt->execute([$email]);

echo json_encode([
    "exists" => $stmt->rowCount() > 0
]);
