<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "SELECT id_eclipse_solaire, path_width_km 
            FROM eclipses_solaires
            ORDER BY id_eclipse_solaire ASC";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];

    foreach ($rows as $r) {
        if ($r['path_width_km'] !== "N/A" && $r['path_width_km'] !== null) {
            $data[] = [
                "id" => intval($r['id_eclipse_solaire']),
                "largeur" => floatval($r['path_width_km'])
            ];
        }
    }

    echo json_encode(["success" => true, "data" => $data]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
