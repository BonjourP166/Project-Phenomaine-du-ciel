<?php
header('Content-Type: application/json');
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT 
            m.nom,
            m.masse,
            m.classe_meteo,
            m.type_meteorite,
            l.pays,
            d.`annee` AS annee
        FROM meteorites m
        JOIN localisations l ON m.id_localisation = l.id_localisation
        JOIN dates d ON m.id_date = d.id_date
        ORDER BY d.`annee` DESC
        LIMIT 10
    ";

    $data = $bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "data" => $data], JSON_PRETTY_PRINT);

} catch(Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
