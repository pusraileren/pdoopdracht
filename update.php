<?php
require 'conn.php';

if (!isset($_GET['product_code'])) {
    die("Geen product code opgegeven.");
}

$product_code = $_GET['product_code'];

try {
    $stmt = $pdo->prepare("SELECT * FROM producten WHERE product_code = :product_code");
    $stmt->execute(['product_code' => $product_code]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product niet gevonden.");
    }
} catch (PDOException $e) {
    die("Fout bij ophalen: " . $e->getMessage());
}

// Als formulier is verzonden
if (isset($_POST['submit'])) {
    $productNaam = $_POST['product_naam'];
    $omschrijving = $_POST['omschrijving'];

    if (empty($productNaam) || empty($omschrijving)) {
        echo "Alle velden zijn verplicht.";
    } else {
        try {
            $sql = "UPDATE producten 
                    SET product_naam = :product_naam, 
                        omschrijving = :omschrijving 
                    WHERE product_code = :product_code";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'product_naam' => $productNaam,
                'omschrijving' => $omschrijving,
                'product_code' => $product_code
            ]);
            echo "Product succesvol bijgewerkt.";
        } catch (PDOException $e) {
            echo "Fout bij bijwerken: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Product Bewerken</title>
</head>
<body>
    <h2>Bewerk Product</h2>
    <form method="POST" action="">
        <label>Product code:</label><br>
        <input type="text" name="product_code" value="<?php echo htmlspecialchars($product['product_code']); ?>" readonly><br>

        <label>Product Naam:</label><br>
        <input type="text" name="product_naam" value="<?php echo htmlspecialchars($product['product_naam']); ?>" required><br>

        <label>Omschrijving:</label><br>
        <input type="text" name="omschrijving" value="<?php echo htmlspecialchars($product['omschrijving']); ?>" required><br>

        <button type="submit" name="submit">Update Product</button>
    </form>
</body>
</html>
