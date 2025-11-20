<?php

session_start();

include('bd.php');
$bdd = getBD();

$requete = $bdd->prepare("
    SELECT 
        b.*, 
        p.description AS description, 
        d.année AS année,
        d.mois AS mois, 
        l.Coordonnées AS cd
    FROM bolide b
    LEFT JOIN phenomenes p ON b.id_phenomene = p.id_phénomene
    LEFT JOIN date d ON b.id_date = d.id_date
    LEFT JOIN localisation l ON b.id_localisation = l.id_local
    ORDER BY b.id_bolide ASC
");
$requete->execute();

$bolide = $requete->fetchAll(PDO::FETCH_ASSOC);

$description = $bolide[0]['description'] ?? '';
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Bolides</title>

    </head>

    <body>
        <h1>Détails des bolides :</h1>
        
          <p>
            <?php echo htmlspecialchars($description); ?>
        </p>
    
        <br>
    

        <table border="1" cellpadding="5">
            <tr>
                <th>Identifiant</th>
                <th>Vitesse (kms)</th>
                <th>Énergie totale rayonnée (J)</th>
                <th>Année</th>
                <th>Mois</th>
                <th>Localisation</th>
            </tr>


             <?php foreach ($bolide as $b): ?>

            <tr>
                <td><?= htmlspecialchars($b['id_bolide']) ?></td>
                <td><?= htmlspecialchars($b['Vitesse_kms']) ?></td>
                <td><?= htmlspecialchars($b['énergie_totale_rayonnée_J']) ?></td>
                <td><?= htmlspecialchars($b['année'] ?? '') ?></td>
                <td><?= htmlspecialchars($b['mois'] ?? '') ?></td>
                <td><?= htmlspecialchars($b['cd'] ?? '') ?></td>

        </tr>

        <?php endforeach; ?>
        
        </table>


    </body>
</html>

 