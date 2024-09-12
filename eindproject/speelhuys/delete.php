<?php
include "database.php";
include "sets.php";


if (!isset($_GET["id"]))
{
    header("location: index.php");
    exit;
}

$id = $_GET['id'];

$set = sets::find($id);

if($set == null)
{
    echo "geen sets gevonden";
    exit;

}

$set->delete();
header("location: index.php");
?>