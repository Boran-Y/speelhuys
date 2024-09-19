<?php
include 'classes/sets.php';
require 'classes/Database.php';






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

}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Styled Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            color: #fff !important;
        }

        .card {
            margin-top: 50px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Speelhuys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <!-- Add additional nav items here if needed -->
                </div>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center">
        <div class="card col-md-6">
            <h3 class="text-center mb-4">Add New Product</h3>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter product description" required>
                </div>
                <div class="mb-3">
                    <label for="brandid" class="form-label">Brand ID</label>
                    <input type="text" class="form-control" id="brandid" name="brandid" placeholder="Enter brand ID" required>
                </div>
                <div class="mb-3">
                    <label for="themeid" class="form-label">Theme ID</label>
                    <input type="text" class="form-control" id="themeid" name="themeid" placeholder="Enter theme ID" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" placeholder="Enter recommended age" required>
                </div>
                <div class="mb-3">
                    <label for="pieces" class="form-label">Pieces</label>
                    <input type="text" class="form-control" id="pieces" name="pieces" placeholder="Enter number of pieces" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter available stock" required>
                </div>
                <button type="submit" name="submit" class="btn btn-custom w-100">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWtx5QxZ5DX59LsYZK7TStz5pw1K42n8O5liMZCLjGIk9BfQj9hsoE2ZckmR8PVJ" crossorigin="anonymous"></script>
</body>

</html>
