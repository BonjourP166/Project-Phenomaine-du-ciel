<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT 
            e.total_eclipse_duration_m AS duree,
            e.type_eclipse AS type_code
        FROM eclipses_lunaires e
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Conversion code -> label
    $types = [
        1 => "Pénombrale",
        2 => "Partielle",
        3 => "Totale"
    ];

    $data = [];
    foreach ($rows as $r) {
        $data[] = [
            "type" => $types[$r["type_code"]] ?? "Autre",
            "duree" => floatval($r["duree"])
        ];
    }

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
