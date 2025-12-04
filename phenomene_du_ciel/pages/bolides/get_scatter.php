<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT id_bolide, vitesse_kms, energie_totale_rayonnee_j
        FROM bolides
        ORDER BY id_bolide ASC
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();

    $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];

    foreach ($raw as $row) {
        if ($row['vitesse_kms'] !== "N/A" 
            && $row['vitesse_kms'] !== null 
            && $row['energie_totale_rayonnee_j'] !== null
        ) {
            $data[] = [
                "id"      => intval($row['id_bolide']),
                "vitesse" => floatval($row['vitesse_kms']),
                "energie" => floatval($row['energie_totale_rayonnee_j'])
            ];
        }
    }

    echo json_encode(["success" => true, "data" => $data]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
