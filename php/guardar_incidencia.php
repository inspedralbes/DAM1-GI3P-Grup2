<?php
include 'connexio.php';

// Agafem les dades del formulari
$departament = (int)$_POST['departament_id'];
$descripcio = $_POST['descripcio'];

if (empty($descripcio)) {
    header("Location: registrar_incidencia.php?error=descripcio");
    exit;
}

$descripcio = $conn->real_escape_string($descripcio);

// Comanda per guardar la incidencia a la BD
$sql = "INSERT INTO incidencies (descripcio, data_ini, prioritat, departament_id) 
        VALUES ('$descripcio', CURDATE(), 'Baixa', $departament)";

// Comanda per si hi ha un error o si s'ha guardat correctament
if ($conn->query($sql)) {
    header("Location: registrar_incidencia.php?success=1&id=" . $conn->insert_id);
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>