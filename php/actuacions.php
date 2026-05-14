<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<h1>Gestionar incidència</h1>
    <!--Estil del formulari-->
<div style="max-width: 600px; margin: 2rem auto; background: white; padding: 2rem; color: black;">
    <?php
    $id = $_GET['id'];
    if ($_POST) {
        $nova_data = ($_POST['estat'] == 'Tancada') ? 'CURDATE()' : 'NULL';
        $conn->query("UPDATE incidencies SET data_fi = $nova_data WHERE id_inc='$id'");
        
        $descripcio_actuacio = $conn->real_escape_string($_POST['descripcio_actuacio']);
        $data_actuacio = $_POST['data_actuacio'];
        $temps_minuts = $_POST['temps_minuts'];
        $visible = isset($_POST['visible']) ? 1 : 0;
        //Dades de l'actuació a la BD
        $conn->query("INSERT INTO actuacions (descripcio, data_actuacio, temps_minuts, visible_usuari, incidencia_id) 
                      VALUES ('$descripcio_actuacio', '$data_actuacio', $temps_minuts, $visible, $id)");
        
        echo "<p style='color: green; font-weight: bold;'>Actualitzat</p>";
    }
    $dades = $conn->query("SELECT * FROM incidencies WHERE id_inc='$id'")->fetch_assoc();
    $estat_actual = $dades['data_fi'] ? 'Tancada' : 'Oberta';
    ?>
    
    <form method="POST">
        <p><strong>Estat d'Incidència</strong></p>
        <select name="estat" style="width: 100%; padding: 0.5rem;">
            <option value="Oberta" <?= $estat_actual == 'Oberta' ? 'selected' : '' ?>>Oberta</option>
            <option value="Tancada" <?= $estat_actual == 'Tancada' ? 'selected' : '' ?>>Tancada</option>
        </select>
        <br><br>
        <!--Formulari de l'actuació-->
        <p><strong>Descripció de l'Actuació</strong></p>
        <textarea name="descripcio_actuacio" rows="4" style="width: 100%; padding: 0.5rem;" required></textarea>
        <br><br>

        <p><strong>Temps (min)</strong></p>
        <input type="number" name="temps_minuts" value="0" style="width: 100%; padding: 0.5rem;" required>
        <br><br>

        <p><strong>Data Actuació</strong></p>
        <input type="date" name="data_actuacio" value="<?= date('Y-m-d') ?>" style="width: 100%; padding: 0.5rem;" required>
        <br><br>
        
        <p><strong>Visible per l'Usuari?</strong></p>
        <input type="checkbox" name="visible" value="1" checked> Sí
        <br><br>
        
        <button type="submit">Guardar</button>
    </form>
</div>

<?php include 'footer.php'; ?>