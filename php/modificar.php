<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 600px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem;">
    <h1 style="color: black;">Modificar estat de la incidència:</h1>
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>

    <!-- Demanem les dades de la incidencia -->
    <?php
    $id = $_GET['id'];
    if ($_POST) {
        $conn->query("UPDATE incidencies SET
        tecnic_id='{$_POST['tecnic_id']}',
        prioritat='{$_POST['prioritat']}',
        tipus_id='{$_POST['tipus_id']}'
        WHERE id_inc='$id'");
        echo "<p style='color: green;'>Guardat</p>";
    }
    $dades = $conn->query("SELECT * FROM incidencies WHERE id_inc='$id'")->fetch_assoc(); 
    ?>
    
    <form method="POST">
        
        <!-- Tècnic assignat a la incidencia -->
        <p><label style="color: black;">Tècnic</label><br>
        <select name="tecnic_id" style="width: 100%; padding: 0.5rem;">
            <option value="">NO ASSIGNAT</option>
            <?php $tec = $conn->query("SELECT id_tecnic, nom FROM tecnics");
            while ($t = $tec->fetch_assoc())
            echo "<option value='{$t['id_tecnic']}'" . ($t['id_tecnic'] == $dades['tecnic_id'] ? ' selected' : '') . ">{$t['nom']}</option>"; ?>
        </select></p>
        
        <!-- Prioritat de la incidencia -->
        <p><label style="color: black;">Prioritat</label><br>
        <select name="prioritat" style="width: 100%; padding: 0.5rem;">
            <option value="Baixa" <?php if ($dades['prioritat'] == 'Baixa') echo 'selected'; ?>>Baixa</option>
            <option value="Mitja" <?php if ($dades['prioritat'] == 'Mitja') echo 'selected'; ?>>Mitja</option>
            <option value="Alta" <?php if ($dades['prioritat'] == 'Alta') echo 'selected'; ?>>Alta</option>
        </select></p>
        
        <!-- Tipologia de la incidencia -->
        <p><label style="color: black;">Tipologia</label><br>
        <select name="tipus_id" style="width: 100%; padding: 0.5rem;">
            <option value="">NO DEFINIDA</option>
            <?php $tip = $conn->query("SELECT id_tipus, nom FROM tipus_incidencia");
            while ($t = $tip->fetch_assoc())
            echo "<option value='{$t['id_tipus']}'" . ($t['id_tipus'] == $dades['tipus_id'] ? ' selected' : '') . ">{$t['nom']}</option>"; ?>
        </select></p>
        
        <!-- Guardar modificacions -->
        <button type="submit" style="background: #300c55; color: white; border: none; border-radius: 8px; padding: 0.5rem 1rem;">Guardar</button>
        <a href="totes_incidencies.php" style="color: black;">Tornar</a>
    </form>
</div>

<?php include 'footer.php'; ?>