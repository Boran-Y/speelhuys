<?php
include_once "database.php";
include_once "sessie.php";
include_once "gebruiker.php";
include_once "sets.php";

Sessie::start(); // verzekerd dat de sessie gestart is

$userId = Sessie::getUserId();
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

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_asc';
$order_by = 'set_id ASC';

if ($sort == 'id_asc') {
    $order_by = 'set_id ASC';
} elseif ($sort == 'price_asc') {
    $order_by = 'set_price ASC';
} elseif ($sort == 'price_desc') {
    $order_by = 'set_price DESC';
} elseif ($sort == 'name_asc') {
    $order_by = 'set_name ASC';
} elseif ($sort == 'name_desc') {
    $order_by = 'set_name DESC';
}

$sql_sets = "SELECT * FROM `sets` ORDER BY $order_by";
$result_speelhuys = $connectie->query($sql_sets);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>

<center>
    <h2>Sets</h2>
</center>

<form method="get" action="">
    <label for="sort">Sort by:</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
        <option value="id_asc" <?php echo ($sort == 'id_asc' ? 'selected' : ''); ?>>sorteer bij ID</option>
        <option value="price_desc" <?php echo ($sort == 'price_desc' ? 'selected' : ''); ?>>Price: High to Low</option>
        <option value="price_asc" <?php echo ($sort == 'price_asc' ? 'selected' : ''); ?>>Price: Low to High</option>
        <option value="name_asc" <?php echo ($sort == 'name_asc' ? 'selected' : ''); ?>>Naam: A-Z</option>
        <option value="name_desc" <?php echo ($sort == 'name_desc' ? 'selected' : ''); ?>>Naam: Z-A</option>
    </select>
</form>

<?php
if ($result_speelhuys->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Item Name</th><th>Description</th><th>Price</th></tr>";
    while ($row = $result_speelhuys->fetch_assoc()) {
        $sets = new Sets($row["set_id"], $row["set_name"], $row["set_description"], $row["set_price"]);
        echo "<tr><td>" . $sets->getID() . "</td><td>" . $sets->getName() . "</td><td>" . $sets->getDescription() . "</td><td>" . "$" . $sets->getPrices() . "</td></tr>";
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
