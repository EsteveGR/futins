<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/navbar.php';

$id = $_GET['id'];
$sql = "SELECT futbolistes.*, equips.nom AS equip_nom, posicions.nom AS posicio_nom FROM futbolistes 
    LEFT JOIN equips ON futbolistes.equip_id = equips.id 
    LEFT JOIN posicions ON futbolistes.posicio_id = posicions.id 
    WHERE futbolistes.id = $id";
$result = $conn->query($sql);
$player = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $equip = $_POST['equip'];
    $posicio = $_POST['posicio'];
    $any_neixament = $_POST['any_neixament'];
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);

    if (!empty($foto)) {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $sql = "UPDATE futbolistes SET nom='$nom', equip_id='$equip', posicio_id='$posicio', any_neixament='$any_neixament', foto='$foto' WHERE id=$id";
        } else {
            echo "Error uploading file.";
        }
    } else {
        $sql = "UPDATE futbolistes SET nom='$nom', equip_id='$equip', posicio_id='$posicio', any_neixament='$any_neixament' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: list_players.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Editar Futbolista</h2>
<form method="POST" enctype="multipart/form-data">
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
    Posició: 
    <select name="posicio" required>
    <?php
    $sql = "SELECT id, nom FROM posicions";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $selected = ($row['id'] == $player['posicio_id']) ? 'selected' : '';
        echo "<option value='{$row['id']}' $selected>{$row['nom']}</option>";
    }
    ?>
    </select><br>
    Any Neixament: <input type="number" name="any_neixament" value="<?= $player['any_neixament'] ?>"><br>
    <?php if (!empty($player['foto'])): ?>
        <img src="uploads/<?=$player['foto'] ?>" alt="Foto actual" style="max-width: 100px; max-height: 100px;"><br>
    <?php endif; ?>
    Foto: <input type="file" name="foto" accept=""><br>
    <br>
    <button type="submit">Actualizar</button>
</form>
