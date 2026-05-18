<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 1000px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem;">
    <h1 style="color: black;">Incidencies finalitzades</h1>
    
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>

    <!-- Consulta per obtenir les incidencies finalitzades -->
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
    
    <!-- Taula per mostrar les incidencies finalitzades -->
    <table border="1" style="width: auto; margin: 0 auto; border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th style="color: black;">ID</th>
            <th style="color: black;">Departament</th>
            <th style="color: black;">Data Inici</th>
            <th style="color: black;">Descripció</th>
            <th style="color: black;">Prioritat</th>
            <th style="color: black;">Tècnic</th>
            <th style="color: black;">Data fi</th>
            <th style="color: black;">Estat</th>
            <th style="color: black;">Actuacions</th>
        </tr>
        
        <!-- Bucle per mostrar cada incidencia finalitzada -->
        <?php while ($row = $result->fetch_assoc()):
            if ($row['prioritat'] == 'Alta') {
                $color_fila = '#ffcccc';
            } elseif ($row['prioritat'] == 'Mitja') {
                $color_fila = '#fff3cd';
            } else {
                $color_fila = '#d4edda';
            }
        ?>
        <tr style="background: <?php echo $color_fila; ?>; color: black;" id="fila-<?php echo $row['id_inc']; ?>">
            <td><?php echo $row['id_inc']; ?></td>
            <td><?php echo $row['departament']; ?></td>
            <td><?php echo $row['data_ini']; ?></td>
            <td><?php echo $row['descripcio']; ?></td>
            <td><?php echo $row['prioritat']; ?></td>
            <td><?php echo $row['tecnic'] ?? '-'; ?></td>
            <td><?php echo $row['data_fi']; ?></td>
            <td><?php echo $row['data_fi'] ? 'Tancada' : 'Oberta'; ?></td>
            <td><a href="veure_actuacions.php?incidencia_id=<?php echo $row['id_inc']; ?>" style="color: blue;">VEURE</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'footer.php'; ?>