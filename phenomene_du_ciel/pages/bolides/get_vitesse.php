<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "SELECT vitesse_kms FROM bolides ORDER BY id_bolide ASC";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();

    $raw = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $speeds = [];
    foreach ($raw as $v) {
        if ($v !== null && $v !== "N/A" && is_numeric($v)) {
            $speeds[] = floatval($v);
        }
    }

    echo json_encode(["success" => true, "data" => $speeds]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
