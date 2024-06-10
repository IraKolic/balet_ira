<?php
include('header.php');
include('db_config.php');
include('xml_functions.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $stmt = $pdo->prepare("DELETE FROM termini WHERE id = ?");
        if ($stmt->execute([$deleteId])) {
            deleteTerminFromXML($deleteId);
            echo "Termin obrisan!";
        } else {
            echo "Brisanje termina nije uspjelo.";
        }
    } else {
        $datum = $_POST['date'];
        $vrijeme = $_POST['time'];
        $lokacija = $_POST['location'];
        $trener_id = $_SESSION['user']['id'];
        
        $stmt = $pdo->prepare("INSERT INTO termini (trener_id, datum, vrijeme, lokacija) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$trener_id, $datum, $vrijeme, $lokacija])) {
            $terminId = $pdo->lastInsertId();
            $termin = [
                'id' => $terminId,
                'trener_id' => $trener_id,
                'datum' => $datum,
                'vrijeme' => $vrijeme,
                'lokacija' => $lokacija
            ];
            addTerminToXML($termin);
            echo "Termin dodan!";
        } else {
            echo "Dodavanje termina nije uspjelo.";
        }
    }
}

$stmt = $pdo->prepare("SELECT * FROM termini WHERE trener_id = ?");
$stmt->execute([$_SESSION['user']['id']]);
$termini = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="schedule">
    <h2>Nadolazeći termini</h2>
    <form action="trener.php" method="post">
        <label for="date">Datum:</label>
        <input type="date" id="date" name="date" placeholder="dd/mm/yyyy" required>
        
        <label for="time">Vrijeme:</label>
        <input type="text" id="time" name="time" placeholder="hh:mm" required>
        
        <label for="location">Lokacija:</label>
        <select id="location" name="location" required>
            <option value="Split">Split</option>
            <option value="Zagreb">Zagreb</option>
        </select>
        
        <button type="submit">Dodaj termin</button>
    </form>

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
                <form action="trener.php" method="post" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $termin['id']; ?>">
                    <button type="submit">Obriši</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include('footer.php'); ?>
