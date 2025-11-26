<?php
header('Content-Type: application/json');
require_once '../includes/bd.php';

try {
    $bdd = getBD();

    $sql = "
        SELECT
            m.nom,
            m.masse,
            m.classe_meteo,
            d.`annee` AS annee,
            l.latitude,
            l.longitude
        FROM meteorites m
        JOIN dates d ON m.id_date = d.id_date
        JOIN localisations l ON m.id_localisation = l.id_localisation
        WHERE m.masse IS NOT NULL
        ORDER BY m.masse DESC
        LIMIT 10
    ";

    $data = $bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "top10" => $data], JSON_PRETTY_PRINT);

} catch(Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
