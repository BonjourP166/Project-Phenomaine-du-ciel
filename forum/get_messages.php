<?php
header('Content-Type: application/json');

include '../includes/bd.php';
$bdd = getBD();

$req = $bdd->query("
    SELECT forum_messages.id, message, image, date_publication,
           utilisateurs.nom, utilisateurs.prenom
    FROM forum_messages
    JOIN utilisateurs ON utilisateurs.id = forum_messages.id_utilisateur
    ORDER BY date_publication DESC
");

$messages = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "success" => true,
    "messages" => $messages
]);
