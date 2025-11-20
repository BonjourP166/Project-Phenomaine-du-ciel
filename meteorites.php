<?php

session_start();

include('bd.php');
$bdd = getBD();


$requete = $bdd->prepare("
    SELECT 
        m.*, 
        p.description AS description, 
        d.année AS année,
        l.Coordonnées AS cd
    FROM meteorite m
    LEFT JOIN phenomenes p ON m.id_phénomene = p.id_phénomene
    LEFT JOIN date d ON m.id_date = d.id_date
    LEFT JOIN localisation l ON m.id_localisation = l.id_local
    ORDER BY m.id_meteo ASC
");
$requete->execute();

$meteo = $requete->fetchAll(PDO::FETCH_ASSOC);

$description = $meteo[0]['description'] ?? '';
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Météorites</title>

    </head>

    <body>
        <h1>Détails des météorites :</h1>
        
        <p>
            <?php echo htmlspecialchars($description); ?>
        </p>
    
        <br>

        <table border="1" cellpadding="5">
            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Type de météorite</th>
                <th>Classe de météorite</th>
                <th>Masse</th>
                <th>Chute observée</th>
                <th>Année</th>
                <th>Localisation</th>
            </tr>


             <?php foreach ($meteo as $m): ?>

            <tr>
                <td><?= htmlspecialchars($m['id_meteo']) ?></td>
                <td><?= htmlspecialchars($m['nom']) ?></td>
                <td><?= htmlspecialchars($m['type_meteorite']) ?></td>
                <td><?= htmlspecialchars($m['classe_meteo']) ?></td>
                <td><?= htmlspecialchars($m['masse']) ?></td>
                <td><?= htmlspecialchars($m['chute_observe']) ?></td>
                <td><?= htmlspecialchars($m['année'] ?? '') ?></td>
                <td><?= htmlspecialchars($m['cd'] ?? '') ?></td>
        </tr>

        <?php endforeach; ?>
        
        </table>


    </body>
</html>

