<?php
// === get_sample_solaire.php ===
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT 
            d.annee,
            d.mois,
            l.pays,
            l.ville,
            e.central_duration,
            e.path_width_km
        FROM eclipses_solaires e
        JOIN localisations l
            ON e.id_localisation = l.id_localisation
        JOIN dates d
            ON e.id_date = d.id_date
        ORDER BY d.annee DESC, d.mois DESC
        LIMIT 10
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
