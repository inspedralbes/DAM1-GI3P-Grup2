<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>
<?php
$tecnic_id = $_GET['tecnic_id'];
$tecnic = $conn->query("SELECT nom FROM tecnics WHERE id_tecnic='$tecnic_id'")->fetch_assoc();
?>
<!--Titol de la pàgina-->
<h1>Incidències assignades a <?= $tecnic['nom'] ?></h1>
<!--Estil de la taula i del contingut-->
<div style="max-width: 1200px; margin: 2rem auto; background: white; padding: 2rem;">
<!--Comanda per demanar les dades a la BD-->  
  <?php
    $sql = "SELECT i.id_inc, i.descripcio, i.data_ini, i.data_fi, i.prioritat,
                   d.nom AS departament
            FROM incidencies i
            LEFT JOIN departaments d ON i.departament_id = d.id_dept
            WHERE i.tecnic_id = '$tecnic_id'
            ORDER BY i.data_ini DESC";
    $result = $conn->query($sql);
    ?>
    <table border="1" style="width: 100%; border-collapse: collapse; color: black;">
        <tr style="background: #f0f0f0;">
            <th>ID</th>
            <th>Departament</th>
            <th>Data inici</th>
            <th>Descripció</th>
            <th>Prioritat</th>
            <th>Estat</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <!--Comanda per mostrar les dades de les incidencies-->
        <tr>
            <td><?= $row['id_inc'] ?></td>
            <td><?= $row['departament'] ?></td>
            <td><?= $row['data_ini'] ?></td>
            <td><?= $row['descripcio'] ?></td>
            <td><?= $row['prioritat'] ?></td>
            <td><?= $row['data_fi'] ? 'Tancada' : 'Oberta'; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include 'footer.php'; ?>