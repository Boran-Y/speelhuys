<table border="1">
  
  <tr>
  <td><strong>set_id</strong></td>
    <td><strong>set_name</strong></td>
    <td><strong>set_description</strong></td>
    <td><strong>set_brand_id</strong></td>
    <td><strong>set_theme_id</strong></td>
    <td><strong>set_price</strong></td>
    <td><strong>set_image</strong></td>
    <td><strong>set_age</strong></td>
    <td><strong>set_pieces</strong></td>
    <td><strong>set_stock</strong></td>

  </tr>







<?php
include "database.php";
include "sessie.php";
include "gebruiker.php";
include "sets.php";

Sessions::start(); // verzekerd dat de sessie gestart is

$userId = Sessions::getUserId();
if (!$userId) {
    // Redirect naar de login pagina als er nog niet ingelogd is
    header("Location: index.php");
    exit;
}
$gebruiker = new Gebruiker();
$userRole = $gebruiker->getUserRole($userId);
if ($userRole !== 'employee') {
    // Redirect naar login als je niet een employee bent
    header("Location: index.php");
    exit;
}

$sets = sets::FindAll();
foreach ($sets as $set){
echo "<tr>";
echo "<td>" . $set->id . "</td>";
echo "<td>" . $set->name . "</td>";
echo "<td>" . $set->description . "</td>";
echo "<td>" . $set->brandid . "</td>";
echo "<td>" . $set->themeid . "</td>";
echo "<td>" . $set->price . "</td>";
echo "<td>" . $set->image . "</td>";
echo "<td>" . $set->age   .  "</td>";
echo "<td>" . $set->pieces . "</td>";
echo "<td>" . $set->stock . "</td>";

echo "</tr>";


}

?>

<div class="container">
<link rel="stylesheet" href="style.css">
    <h1>Employee pagina</h1>
    <p>what the sigma</p>
  
</div>
