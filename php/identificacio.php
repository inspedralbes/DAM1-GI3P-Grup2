<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<div style="max-width: 500px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h1 style="color: black;">Identifica't</h1>
    
    <div style="height: 2px; background: #764ba2; width: 100%; margin: 0.5rem 0 1.5rem 0;"></div>

    <?php if (!isset($_GET['nombre'])): ?>
        <form method="GET" action="">
            <p style="color: black; font-weight: bold;">Digues el teu nom de tècnic</p>
            <input type="text" name="nombre" style="width: 100%; padding: 0.5rem; border-radius: 8px; border: 1px solid #ccc;" required>
            <br><br>
            <button type="submit" style="background: #300c55; color: white; padding: 0.5rem 1rem; border: none; border-radius: 8px;">Identificar-me</button>
        </form>
    <?php else: ?>
        <?php
        $nombre = $_GET['nombre'];
        $tecnic = $conn->query("SELECT id_tecnic, nom FROM tecnics WHERE nom = '$nombre'")->fetch_assoc();
        
        if ($tecnic):
            echo "<script>window.location.href = 'actualitzar_estat.php?tecnic_id=" . $tecnic['id_tecnic'] . "';</script>";
            exit;
        else:
        ?>
            <p style="color: red;">No coneixem cap tècnic amb aquest nom</p>
            <a href="identificacio.php" style="color: #300c55;">Tornar</a>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>