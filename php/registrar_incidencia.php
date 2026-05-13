<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>
    <h1>Registra la teva incidència:</h1>
<div style="max-width: 600px; margin: 2rem auto; background: white; padding: 2rem;">
    <?php if (isset($_GET['error']) && $_GET['error'] == 'descripcio'): ?>
        <p style="color: red;">Has d'escriure una descripció</p>
    <?php endif; ?>
    <form method="POST" action="guardar_incidencia.php">
    <p style="color: black;">Departament:</p>
    <select name="departament_id" style="width: 100%; padding: 0.5 rem;">
        <option value="">Selecciona...</option>
        <?php
        $result = $conn->query("SELECT id_dept, nom FROM departaments");
        while ($row = $result->fetch_assoc()){
            echo "<option value='" . $row['id_dept'] . "'>" . $row['nom'] . "</option>";
        }
        ?>
        </select>
        <p style="color: black;">Descripció:</p>
        <textarea name="descripcio" rows="4" style="width: 100%; padding: 0.5 rem;"></textarea>
        <br>
        <br>
        <button type="submit">Registrar</button>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <p style="color: green;">Incidència registrada correctament</p>
        <?php endif; ?>
    </form>
</div>
<?php include 'footer.php'; ?>