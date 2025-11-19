<?php
// Connexion à la base
include '../includes/bd.php';  // adapte si ton bd.php est ailleurs

$bdd = getBD();

// Récupère tous les lieux
$stmt = $bdd->query("SELECT * FROM lieux_observation");
$lieux = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Renvoie les données en JSON
header('Content-Type: application/json');
echo json_encode($lieux);
