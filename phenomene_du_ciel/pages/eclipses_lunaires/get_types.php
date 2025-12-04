<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT quincena_solar_eclipse
        FROM eclipses_lunaires
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $types = [];

    foreach ($rows as $r) {
        $type = trim($r["quincena_solar_eclipse"]);

        if (!isset($types[$type])) {
            $types[$type] = 0;
        }

        $types[$type]++;
    }

    echo json_encode(["success" => true, "data" => $types]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
