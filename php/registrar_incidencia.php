<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 600px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h1 style="color: black;">Registrar incidència</h1>
    
    <div style="height: 2px; background: #764ba2; width: 600px; margin: 0.5rem 0 1.5rem 0;"></div>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'descripcio'): ?>
        <p style="color: red;">Has d'escriure una descripció</p>
    <?php endif; ?>

    <form method="POST" action="guardar_incidencia.php">
        <p style="color: black;"><strong>Departament</strong></p>
        <select name="departament_id" style="width: 100%; padding: 0.5rem; color: black;">
            <option value="">Selecciona...</option>
            <?php
            $result = $conn->query("SELECT id_dept, nom FROM departaments");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_dept'] . "' style='color: black;'>" . $row['nom'] . "</option>";
            }
            ?>
        </select>

        <p style="color: black;"><strong>Descripció</strong></p>
        <textarea name="descripcio" rows="4" style="width: 100%; padding: 0.5rem; color: black;"></textarea>

        <br><br>
        <button type="submit" style="background: #300c55; color: white; padding: 0.5rem 1rem; border: none;">Registrar</button>
    </form>
</div>

<?php include 'footer.php'; ?>