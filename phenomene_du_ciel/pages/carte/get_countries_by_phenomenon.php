<?php
require_once "../../bd.php";
$pdo = getBD();

header("Content-Type: application/json");

$type = $_GET["type"] ?? null;
if (!$type) {
    echo json_encode(["success" => false, "error" => "Type manquant."]);
    exit;
}

$tableMap = [
    "bolides" => "bolides",
    "meteorites" => "meteorites",
    "solaire" => "eclipses_solaires",
    "lunaire" => "eclipses_lunaires"
];

if (!isset($tableMap[$type])) {
    echo json_encode(["success" => false, "error" => "Type invalide."]);
    exit;
}

$table = $tableMap[$type];

$sql = "
    SELECT DISTINCT l.pays
    FROM $table AS t
    JOIN localisations l ON t.id_localisation = l.id_localisation
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$countries = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $countries[] = $row["pays"]; // pays = code ISO3
}

echo json_encode([
    "success" => true,
    "countries" => $countries
]);
exit;
