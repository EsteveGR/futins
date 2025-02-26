<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/navbar.php';

$id = $_GET['id'];
$sql = "DELETE FROM futbolistes WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: list_players.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
