<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/navbar.php';

// Si s'envia el formulari per afegir un equip
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];

    // Comprovar si ja existeix un equip amb aquest nom
    $existeix = $conn->query("SELECT * FROM equips WHERE nom = '$nom'");

    if ($existeix->num_rows > 0) {
        echo "<p style='color: red;'>Ja existeix un equip amb aquest nom.</p>";
    } else {
        $sql = "INSERT INTO equips (nom) VALUES ('$nom')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Equip creat correctament!</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
        }
    }
}

// Obtenir la llista d’equips existents
$equips = $conn->query("SELECT * FROM equips");
?>

<h2>Afegir Equip</h2>
<form method="POST">
    <label for="nom">Nom de l'Equip:</label>
    <input type="text" name="nom" required>
    <button type="submit">Crear Equip</button>
</form>

<h3>Equips Existents</h3>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Accions</th>
    </tr>
    <?php while ($equip = $equips->fetch_assoc()): ?>
        <tr>
            <td><?= $equip['nom'] ?></td>
            <td>
                <a href="delete_team.php?id=<?= $equip['id'] ?>" onclick="return confirm('Segur que vols esborrar aquest equip?')">🗑 Esborrar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
