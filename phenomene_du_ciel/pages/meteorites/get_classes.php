<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT classe_meteo, COUNT(*) AS nb
        FROM meteorites
        WHERE classe_meteo IS NOT NULL
        GROUP BY classe_meteo
        ORDER BY nb DESC
    ";

    $rows = $bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "classes" => $rows
    ], JSON_PRETTY_PRINT);

} catch(Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
