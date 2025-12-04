<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT energie_totale_rayonnee_j
        FROM bolides
        WHERE energie_totale_rayonnee_j IS NOT NULL
        ORDER BY energie_totale_rayonnee_j ASC
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();

    $raw = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $energies = [];

    foreach ($raw as $val) {
        if (is_numeric($val)) {
            $energies[] = floatval($val);
        }
    }

    echo json_encode(["success" => true, "data" => $energies]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
