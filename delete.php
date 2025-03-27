<?php
require 'conn.php';

if (!isset($_GET['product_code'])) {
    die("Geen product code opgegeven.");
}

$product_code = $_GET['product_code'];

try {
    $stmt = $pdo->prepare("DELETE FROM producten WHERE product_code = :product_code");
    $stmt->execute(['product_code' => $product_code]);
    header("Location: select.php");
    exit;
} catch (PDOException $e) {
    die("Fout bij verwijderen: " . $e->getMessage());
}
?>
