<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Assignem els futbolistes d'aquest equip a equip_id = 1
    $update_sql = "UPDATE futbolistes SET equip_id = 1 WHERE equip_id = $id";
    if ($conn->query($update_sql) !== TRUE) {
        echo "Error updating record: " . $conn->error;
        exit();
    }

    // Eliminem l'equip
    $sql = "DELETE FROM equips WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: add_team.php"); // Tornem a la pàgina de gestió d’equips
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
