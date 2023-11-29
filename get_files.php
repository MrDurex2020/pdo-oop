<?php
/* Include het bestand met de databaseconnectie */
include "dbconn.php";

/* --- PDO-statement zónder placeholders in de sql-query --- */
/* 1. query zonder placeholder */
$query_zonder_placeholder = "select Continent, Name, Region, SurfaceArea from country"; //query zonder place

/*2. Voer de methode 'query' uit */
$statement = $conn->query($query_zonder_placeholder);

/*3. Haal alle records op met de methode fetchAll() */
$results = $statement->fetchAll();

/*4. Verwerk de gegevens */
foreach ($results as $result) {
echo "<pre>";
//var_dump($result);
echo $result["Name'];
echo "</pre>";
}