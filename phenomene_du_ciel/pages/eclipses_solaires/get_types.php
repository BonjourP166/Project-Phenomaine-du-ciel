<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT 
            t.type AS label,
            COUNT(*) AS total
        FROM eclipses_solaires es
        LEFT JOIN types_eclipses t 
            ON es.type_eclipse = t.id_eclipse
        GROUP BY t.type
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();

    echo json_encode([
        "success" => true,
        "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)
    ]);

} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
