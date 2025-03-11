<?php
require 'pdo/conn.php';

try {
    $sql = "SELECT * FROM producten";
    $stmt = $pdo->query($sql);
    $personen = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Fout bij ophalen: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikers Overzicht</title>
</head>
<body>
    <h2>Overzicht van Gebruikers</h2>
    <table border="1">
        <tr>
            <th>Product code </th>
            <th>Naam</th>
            <th>Omschrijving</th>
        </tr>
        <?php foreach ($personen as $persoon) { ?>
        <tr>
            <td><?php echo $persoon['product_code']; ?></td>
            <td><?php echo $persoon['product_naam']; ?></td>
            <td><?php echo $persoon['omschrijving']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
