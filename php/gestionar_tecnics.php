<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 600px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem;">
    <h1 style="color: black;">Gestionar Tècnics</h1>
    
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>
    <!-- Comandes relacionades amb els tècnics -->
    <?php
    if (isset($_GET['eliminar'])) {
        $conn->query("DELETE FROM tecnics WHERE id_tecnic='{$_GET['eliminar']}'");
    }
    if ($_POST && !empty($_POST['nom'])) {
        $conn->query("INSERT INTO tecnics (nom) VALUES ('{$_POST['nom']}')");
    }
    $tecnicos = $conn->query("SELECT id_tecnic, nom FROM tecnics ORDER BY nom");
    ?>
    <!-- Formulari per crear un tècnic -->
    <form method="POST">
        <p style="color: black; font-weight: bold;">Nou tècnic</p>
        <div style="display: flex; gap: 0.5rem;">
            <input type="text" name="nom" required style="flex: 1; padding: 0.5rem; border-radius: 8px; border: 1px solid #ccc;">
            <button type="submit" style="background: #300c55; color: white; padding: 0.5rem 1rem; border: none; border-radius: 8px;">Crear</button>
        </div>
    </form>
    
    <hr style="margin: 1.5rem 0; border: none; height: 1px; background: #e0e0e0;">
    <!-- Llista de tècnics -->
    <h3 style="color: black;">Llista de tècnics</h3>
    <table style="width: 100%; border-collapse: collapse;">
        <?php while ($t = $tecnicos->fetch_assoc()): ?>
        <tr style="border-bottom: 1px solid #e0e0e0;">
            <td style="padding: 0.8rem 0; color: black;"><?= $t['nom'] ?></td>
            <td style="padding: 0.8rem 0; text-align: right;">
                <a href="?eliminar=<?= $t['id_tecnic'] ?>" style="color: red; text-decoration: none;">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'footer.php'; ?>