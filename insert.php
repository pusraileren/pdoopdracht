<?php
require 'pdo/conn.php';

if (isset($_POST['submit'])) {
    $productNaam = $_POST['product_naam'];
    $prijsPerStuk = $_POST['prijs_per_stuk'];
    $omschrijving = $_POST['omschrijving'];

    if (empty($productNaam) || empty($prijsPerStuk) || empty($omschrijving)) {
        echo "Alle velden zijn verplicht";
        exit;
    }

    $sql = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) 
            VALUES (:product_naam, :prijs_per_stuk, :omschrijving)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'product_naam' => $productNaam,
            'prijs_per_stuk' => $prijsPerStuk,
            'omschrijving' => $omschrijving
        ]);
        echo "Product succesvol toegevoegd";
    } catch (PDOException $e) {
        echo "Fout bij toevoegen: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

</head>
<body>
<form method="POST" action="">
    <label>Product Naam:</label><br>
    <input type="text" name="product_naam" required><br>
    
    <label>Prijs per stuk:</label><br>
    <input type="number" name="prijs_per_stuk" step="0.01" required><br>
    
    <label>Omschrijving:</label><br>
    <input type="text" name="omschrijving" required><br>
    
    <button type="submit" name="submit">Voeg Product Toe</button>
</form>


</body>
</html>





