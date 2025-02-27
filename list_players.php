<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/navbar.php';

$sql = "SELECT futbolistes.*, equips.nom AS equip, posicions.nom AS posicio 
    FROM futbolistes 
    LEFT JOIN equips ON futbolistes.equip_id = equips.id 
    LEFT JOIN posicions ON futbolistes.posicio_id = posicions.id";
$result = $conn->query($sql);

function calcularEdat($any_neixament) {
    $data_actual = new DateTime();
    $data_neixament = new DateTime($any_neixament);
    $edat = $data_actual->diff($data_neixament);
    return $edat->y;
}
?>

<h2>Llista de Futbolistes</h2>
<table border="1">
    <tr>
    <th>Foto</th>
    <th>Nom</th>
    <th>Equip</th>
    <th>Posició</th>
    <th>Any de Naixement</th>
    <th>Edat</th>
    <th>Accions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
    <tr>
        <td><img src="uploads/<?= $row['foto'] ?>" alt="Foto de <?= $row['nom'] ?>" width="50" height="50"></td>
        <td><?= $row['nom'] ?></td>
        <td><?= $row['equip'] ?></td>
        <td><?= $row['posicio'] ?></td>
        <td><?= $row['any_neixament'] ?></td>
        <td><?= calcularEdat($row['any_neixament']) ?></td>
        <td>
        <a href="edit_player.php?id=<?= $row['id'] ?>">✏️ Editar</a>
        <a href="delete_player.php?id=<?= $row['id'] ?>" onclick="return confirm('Segur que vols esborrar aquest futbolista?')">🗑 Esborrar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'includes/footer.php'; ?>