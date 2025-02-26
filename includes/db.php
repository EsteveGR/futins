<?php

//Localhost
$host = "localhost";
$user = "root";

$pass = "R00t!!!!";
$dbname = "cromos_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>
