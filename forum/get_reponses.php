<?php
header('Content-Type: application/json');

include '../includes/bd.php';
$bdd = getBD();

if (!isset($_GET['id_message'])) {
    echo json_encode(["success" => false, "message" => "ID message manquant"]);
    exit;
}

$id_message = intval($_GET['id_message']);

$req = $bdd->prepare("
    SELECT forum_reponses.id, forum_reponses.reponse, forum_reponses.date_publication,
           utilisateurs.nom, utilisateurs.prenom
    FROM forum_reponses
    JOIN utilisateurs ON utilisateurs.id = forum_reponses.id_utilisateur
    WHERE id_message = ?
    ORDER BY date_publication ASC
");
$req->execute([$id_message]);

$reponses = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "success" => true,
    "reponses" => $reponses
]);
