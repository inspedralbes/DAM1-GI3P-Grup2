<?php include 'header.php'; ?>
<?php include 'connexio.php'; ?>

<h1>Identifica't</h1>
//Estil del formulari
<div style="max-width: 600px; margin: 2rem auto; background: white; padding: 2rem;">
    <?php if (!isset($_GET['id_inc'])): ?>
        <p style="color: black;">Digues l'id de la incidencia:</p>
        <form method="GET" action="">
            <input type="text" name="id_inc" style="width: 100%; padding: 0.5rem;" required>
            <br><br>
            <button type="submit">Consulta l'estat</button>
        </form>
    <?php else: ?>
        //Comanda a la BD
        <?php
        $id_inc = $_GET['id_inc'];
        $Inci = $conn->query("SELECT id_inc FROM incidencies WHERE id_inc = '$id_inc'")->fetch_assoc();
       //Comanda per si hi ha un error 
        if ($Inci):
            echo "<script>window.location.href = 'consultori_dades.php?id_inc=" . $Inci['id_inc'] . "';</script>";
            exit;
        else:
        ?>
            <p style="color: red;">Incidencia no registrada</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>