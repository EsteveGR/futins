<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/navbar.php';

$id = $_GET['id'];
$sql = "SELECT futbolistes.*, equips.nom AS equip_nom FROM futbolistes LEFT JOIN equips ON futbolistes.equip_id = equips.id WHERE futbolistes.id = $id";
$result = $conn->query($sql);
$player = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $equip = $_POST['equip'];
    $posicio = $_POST['posicio'];
    $any_neixament = $_POST['any_neixament'];

    $sql = "UPDATE futbolistes SET nom='$nom', equip_id='$equip', posicio='$posicio', any_neixament='$any_neixament' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: list_players.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Editar Futbolista</h2>
<form method="POST">
    Nom: <input type="text" name="nom" value="<?= $player['nom'] ?>" required><br>
    Equip: 
    <select name="equip" required>
        <?php
        $sql = "SELECT id, nom FROM equips";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $selected = ($row['id'] == $player['equip_id']) ? 'selected' : '';
            echo "<option value='{$row['id']}' $selected>{$row['nom']}</option>";
        }
        ?>
    </select><br>
    Posició: <input type="text" name="posicio" value="<?= $player['posicio'] ?>"><br>
    Any Neixament: <input type="number" name="any_neixament" value="<?= $player['any_neixament'] ?>"><br>
    <button type="submit">Actualizar</button>
</form>
