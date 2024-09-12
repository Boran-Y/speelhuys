<?php
include 'sets.php';

$database = new database();
$database->start();

$set = sets::find($_GET["id"]);
if ( $set == null)
{
    header("location:admin_overview.php");
}

$image = null;


if (isset($_POST["submit"])) {
    if (!empty($_FILES["bestand"]["name"])) {
        $image = $_FILES["bestand"]["name"];

        $target = "../upload/" . basename($image);

        move_uploaded_file($_FILES['bestand']['tmp_name'], $target);
    }

    $set = new sets;
    $sets->name = $_POST["name"];
    $sets->description = $_POST["description"];
    $sets->brandid = $_POST["brand_id"];
    $sets->themeid = $_POST["theme_id"];
    $sets->price = $_POST["price"];
    $sets->image = $image;
    $sets->age = $_POST["age"];
    $sets->pieces = $_POST["pieces"];
    $sets->stock = $_POST["stock"];
    $sets->insert();
    header("location: admin_overview.php?file= $image");
    exit;
    $database->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">speelhuys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                </div>
            </div>
        </div>
    </nav>
    <div class="container text-center">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label"> name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label"> description</label>
                        <input type="text" class="form-control" id="description" name="description">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">brand_id</label>
                        <input type="text" class="form-control" id="brandid" name="brandid">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label"> theme_id</label>
                        <input type="text" class="form-control" id="themeid" name="themeid">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label"> price</label>
                        <input type="text" class="form-control" id="price" name="price">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="input-group mb-3">
                    <label for="title" class="form-label"> image</label>
                        <input type="file" class="image" id="image" name="image">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label"> age</label>
                        <input type="text" class="form-control" id="age" name="age">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label"> pieces</label>
                        <input type="text" class="form-control" id="pieces" name="pieces">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label"> stock</label>
                        <input type="text" class="form-control" id="stock" name="stock">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                  
                    </div>
                    <button type="submit" name="submit" class="btns">Submit</button>

            </div>
        </div>
    </div>




</body>

</html>