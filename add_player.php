<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $equip = $_POST['equip'];
    $posicio = $_POST['posicio'];
    $any_neixament = $_POST['any_neixament'];
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);

    // Check if file is an image
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO futbolistes (nom, equip_id, posicio_id, any_neixament, foto) VALUES ('$nom', '$equip', '$posicio', '$any_neixament', '$foto')";
            
            if ($conn->query($sql) === TRUE) {
                header("Location: list_players.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Hi ha hagut un error pujant la foto...";
        }
    } else {
        echo "El fitxer no és una imatge...";
    }
}
?>

<h2>Afegir Futbolista</h2>
<form method="POST" enctype="multipart/form-data">
    Nom: <input type="text" name="nom" required><br>
    Equip: 
    <select name="equip">
        <?php
        $sql = "SELECT * FROM equips";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
            }
        } else {
            echo "<option value=''>No equips found</option>";
        }
        ?>
    </select><br>
    Posició: 
    <select name="posicio">
        <?php
        $sql = "SELECT * FROM posicions";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
            }
        } else {
            echo "<option value=''>No posicions found</option>";
        }
        ?>
    </select><br>
    Any Neixament: <input type="number" name="any_neixament"><br>
    Foto: <input type="file" name="foto" required><br>
    <button type="submit">Guardar</button>
</form>
<?php include 'includes/footer.php'; ?>