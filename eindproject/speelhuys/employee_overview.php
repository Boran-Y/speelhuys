<?php
include_once "database.php";
include_once "sessie.php";
include_once "gebruiker.php";
include_once "sets.php";

Sessions::findActiveSessions(); // verzekerd dat de sessie gestart is

$userId = Sessions::$userRole();
if (!$userId) {
    // Redirect naar de login pagina als er nog niet ingelogd is
    header("Location: index.php");
    exit;
}

$gebruiker = new Gebruiker();
$userRole = $gebruiker->$UserRole($userId);
if ($userRole !== 'employee') {
    // Redirect naar login als je niet een employee bent
    header("Location: index.php");
    exit;
}

$sql_sets = "SELECT * FROM `sets`";
$result_speelhuys = $connectie->query($sql_sets);

echo "<center><h2>sets</h2></center>";
if ($result_speelhuys->num_rows > 0) {
    echo "<table border='1'><tr><th>item name</th><th>description</th><th>prices</th></tr>";
    while($row = $result_speelhuys->fetch_assoc()) {
        $sets = new sets($row["set_name"], $row["set_description"], $row["set_price"]);
        echo "<tr><td>" . $sets->getName() . "</td><td>" . $sets->getDescription() . "</td><td>" .  "$".$sets->getPrice() . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Geen sets gevonden";
}
$connectie->close();

?>

<div class="container">
    <h1>Employee pagina</h1>
    <p>what the sigma</p>
    <iframe width="1280" height="720" src="https://www.youtube.com/embed/5_tldtA2IzI?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
