<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT 
            d.mois,
            d.annee,
            e.quincena_solar_eclipse AS type,
            l.ville,
            l.pays,
            e.total_eclipse_duration_m AS duree_totale
        FROM eclipses_lunaires e
        JOIN dates d 
            ON e.id_date = d.id_date
        JOIN localisations l
            ON e.id_localisation = l.id_localisation
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
