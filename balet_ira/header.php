<?php
session_start();
include('db_config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Plesni Studio Balet</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Početna</a>
            <a href="onama.php">O nama</a>
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] == 'trener'): ?>
                    <a href="trener.php">Termini</a>
                <?php elseif ($_SESSION['user']['role'] == 'plesač'): ?>
                    <a href="plesac.php">Termini</a>
                <?php endif; ?>
                <a href="logout.php">Odjava</a>
            <?php else: ?>
                <a href="login.php">Prijava</a>
                <a href="register.php">Registracija</a>
            <?php endif; ?>
        </nav>
    </header>
