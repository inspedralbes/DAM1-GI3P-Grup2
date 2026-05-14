<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<h1>Actuacions de la incidència</h1>

<div style="max-width: 900px; margin: 2rem auto; background: white; padding: 2rem; color: black;">
    <?php
    $id = $_GET['incidencia_id'];
//Comanda per demanar dades a la BD
    $inc = $conn->query("SELECT i.id_inc, i.descripcio, d.nom AS departament 
    FROM incidencies i 
    LEFT JOIN departaments d ON i.departament_id = d.id_dept 
    WHERE i.id_inc='$id'")->fetch_assoc();
    ?>

    <p><strong>ID Incidència:</strong> <?php echo $inc['id_inc']; ?></p>
    <p><strong>Departament:</strong> <?php echo $inc['departament']; ?></p>
    <p><strong>Descripció:</strong> <?php echo $inc['descripcio']; ?></p>
<!--Comanda per mostrar les actuacions de la BD-->
    <h3>Actuacions realitzades</h3>

    <?php
    $actuacions = $conn->query("SELECT * FROM actuacions WHERE incidencia_id='$id' AND visible_usuari = 1 ORDER BY data_actuacio ASC");
    //Missatge que mostre si no hi ha cap actuació
    if ($actuacions->num_rows == 0) {
        echo "<p>No hi ha actuacions registrades per aquesta incidència.</p>";
    } else {
    ?><!--Taula per mostrar les actuacions de la BD-->
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <tr style="background: #f0f0f0;">
                <th>Data</th>
                <th>Descripció</th>
                <th>Temps (minuts)</th>
            </tr>
            <?php while ($act = $actuacions->fetch_assoc()): ?>
            <tr>
                <td><?php echo $act['data_actuacio']; ?></td>
                <td><?php echo $act['descripcio']; ?></td>
                <td><?php echo $act['temps_minuts']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php } ?>

    <br>
    <a href="incidencies_finalitzades.php">Tornar</a>
</div>

<?php include 'footer.php'; ?>