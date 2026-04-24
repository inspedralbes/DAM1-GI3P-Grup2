<?php


$servername = "localhost";
$username = "a25abualijab_Grup2";  // Username
$password = "@ErikerAbubakar2";  // Password
$dbname = "a25abualijab_DAM1_GI3P_Grup2";  // DB

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de connexió: " . $conn->connect_error);
}

$conn->set_charset("utf8");
//prova
?>