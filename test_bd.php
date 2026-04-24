<?php
// Archivo de prueba para verificar conexión a la base de datos

echo "<h1>🔌 Prova de connexió a la Base de Dades</h1>";

// Datos de conexión según tu docker-compose.yaml
$servername = "db";
$username = "a25abualijab_grup2";
$password = "@ErikerAbubakar2";
$dbname = "a25abualijab_DAM1_GI3P_Grup2";

// Probar conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo "<p style='color:red'>❌ Error de connexió: " . $conn->connect_error . "</p>";
    die();
}

echo "<p style='color:green'>✅ Connexió establerta correctament!</p>";

// Probar una consulta simple
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<h2>📋 Taules de la base de dades:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>⚠️ No hi ha taules a la base de dades.</p>";
}

// Contar registres (si las tablas tienen datos)
$tablas = ['departaments', 'tecnics', 'tipus_incidencia', 'incidencies', 'actuacions'];
echo "<h2>📊 Resum de registres:</h2>";
echo "<ul>";
foreach ($tablas as $tabla) {
    $sql = "SELECT COUNT(*) AS total FROM $tabla";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<li><strong>$tabla</strong>: " . $row['total'] . " registres</li>";
    } else {
        echo "<li><strong>$tabla</strong>: No existeix o error</li>";
    }
}
echo "</ul>";

$conn->close();

echo "<hr>";
echo "<p><a href='index.php'>⬅️ Tornar a l'inici</a></p>";
?>