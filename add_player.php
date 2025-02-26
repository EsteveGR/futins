<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $equip = $_POST['equip'];
    $posicio = $_POST['posicio'];
    $any_neixament = $_POST['any_neixament'];

    $sql = "INSERT INTO futbolistes (nom, equip_id, posicio, any_neixament) VALUES ('$nom', '$equip', '$posicio', '$any_neixament')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: list_players.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Afegir Futbolista</h2>
<form method="POST">
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
    Posició: <input type="text" name="posicio"><br>
    Any Neixament: <input type="number" name="any_neixament"><br>
    <button type="submit">Guardar</button>
</form>
<?php include 'includes/footer.php'; ?>