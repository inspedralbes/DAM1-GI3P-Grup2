<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 1000px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem;">
    <h1 style="color: black;">Actuacions de la incidència</h1>
    
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>

    <?php
    $id = $_GET['incidencia_id'];
    // Comanda per demanar dades a la BD
    $inc = $conn->query("SELECT i.id_inc, i.descripcio, d.nom AS departament 
    FROM incidencies i 
    LEFT JOIN departaments d ON i.departament_id = d.id_dept 
    WHERE i.id_inc='$id'")->fetch_assoc();
    ?>

    <p style="color: black;"><strong>ID Incidència:</strong> <?php echo $inc['id_inc']; ?></p>
    <p style="color: black;"><strong>Departament:</strong> <?php echo $inc['departament']; ?></p>
    <p style="color: black;"><strong>Descripció:</strong> <?php echo $inc['descripcio']; ?></p>

    <h3 style="color: black;">Actuacions realitzades</h3>

    <?php
    $actuacions = $conn->query("SELECT * FROM actuacions WHERE incidencia_id='$id' AND visible_usuari = 1 ORDER BY data_actuacio ASC");
    // Missatge que mostre si no hi ha cap actuació
    if ($actuacions->num_rows == 0) {
        echo "<p style='color: black;'>No hi ha actuacions registrades per aquesta incidència.</p>";
    } else {
    ?><!-- Taula per mostrar les actuacions de la BD -->
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <tr style="background: #f0f0f0;">
                <th style="color: black;">Data</th>
                <th style="color: black;">Descripció</th>
                <th style="color: black;">Temps (minuts)</th>
            </tr>
            <?php while ($act = $actuacions->fetch_assoc()): ?>
            <tr style="color: black;">
                <td style="color: black;"><?php echo $act['data_actuacio']; ?></td>
                <td style="color: black;"><?php echo $act['descripcio']; ?></td>
                <td style="color: black;"><?php echo $act['temps_minuts']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php } ?>

    <br>
    <a href="incidencies_finalitzades.php" style="background: #764ba2; color: white; padding: 0.3rem 0.8rem; border-radius: 5px;">Tornar</a>
</div>

<?php include 'footer.php'; ?>