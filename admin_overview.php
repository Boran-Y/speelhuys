<?php
include_once "database.php";
include_once "sessie.php";
include_once "gebruiker.php";
include_once "sets.php";

Sessie::start(); // Verzekerd dat de sessie gestart is

$userId = Sessie::getUserId();
if (!$userId) {
    // Redirect naar login als er niet ingelogd is
    header("Location: index.php");
    exit;
}

$gebruiker = new Gebruiker();
$userRole = $gebruiker->getUserRole($userId);
if ($userRole !== 'admin') {
    // Redirect naar login als je niet ingelogd bent als een admin
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
        echo "<tr><td>" . $sets->getName() . "</td><td>" . $sets->getDescription() . "</td><td>" .  "$".$sets->getPrices() . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Geen sets gevonden";
}
$connectie->close();

?>

<div class="container">
    <h1>Admin pagina</h1>
    <p>augh</p>
    <img src="https://media1.tenor.com/m/HZ_mu1zU3-UAAAAd/salad.gif" alt="Guh??" width="900" height="540" style="vertical-align:middle">
</div>
