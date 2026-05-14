<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 500px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem;">
    <h1 style="color: black;">Consulta l'estat</h1>
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>
    
    <?php if (!isset($_GET['id_inc'])): ?>
        <form method="GET" action="">
            <p style="color: black; font-weight: bold;">Digues l'id de la incidencia:</p>
            <input type="text" name="id_inc" style="width: 100%; padding: 0.5rem; border-radius: 8px; border: 1px solid #ccc;" required>
            <br><br>
            <button type="submit" style="background: #300c55; color: white; padding: 0.5rem 1rem; border: none; border-radius: 8px;">Consulta l'estat</button>
        </form>
    <?php else: ?>
        <?php
        $id_inc = $_GET['id_inc'];
        $Inci = $conn->query("SELECT id_inc FROM incidencies WHERE id_inc = '$id_inc'")->fetch_assoc();
        
        if ($Inci):
            echo "<script>window.location.href = 'consultori_dades.php?id_inc=" . $Inci['id_inc'] . "';</script>";
            exit;
        else:
        ?>
            <p style="color: red;">Incidencia no registrada</p>
            <a href="consultar_estat.php" style="color: #300c55;">Tornar</a>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
