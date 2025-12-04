<?php
header('Content-Type: application/json');
require_once "../../bd.php";

function convertToSeconds($duration) {
    if ($duration === "N/A" || $duration === null) return null;

    // Format du type 06m37s
    if (preg_match('/(\d+)m(\d+)s/', $duration, $matches)) {
        return intval($matches[1]) * 60 + intval($matches[2]);
    }

    return null;
}

try {
    $bdd = getBD();

    $sql = "SELECT id_eclipse_solaire, eclipse_magnitude, central_duration 
            FROM eclipses_solaires
            ORDER BY id_eclipse_solaire ASC";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];

    foreach ($rows as $r) {

        $mag = $r['eclipse_magnitude'];
        $duration = convertToSeconds($r['central_duration']);

        if ($mag !== null && $mag !== "N/A" && $duration !== null) {
            $data[] = [
                "id" => intval($r['id_eclipse_solaire']),
                "magnitude" => floatval($mag),
                "duration" => $duration
            ];
        }
    }

    echo json_encode(["success" => true, "data" => $data]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
