<?php
include "../classes/database.php";
include "../classes/sets.php";


if (!isset($_GET["id"]))
{
    header("location: admin_overview.php");
    exit;
}

$id = $_GET['id'];

$set = Set::find($id);

if($set == null)
{
    echo "geen sets gevonden";
    exit;

}

$set->delete();
header("location: admin_overview.php");
?>