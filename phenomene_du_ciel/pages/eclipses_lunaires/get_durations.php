<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT 
            AVG(penumbral_eclipse_duration_m) AS penombre,
            AVG(partial_eclipse_duration_m) AS partielle,
            AVG(total_eclipse_duration_m) AS totale
        FROM eclipses_lunaires
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $data
    ]);

} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
