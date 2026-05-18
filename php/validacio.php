<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 1200px; margin: 2rem auto; background: red; border-radius: 20px; padding: 2rem;">
    <h1 style="color: black;">Practicar Validació</h1>
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>

    <p style="color: black;">Aquest és un espai per practicar la validació</p>

    <!-- =================================================== -->
    <!-- PUNT 2: Mostrar dades d'una consulta SELECT (més d'una fila) -->
    <!-- =================================================== -->
    <?php
    // PUNT 2: Consulta SQL que retorna diverses files (totes les incidències)
    $sql = "SELECT i.id_inc, i.descripcio, i.data_ini, i.prioritat, d.nom AS departament
        FROM incidencies i
        LEFT JOIN departaments d ON i.departament_id = d.id_dept";

    $result = $conn->query($sql);  // Executem la consulta

    // PUNT 2: Bucle while per recórrer cada fila de resultats
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_inc'] . "</td>";
        echo "<td>" . $row['departament'] . "</td>";
        echo "<td>" . $row['descripcio'] . "</td>";
        echo "</tr>";
    }
    ?>

    <!-- =================================================== -->
    <!-- PUNT 3: Formulari amb action i method -->
    <!-- =================================================== -->
    <form method="POST" action="guardar_incidencia.php">
        
        <!-- PUNT 3: Camp select amb name per identificar-lo al servidor -->
        <select name="departament_id">
            <option value="">Selecciona...</option>
            <?php
            // Carreguem departaments des de la BD per omplir el selector
            $result = $conn->query("SELECT id_dept, nom FROM departaments");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_dept'] . "'>" . $row['nom'] . "</option>";
            }
            ?>
        </select>

        <!-- PUNT 3: Camp textarea amb name per identificar-lo al servidor -->
        <textarea name="descripcio" rows="4"></textarea>

        <!-- PUNT 3: Botó type="submit" per enviar el formulari -->
        <button type="submit">Registrar</button>
    </form>

    <!-- NOTA: PUNT 1 (connexió a BD) i PUNT 4 (recuperar dades POST) -->
    <!-- PUNT 1: connexio.php ja està inclòs al principi (connecta amb la BD) -->
    <!-- PUNT 4: guardar_incidencia.php recull les dades amb $_POST -->

</div>

<?php include 'footer.php'; ?>