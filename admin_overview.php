<?php
include_once "database.php"; // Make sure this file contains your database connection setup
include_once "sessie.php";   // Make sure this file contains your session management setup
include_once "gebruiker.php"; // Make sure this file contains user role management setup
include_once "sets.php";     // Make sure this file contains your Sets class definition

Sessie::start(); // Ensure the session is started

$userId = Sessie::getUserId();
if (!$userId) {
    // Redirect to login if not logged in
    header("Location: index.php");
    exit;
}

$gebruiker = new Gebruiker();
$userRole = $gebruiker->getUserRole($userId);
if ($userRole !== 'admin') {
    // Redirect to login if the user is not an admin
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
    <h1>Admin Page</h1>
    <p>augh</p>
    <img src="https://media1.tenor.com/m/HZ_mu1zU3-UAAAAd/salad.gif" alt="Guh??" width="900" height="540" style="vertical-align:middle">
</div>

</body>
</html>
