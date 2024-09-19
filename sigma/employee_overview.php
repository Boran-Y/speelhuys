<?php
include "database.php";
include "sessie.php";
include "gebruiker.php";
include "sets.php";

$database = new database();
$database->start();

Sessions::start();

// sorteren
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'set_id_asc';
$order_by = 'set_id ASC';

switch ($sort) {
    case 'set_id_asc':
        $order_by = 'set_id ASC';
        break;
    case 'set_id_desc':
        $order_by = 'set_id DESC';
        break;
    case 'set_name_asc':
        $order_by = 'set_name ASC';
        break;
    case 'set_name_desc':
        $order_by = 'set_name DESC';
        break;
    case 'set_price_asc':
        $order_by = 'set_price ASC';
        break;
    case 'set_price_desc':
        $order_by = 'set_price DESC';
        break;
}

// merk filter
$brand_filter = isset($_GET['brand']) ? $_GET['brand'] : '';
$conditions = [];
if ($brand_filter) {
    $conditions[] = "set_brand_id = '" . $database->connection->real_escape_string($brand_filter) . "'";
}

$sql_sets = "SELECT * FROM `sets`";
if (count($conditions) > 0) {
    $sql_sets .= " WHERE " . implode(' AND ', $conditions);
}
$sql_sets .= " ORDER BY $order_by";

$sets = $database->connection->query($sql_sets);

$brands_query = "SELECT DISTINCT set_brand_id FROM `sets`";
$brands_result = $database->connection->query($brands_query);
$brands = [];
while ($row = $brands_result->fetch_assoc()) {
    $brands[] = $row['set_brand_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Pagina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Employee Pagina</h1>
    <form method="get" action="">
        <label for="sort">Sorteer bij:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="set_id_asc" <?php echo ($sort == 'set_id_asc' ? 'selected' : ''); ?>>ID laag naar hoog</option>
            <option value="set_id_desc" <?php echo ($sort == 'set_id_desc' ? 'selected' : ''); ?>>ID hoog naar laag</option>
            <option value="set_name_asc" <?php echo ($sort == 'set_name_asc' ? 'selected' : ''); ?>>Namen A-Z</option>
            <option value="set_name_desc" <?php echo ($sort == 'set_name_desc' ? 'selected' : ''); ?>>Namen Z-A</option>
            <option value="set_price_asc" <?php echo ($sort == 'set_price_asc' ? 'selected' : ''); ?>>Prijs laag naar hoog</option>
            <option value="set_price_desc" <?php echo ($sort == 'set_price_desc' ? 'selected' : ''); ?>>Price hoog naar laag</option>
        </select>

        <label for="brand">Filter bij merken:</label>
        <select name="brand" id="brand" onchange="this.form.submit()">
            <option value="">Alle merken</option>
            <?php foreach ($brands as $b): ?>
                <option value="<?php echo $b; ?>" <?php echo ($b == $brand_filter ? 'selected' : ''); ?>><?php echo $b; ?></option>
            <?php endforeach; ?>
        </select>
    </form>

<table border="1" class="table1">
  
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

  <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <div class="container">
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">speelhuys</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">login</a>
      </li>
      <li class="nav-item dropdown">
      
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insert.php" tabindex="-1" aria-disabled="true">toevoegen papa</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

</div>
  </head>
  <body>
 
<?php

$userId = Sessions::getUserId();
if (!$userId) {
    // Redirect naar login als er niet ingelogd is
    header("Location: index.php");
    exit;
}

$gebruiker = new Gebruiker();
$userRole = $gebruiker->getUserRole($userId);
if ($userRole !== 'employee') {
    // Redirect naar login als je niet ingelogd bent als een admin
    header("Location: index.php");
    exit;
}
?>

<?php

if ($sets && $sets->num_rows > 0) {
    while ($set = $sets->fetch_object()) {
        echo "<tr>";
        echo "<td>" . $set->set_id . "</td>";
        echo "<td>" . $set->set_name . "</td>";
        echo "<td>" . $set->set_description . "</td>";
        echo "<td>" . $set->set_brand_id . "</td>";
        echo "<td>" . $set->set_theme_id . "</td>";
        echo "<td>" . $set->set_price . "</td>";
        echo "<td><img src='" . $set->set_image . "' alt='" . $set->set_name . "' width='50'></td>";
        echo "<td>" . $set->set_age . "</td>";
        echo "<td>" . $set->set_pieces . "</td>";
        echo "<td>" . $set->set_stock . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='12'>No sets found</td></tr>";
}
?>

</table>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>