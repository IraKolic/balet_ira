<?php
include('header.php');
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user'] = $user;
        if ($user['role'] == 'trener') {
            header("Location: trener.php");
        } else {
            header("Location: plesac.php");
        }
        exit();
    } else {
        echo "Neispravni podaci za prijavu.";
    }
}
?>
<div class="about-us">
    <h1>Prijava</h1>
</div>
<form action="login.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Lozinka:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Prijava</button>
    <a href="register.php">Nemaš račun? Registriraj se!</a>
</form>

<?php include('footer.php'); ?>
