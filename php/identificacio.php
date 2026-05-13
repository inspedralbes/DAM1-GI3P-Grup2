<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>
    // Formulari d'identificació per al tècnic

    <h1>Identifica't</h1>
    
    //estil del formulari

    <div style="max-width: 600px; margin: 2rem auto; background: white; padding: 2rem;">
    <?php if (!isset($_GET['nombre'])): ?>
        //Formulari d'identificació
        <p style="color: black;">Digues el teu nom de tècnic:</p>
        <form method="GET" action="">
            <input type="text" name="nombre" style="width: 100%; padding: 0.5rem;" required>
            <br><br>
            <button type="submit">Identificar-me</button>
        </form>
    <?php else: ?>
        //Comanda a la BD
        <?php
        $nombre = $_GET['nombre'];
        $tecnic = $conn->query("SELECT id_tecnic, nom FROM tecnics WHERE nom = '$nombre'")->fetch_assoc();
        
        if ($tecnic):
            echo "<script>window.location.href = 'actualitzar_estat.php?tecnic_id=" . $tecnic['id_tecnic'] . "';</script>";
            exit;
        else:
        ?>
        //Comanda si hi ha un error
            <p style="color: red;">No coneixem cap tècnic amb aquest nom </p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>