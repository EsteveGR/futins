<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/navbar.php';

$sql = "SELECT futbolistes.*, equips.nom AS equip FROM futbolistes LEFT JOIN equips ON futbolistes.equip_id = equips.id";
$result = $conn->query($sql);
?>

<h2>Llista de Futbolistes</h2>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Equip</th>
        <th>Posició</th>
        <th>Edat</th>
        <th>Accions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['nom'] ?></td>
            <td><?= $row['equip'] ?></td>
            <td><?= $row['posicio'] ?></td>
            <td><?= $row['any_neixament'] ?></td>
            <td>
                <a href="edit_player.php?id=<?= $row['id'] ?>">✏️ Editar</a>
                <a href="delete_player.php?id=<?= $row['id'] ?>" onclick="return confirm('Segur que vols esborrar aquest futbolista?')">🗑 Esborrar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include 'includes/footer.php'; ?>