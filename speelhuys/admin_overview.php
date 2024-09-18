
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
    <td><strong>aanpassen</strong></td>
    <td><strong>verwijderen</strong></td>

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
include "database.php";
include "sessie.php";
include "gebruiker.php";
include "sets.php";

sessions::start(); // Verzekerd dat de sessie gestart is

$userId = Sessions::getUserId();
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
$sets = sets::FindAll();
foreach ($sets as $set){ ?>
    <tr>
    <tr>
        <td><?= $set->id; ?> </td>
        <td><?= $set->name; ?> </td>
        <td><?= $set->description; ?></td>
        <td><?= $set->brandid; ?></td>
        <td><?= $set->themeid ?></td>
        <td><?= $set->price; ?> </td>
        <td><?= $set->image; ?> </td>
        <td><?= $set->age; ?></td>  
        <td><?= $set->pieces; ?></td>
        <td><?= $set->stock ?></td>
       
        <td><a class="link-button" href="edit.php?id=<?= $set->id; ?>">aanpassen</a></td>
        <td><a class="link-button" href="delete.php?id=<?= $set->id; ?>">verwijder</a></td>
      </tr>

</tr>;

<?php
}
?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>




