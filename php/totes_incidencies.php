<?php
include 'connexio.php';
include 'header.php'; 

// Eliminar incidencia si le llega GET
if (isset($_GET['eliminar'])) {
    $id_eliminar = (int)$_GET['eliminar'];
    $conn->query("DELETE FROM incidencies WHERE id_inc = $id_eliminar");
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}
?>

<div style="max-width: 1200px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem;">
    <h1 style="color: black;">Llistat d'incidències</h1>
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>

    <div style="margin-bottom: 1rem; text-align: right;">
        <label for="ordre" style="color: black;">Ordenar per: </label>
        <select id="ordre" onchange="window.location.href='?ordre='+this.value">
            <option value="id_asc" <?php echo (!isset($_GET['ordre']) || $_GET['ordre'] == 'id_asc') ? 'selected' : ''; ?>>ID</option>
            <option value="prioritat" <?php echo (isset($_GET['ordre']) && $_GET['ordre'] == 'prioritat') ? 'selected' : ''; ?>>Prioritat</option>
            <option value="data_desc" <?php echo (isset($_GET['ordre']) && $_GET['ordre'] == 'data_desc') ? 'selected' : ''; ?>>Data</option>
        </select>
    </div>

    <?php
    $ordre = $_GET['ordre'] ?? 'id_asc';
    //Comanda per ordenar les incidències segons la seva prioritat o data d'inici
    if ($ordre == 'prioritat') {
        $order_by = "FIELD(i.prioritat, 'Alta', 'Mitja', 'Baixa'), i.data_ini DESC";
    } elseif ($ordre == 'data_desc') {
        $order_by = "i.data_ini DESC";
    } else {
        $order_by = "i.id_inc ASC";
    }
    //Comanda per demanar dades a la BD
    $sql = "SELECT i.id_inc, i.descripcio, i.data_ini, i.data_fi, i.prioritat,
            d.nom AS departament,
            t.nom as tecnic
            FROM incidencies i
            LEFT JOIN departaments d ON i.departament_id = d.id_dept
            LEFT JOIN tecnics t ON i.tecnic_id = t.id_tecnic
            ORDER BY $order_by";
    $result = $conn->query($sql);
    ?>
    
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th style="color: black;">ID</th>
            <th style="color: black;">Departament</th>
            <th style="color: black;">Data Inici</th>
            <th style="color: black;">Descripció</th>
            <th style="color: black;">Prioritat</th>
            <th style="color: black;">Tècnic</th>
            <th style="color: black;">Estat</th>
            <th style="color: black;">Acció</th>
            <th style="color: black;">Eliminar</th>
        </tr>
<!--Comanda per mostrar les dades de les incidencies amb color segons la seva prioritat-->
        <?php while ($row = $result->fetch_assoc()):
            if ($row['prioritat'] == 'Alta') {
                $color_fila = '#ffcccc';
            } elseif ($row['prioritat'] == 'Mitja') {
                $color_fila = '#fff3cd';
            } else {
                $color_fila = '#d4edda';
            }
        ?>
        <!--Taula per mostrar les dades de les incidencies de la BD-->
        <tr style="background: <?php echo $color_fila; ?>; color: black;" id="fila-<?php echo $row['id_inc']; ?>">
            <td><?php echo $row['id_inc']; ?></td>
            <td><?php echo $row['departament']; ?></td>
            <td><?php echo $row['data_ini']; ?></td>
            <td><?php echo $row['descripcio']; ?></td>
            <td><?php echo $row['prioritat']; ?></td>
            <td><?php echo $row['tecnic'] ?? '-'; ?></td>
            <td><?php echo $row['data_fi'] ? 'Tancada' : 'Oberta'; ?></td>
            <td><a href="modificar.php?id=<?php echo $row['id_inc']; ?>" style="background: #0000ff; color: white; padding: 0.3rem 0.8rem; text-decoration: none; border-radius: 8px; display: inline-block;">Editar</a></td>
            <td><button class="eliminar" data-id="<?php echo $row['id_inc']; ?>" style="background: #ff0000; color: white; padding: 0.3rem 0.8rem; border: none; border-radius: 8px;">Eliminar</button></td>
        </tr>
        <?php endwhile; ?>
    </table>
    
    <br>
    <button style="background: #300c30; color: white; border: none; border-radius: 8px; padding: 0.5rem 1rem;" onclick="window.location.href='quesito.php'">Veure incidències en format quesito</button>
</div>

<!--Comanda per eliminar cada incidencia-->
<script>
document.querySelectorAll('.eliminar').forEach(btn => {
    btn.onclick = () => {
        let id = btn.getAttribute('data-id');
        fetch(window.location.href + '?eliminar=' + id);
        document.getElementById('fila-' + id).remove();
    };
});
</script>

<?php include 'footer.php'; ?>