<?php
header("Content-Type: application/json");
require_once "../../bd.php";

try {
    $bdd = getBD();

    $sql = "
        SELECT 
            b.id_bolide,
            b.vitesse_kms,
            b.energie_totale_rayonnee_j,
            l.ville,
            l.pays,
            d.annee,
            d.mois
        FROM `bolides` b
        JOIN `localisations` l ON b.id_localisation = l.id_localisation
        JOIN `dates` d ON b.id_date = d.id_date
        WHERE b.id_phenomene = 2
        ORDER BY d.annee DESC, d.mois DESC
        LIMIT 10
    ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 🗓️ Reconstruction de la date (année + mois)
    foreach ($rows as &$r) {
        $r["date"] = sprintf("%04d-%02d", $r["annee"], $r["mois"]);
    }

    echo json_encode([
        "success" => true,
        "bolides" => $rows
    ]);

} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
