<?php

$servername- "localhost";
$username = "root";
$password = "";
$database = "world";
nten
try
{
/* hieronder staat het PDO-object */
$conn = new PDO("mysql:host-$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//echo "De connectie is gelukt";
} catch (PDOException $e) {
echo "er is een fout opgetreden, namelijk deze fout:" . $e->getMessage() . '<br>';
echo "bestand" . $e->getFile() . '<br>';
echo "regel: " . $e->getline();
}
?>