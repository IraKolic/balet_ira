<?php
include('header.php');
include('db_config.php');


$stmt = $pdo->prepare("SELECT * FROM termini");
$stmt->execute();
$termini = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="schedule">
    <h2>Nadolazeći termini</h2>
    <ul>
        <?php foreach ($termini as $termin): ?>
            <li>
                <div class="details">
                    <span>Datum:</span> <?php echo $termin['datum']; ?>
                    <span>Vrijeme:</span> <?php echo $termin['vrijeme']; ?>
                </div>
                <div class="time-location">
                    <span>Lokacija:</span> <?php echo $termin['lokacija']; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include('footer.php'); ?>
