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

// Functie om HTML en PHP-injecties tegen te gaan
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verwerken van het formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gegevens ophalen en beveiligen tegen injecties
    $product_naam = test_input($_POST["product_naam"]);
    $prijs_per_stuk = test_input($_POST["prijs_per_stuk"]);
    $omschrijving = test_input($_POST["omschrijving"]);

    try {
        // SQL-query voor het toevoegen van een product
        $sql = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$product_naam, $prijs_per_stuk, $omschrijving]);

        echo "Product succesvol toegevoegd.<br>";
    } catch (PDOException $e) {
        echo "Fout bij toevoegen van het product: " . $e->getMessage() . "<br>";
    }
}

// Sluiten van de databaseverbinding
$pdo = null;
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Toevoegen</title>
</head>
<body>

<h2>Product Toevoegen</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Product Naam: <input type="text" name="product_naam" required><br>
    Prijs per Stuk: <input type="number" name="prijs_per_stuk" step="0.01" required><br>
    Omschrijving: <textarea name="omschrijving" rows="4" cols="50" required></textarea><br>
    <input type="submit" name="submit" value="Voeg Product Toe">
</form>

</body>
</html>