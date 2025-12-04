<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('bd.php');
$bdd = getBD();

$requete = $bdd->prepare("
     SELECT 
        d.annee,
        GROUP_CONCAT(DISTINCT CONCAT(m.nom, ',', m.masse) SEPARATOR ' | ') AS meteo,
        GROUP_CONCAT(DISTINCT CONCAT(b.vitesse_kms, ',', b.energie_totale_rayonnee_j) SEPARATOR ' | ') AS bolide,
        GROUP_CONCAT(DISTINCT CONCAT(IFNULL(te.type,'Unknown'), ',', s.central_duration) SEPARATOR ' | ') AS se,
        GROUP_CONCAT(DISTINCT CONCAT(IFNULL(tel.type,'Unknown'), ',', l.total_eclipse_duration_m) SEPARATOR ' | ') AS le
    FROM dates d

    LEFT JOIN meteorites m ON m.id_date = d.id_date
    LEFT JOIN bolides b ON b.id_date = d.id_date

    LEFT JOIN eclipses_solaires s ON s.id_date = d.id_date
    LEFT JOIN types_eclipses te ON te.id_eclipse = s.type_eclipse

    LEFT JOIN eclipses_lunaires l ON l.id_date = d.id_date
    LEFT JOIN types_eclipses tel ON tel.id_eclipse = l.type_eclipse
    
    GROUP BY d.annee
    ORDER BY d.annee ASC

");

$requete->execute();
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="timeline-horizontal">
<?php foreach($donnees as $row): ?>
    <?php
        $events = [];
        if(!empty($row['meteo']))  $events[] = ['type'=>'meteorite','info'=>$row['meteo']];
        if(!empty($row['bolide'])) $events[] = ['type'=>'bolide','info'=>$row['bolide']];
        if(!empty($row['se']))     $events[] = ['type'=>'solaire','info'=>$row['se']];
        if(!empty($row['le']))     $events[] = ['type'=>'lunaire','info'=>$row['le']];
    ?>
    <div class="timeline-date">
        <div class="date-label"><?= htmlspecialchars($row['annee']) ?></div>
        <div class="events-bar">
            <?php foreach($events as $ev): ?>
                <div class="event-block <?= $ev['type'] ?>"
                     data-year="<?= htmlspecialchars($row['annee']) ?>"
                     data-type="<?= htmlspecialchars($ev['type']) ?>"
                     data-info="<?= htmlspecialchars($ev['info']) ?>">
                     <?= htmlspecialchars($ev['type']) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
</div>
