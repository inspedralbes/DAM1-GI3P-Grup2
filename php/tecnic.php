<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>GI3P - Tècnic</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <h1>Àrea de Tècnic</h1>
    <p>Gestiona les incidències assignades:</p>

    <div class="opcions">

        <a href="registrar_incidencia.php" class="opcio">
            <i class="fas fa-plus-circle"></i>
            Registra una incidencia
        </a>       
    
        <a href="identificacio.php" class="opcio">
            <i class="fas fa-tools"></i>
            Incidències assignades
        </a>

        <a href="identificacio.php" class="opcio">
            <i class="fas fa-sync-alt"></i>
            Actualitzar estat
        </a>

        <a href="identificacio.php" class="opcio">
            <i class="fas fa-clipboard-list"></i>
            Historial de treballs
        </a>
    </div>
</body>
</html>