<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>
    <h1>Gestionar Tècnics</h1>
    //Estil del formulari 
    <div style="max-width: 600px; margin: 2rem auto; background: white; padding: 2rem;">
    //Comandas relacionades amb els tècnics
    <?php
    if (isset($_GET['eliminar'])) {
        $conn->query("DELETE FROM tecnics WHERE id_tecnic='{$_GET['eliminar']}'");
    }
    if ($_POST && !empty($_POST['nom'])) {
        $conn->query("INSERT INTO tecnics (nom) VALUES ('{$_POST['nom']}')");
    }
    $tecnicos = $conn->query("SELECT id_tecnic, nom FROM tecnics ORDER BY nom");
    ?>
    //Formulari per crear untècnic
    <form method="POST">
        <p><label style="color: black;">Nou tècnic</label>
        <br>
        <input type="text" name="nom" required>
        <button type="submit">Crear</button>
        </p>
    </form>
    <hr>
    //Llista de tècnics
    <h3 style="color: black;">Llista de tècnics</h3>
    <table style="width: 100%; border-collapse: collapse;">
        <?php while ($t = $tecnicos->fetch_assoc()): ?>
        <tr style="border-bottom: 1px solid #000000;">
            <td style="padding: 0.5rem; color: black;"><?= $t['nom'] ?></td>
            <td style="padding: 0.5rem;">
                <a href="?eliminar=<?= $t['id_tecnic'] ?>" style="color: red;">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include 'footer.php'; ?>