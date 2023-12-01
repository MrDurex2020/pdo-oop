<?php
// Database configuratie
$dbConfig = array(
    'host' => 'localhost',
    'gebruiker' => 'root',
    'wachtwoord' => '',
    'database' => 'winkel'
);

// Verbinding maken met de database met PDO
try {
    $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}", $dbConfig['gebruiker'], $dbConfig['wachtwoord']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindingsfout: " . $e->getMessage());
}

// Deel 1: Hoe je alles selecteert in een query zonder variabele
echo "<h2>Deel 1: Alle producten</h2>";
$sql = "SELECT * FROM producten";
$stmt = $pdo->query($sql);
foreach ($stmt as $row) {
    echo "Product Code: " . $row['product_code'] . "<br>";
    echo "Product Naam: " . $row['product_naam'] . "<br>";
    echo "Prijs per Stuk: " . $row['prijs_per_stuk'] . "<br>";
    echo "Omschrijving: " . $row['omschrijving'] . "<br><br>";
}

// Deel 2: Hoe je een single row selecteert met placeholders
echo "<h2>Deel 2: Product met product_code 1</h2>";
$sql = "SELECT * FROM producten WHERE product_code = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([1]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Product Code: " . $row['product_code'] . "<br>";
echo "Product Naam: " . $row['product_naam'] . "<br>";
echo "Prijs per Stuk: " . $row['prijs_per_stuk'] . "<br>";
echo "Omschrijving: " . $row['omschrijving'] . "<br><br>";

// Deel 3: Hoe je een single row selecteert met named parameters
echo "<h2>Deel 3: Product met product_code 2</h2>";
$sql = "SELECT * FROM producten WHERE product_code = :product_code";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':product_code' => 2));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Product Code: " . $row['product_code'] . "<br>";
echo "Product Naam: " . $row['product_naam'] . "<br>";
echo "Prijs per Stuk: " . $row['prijs_per_stuk'] . "<br>";
echo "Omschrijving: " . $row['omschrijving'] . "<br><br>";

// Sluiten van de databaseverbinding
$pdo = null;
?>
