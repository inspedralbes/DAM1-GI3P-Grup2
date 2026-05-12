<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<h1>Llistat d'incidències</h1>

<div style="max-width: 1200px; margin: 2rem auto; background: white; padding: 2rem; color: black;">
    <?php
    $sql = "SELECT i.id_inc, i.descripcio, i.data_ini, i.data_fi, i.prioritat,
            d.nom AS departament,
            t.nom as tecnic
            FROM incidencies i
            LEFT JOIN departaments d ON i.departament_id = d.id_dept
            LEFT JOIN tecnics t ON i.tecnic_id = t.id_tecnic
            ORDER BY i.id_inc ASC";
    $result = $conn->query($sql);
    ?>
    
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th>ID</th>
            <th>Departament</th>
            <th>Data Inici</th>
            <th>Descripció</th>
            <th>Prioritat</th>
            <th>Tècnic</th>
            <th>Estat</th>
            <th>Acció</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()):
            if ($row['prioritat'] == 'Alta') {
                $color_fila = '#ffcccc';
            } elseif ($row['prioritat'] == 'Mitja') {
                $color_fila = '#fff3cd';
            } else {
                $color_fila = '#d4edda';
            }
        ?>
        <tr style="background: <?php echo $color_fila; ?>;">
            <td><?php echo $row['id_inc']; ?></td>
            <td><?php echo $row['departament']; ?></td>
            <td><?php echo $row['data_ini']; ?></td>
            <td><?php echo $row['descripcio']; ?></td>
            <td><?php echo $row['prioritat']; ?></td>
            <td><?php echo $row['tecnic'] ?? '-'; ?></td>
            <td><?php echo $row['data_fi'] ? 'Tancada' : 'Oberta'; ?></td>
            <td><a href="modificar.php?id=<?php echo $row['id_inc']; ?>">Editar</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
        <button style="background: #300c30; color: white;" onclick="window.location.href='quesito.php'">Veure incidències en format quesito</button>
    </div>
</div>
<?php include 'footer.php'; ?>