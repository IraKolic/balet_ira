<?php
include('header.php');
include('db_config.php');
include('xml_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Lozinka treba biti hashovana
    
    $stmt = $pdo->prepare("INSERT INTO users (ime, prezime, email, password, role) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$ime, $prezime, $email, $password, $role])) {
        $userId = $pdo->lastInsertId();
        $user = [
            'id' => $userId,
            'ime' => $ime,
            'prezime' => $prezime,
            'email' => $email,
            'role' => $role
        ];
        addUserToXML($user);
        echo "Registracija uspješna!";
    } else {
        echo "Registracija nije uspjela.";
    }
}
?>
<div class="about-us">
    <h1>Registracija</h1>
</div>
<form action="register.php" method="post">
    <label for="ime">Ime:</label>
    <input type="text" id="ime" name="ime" required>
    
    <label for="prezime">Prezime:</label>
    <input type="text" id="prezime" name="prezime" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="role">Uloga:</label>
    <select id="role" name="role">
        <option value="plesac">Plesač</option>
        <option value="trener">Trener</option>
    </select>
    
    <label for="password">Lozinka:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Registracija</button>
</form>

<?php include('footer.php'); ?>
