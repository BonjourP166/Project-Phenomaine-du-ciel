<?php
require_once "../../bd.php";
$pdo = getBD();

header("Content-Type: application/json");

$sql = "
    SELECT l.pays, COUNT(*) AS total
    FROM (
        SELECT id_localisation FROM bolides
        UNION ALL
        SELECT id_localisation FROM meteorites
        UNION ALL
        SELECT id_localisation FROM eclipses_solaires
        UNION ALL
        SELECT id_localisation FROM eclipses_lunaires
    ) AS all_events
    JOIN localisations l ON all_events.id_localisation = l.id_localisation
    GROUP BY l.pays
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$data = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[$row["pays"]] = intval($row["total"]);
}

echo json_encode([
    "success" => true,
    "intensity" => $data
]);
exit;
