<?php
$host = 'localhost';
$db = 'balet';
$user = 'root';  // Postavi na svoje MySQL korisničko ime
$pass = '';      // Postavi na svoju MySQL lozinku

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Neuspjela konekcija: " . $e->getMessage());
}
?>
