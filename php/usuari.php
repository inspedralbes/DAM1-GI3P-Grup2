<?php include 'header.php'; ?>
<!--Àrea d'Usuari-->
    <h1>Àrea d'Usuari</h1>
    <p>Selecciona què vols fer:</p>
    <header>
<!--Opcions de l'usuari-->     
    <div class="opcions">
        <a href="registrar_incidencia.php" class="opcio">
            <i class="fas fa-plus-circle"></i><br>
            Registrar incidència
        </a>
        <a href="consultar_estat.php" class="opcio">
            <i class="fas fa-search"></i><br>
            Consultar estat
        </a>
        <a href="incidencies_finalitzades.php" class="opcio">
            <i class="fas fa-check-circle"></i><br>
            Incidències finalitzades
        </a>
        <a href="incidencies_totes.php" class="opcio">
            <i class="fas fa-list"></i><br>
            Totes les incidències
        </a>
    </div>

<?php include 'footer.php'; ?>