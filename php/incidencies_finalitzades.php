<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<h1>Incidencies finalitzades</h1>

<div style="max-width: 900px; margin: 2rem auto; background: white; padding: 2rem; color: black;">
    <?php
    $sql = "SELECT i.id_inc, i.descripcio, i.data_ini, i.data_fi, i.prioritat,
            d.nom AS departament,
            t.nom as tecnic
            FROM incidencies i
            LEFT JOIN departaments d ON i.departament_id = d.id_dept
            LEFT JOIN tecnics t ON i.tecnic_id = t.id_tecnic
            WHERE i.data_fi IS NOT NULL
            ORDER BY i.id_inc ASC";
    $result = $conn->query($sql);
    ?>
    
    <table border="1" style="width: auto; margin: 0 auto; border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th>ID</th>
            <th>Departament</th>
            <th>Data Inici</th>
            <th>Descripció</th>
            <th>Prioritat</th>
            <th>Tècnic</th>
            <th>Data fi</th>
            <th>Estat</th>
            <th>Actuacions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id_inc']; ?></td>
            <td><?php echo $row['departament']; ?></td>
            <td><?php echo $row['data_ini']; ?></td>
            <td><?php echo $row['descripcio']; ?></td>
            <td><?php echo $row['prioritat']; ?></td>
            <td><?php echo $row['tecnic'] ?? '-'; ?></td>
            <td><?php echo $row['data_fi']; ?></td>
            <td><?php echo $row['data_fi'] ? 'Tancada' : 'Oberta'; ?></td>
            <td><a href="veure_actuacions.php?incidencia_id=<?php echo $row['id_inc']; ?>">VEURE</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'footer.php'; ?>