<?php

include "classes/database.php";
include "classes/sets.php";

$set = Set::Find($_GET["id"]);

if ($set == null) {
    echo "Geen product gevonden.";
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title><?= $set->name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styling/homestyle.css">
</head>

<body class="backgroundHome" background="ahmadmainchanel.jpg">

    <h1 class="setpagina"><?= $set->name; ?></h1>
    <div class="center">
        <button class="terug" onclick="window.location.href = 'home.php';">Terug</button>
    </div>

    <div class="selectedSet">
        <div class="image-container">
            <img class="setImage" src="upload/<?= $set->image; ?>" alt="<?= $set->name; ?>">
        </div>
        <div class="setTekst">
            <p class="description"><b>Beschrijving:</b><br><?= $set->description; ?></p>
            <p class="price"><b>Prijs:</b><br><?= $set->price; ?></p>
            <p class="pieces"><b>Stuks:</b><br> Dit product bestaat uit <?= $set->pieces; ?> stukjes</p>
            <p class="age"><b>Leeftijd:</b><br>Dit product is geschikt voor kinderen vanaf <?= $set->age; ?> jaar</p>
            <p class="stock"><b>Voorraad:</b><br>Van dit product hebben wij er nog <?= $set->stock; ?> op voorraad</p>
        </div>
    </div>
</body>