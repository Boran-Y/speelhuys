<?php

include 'database.php';
include 'sets.php';

$image = null;


$set = set::find($_GET['id']);

if (!isset($_GET["id"])) {
    header("location: index.php");
    exit;
}



if (isset($_POST["submit"])) {
    if (!empty($_FILES["bestand"]["name"])) {
        $image = $_FILES["bestand"]["name"];

        $target = "../upload/" . basename($image);

        move_uploaded_file($_FILES['bestand']['tmp_name'], $target);
    }


    $set->name = $_POST["name"];
    $set->description = $_POST["description"];
    $set->brandid = $_POST["brand_id"];
    $set->themeid = $_POST["theme_id"]
    $set->price = $_POST["price"];
    $set->image = $image;
    $set->age = $_POST["age"];
    $set->pieces = $_POST["pieces"];
    $set->stock = $_POST["stock"]
    $set->update();
    var_dump($set);

    header("location: admin.php?file= $image");
    exit;
}


?>