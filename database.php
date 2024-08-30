<?php

$servername = "127.0.0.1"; // databasehost ip adres
$username = "root"; // databasegebruikersnaam
$password = ""; // database wachtwoord
$dbname = "speelhuys"; // database naam

// Connectie
$connectie = new mysqli($servername, $username, $password, $dbname);

// Connectie error
if ($connectie->connect_error) {
    die("Verbinding mislukt: " . $connectie->connect_error);
}

?>
