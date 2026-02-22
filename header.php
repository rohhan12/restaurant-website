<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urban Spice Restaurant</title>
    <link rel="stylesheet" href="css/project.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <a href="index.php">
                   <img src="images/logo-urbanspice.jpg" alt="Urban Spice Logo" style="max-width: 120px; height: auto;">
                </a>
                
                <button class="mobile-toggle" id="mobileToggle" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php" >Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="reservations.php">Reservations</a></li>
                </ul>
            </div>
        </nav>
    </header>
