<?php
header('Content-Type: application/json');
require_once '../includes/bd.php';

try {
    $bdd = getBD();

    $sql = "
        SELECT 
            classe_meteo,
            masse
        FROM meteorites
        WHERE masse IS NOT NULL
          AND classe_meteo IS NOT NULL
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "meteorites" => $rows   // 🔥 OBLIGATOIRE : masses.js lit "meteorites"
    ], JSON_PRETTY_PRINT);

} catch(Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
