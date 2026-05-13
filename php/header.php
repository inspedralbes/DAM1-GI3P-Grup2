<?php
require_once 'logger.php';
require_once __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>GI3P - Gestió d'Incidències</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header class="topbar">
        <div class="brand">
            <div class="logo">
               <a href="index.php" class="logo-item">
  <img src="images/IP.jpg" alt="Logo IP">
</a>
            </div>
            <div class="brand-text">
                <span class="code">GI3P</span>
                <span>Projecte final</span>
                <span>Gestor d'incidències</span>
            </div>
        </div>
        <nav class="nav">
            <a href="index.php" class="nav-item">
                <img src="images/inici.png" alt="">
                <span>INICI</span>
            </a>
            <a href="sobre.php" class="nav-item">
                <img src="images/about_us.png" alt="">
                <span>SOBRE</span>
            </a>
            <a href="ajuda.php" class="nav-item">
                <img src="images/ajuda.png" alt="">
                <span>AJUDA</span>
            </a>
        </nav>
    </header>