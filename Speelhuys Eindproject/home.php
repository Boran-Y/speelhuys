<?php

include "classes/sets.php";
include "classes/database.php";
include "classes/gebruiker.php";
include "classes/sessie.php";

$sets_per_page = 6;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $sets_per_page;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$theme = isset($_GET['theme']) ? $_GET['theme'] : '';

$brands = Set::getAllBrands();
$themes = Set::getAllThemes();

$sets = Set::findAllHome($offset, $sets_per_page, $search, $brand, $theme);

$total_sets = Set::countAll($search, $brand, $theme);
$total_pages = ceil($total_sets / $sets_per_page);

if (isset($_GET["message"])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $_GET["message"]; ?>
    </div>
<?php
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Welkom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styling/homestyle.css">
</head>

<body class="backgroundHome" background="ahmadmainchanel.jpg">

    <a class="homeButton" href="home.php">
        <img class="imageHome" src="speelhuys.png" alt="Home">
    </a>

    <div class="loginKnop">
        <button class="login" onclick="window.location.href = 'admin/index.php';">Log in</button><br>
    </div>

    <div class="search-container">
        <form method="GET" action="home.php">
            <div class="input-group mb-3">
                <input type="text" class="search-input form-control" name="search" placeholder="Zoek sets..." value="<?= htmlspecialchars($search); ?>">
                <button class="search-button btn btn-primary" type="submit">Zoeken</button>
            </div>

            <div class="filter-container d-flex justify-content-between">
                <div class="filter-item">
                    <select name="brand" class="form-select">
                        <option value="">Alle merken</option>
                        <?php foreach ($brands as $brandOption) { ?>
                            <option value="<?= $brandOption['id']; ?>" <?= ($brand == $brandOption['id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($brandOption['name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="filter-item">
                    <select name="theme" class="form-select">
                        <option value="">Alle thema's</option>
                        <?php foreach ($themes as $themeOption) { ?>
                            <option value="<?= $themeOption['id']; ?>" <?= ($theme == $themeOption['id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($themeOption['name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="centerSet">
        <div class="setDesign">
            <?php if (!empty($sets)) { ?>
                <?php foreach ($sets as $set) { ?>
                    <div class="sets">
                        <a href="detail.php?id=<?= $set->id; ?>">
                            <img class="image" src="upload/<?= $set->image; ?>" alt="<?= $set->name; ?>">
                        </a>
                        <div class="productTitel">
                            <a class="product" href="detail.php?id=<?= $set->id; ?>">
                                <p><?= $set->name; ?><br></p>
                            </a>
                        </div>
                        <p class="prijs">€<?= $set->price; ?></p>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Geen resultaten gevonden.</p>
            <?php } ?>
        </div>
    </div>

    <div class="paginering-container">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1; ?>&search=<?= urlencode($search); ?>&brand=<?= urlencode($brand); ?>&theme=<?= urlencode($theme); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>&search=<?= urlencode($search); ?>&brand=<?= urlencode($brand); ?>&theme=<?= urlencode($theme); ?>"><?= $i; ?></a>
                    </li>
                <?php } ?>

                <?php if ($page < $total_pages) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1; ?>&search=<?= urlencode($search); ?>&brand=<?= urlencode($brand); ?>&theme=<?= urlencode($theme); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

</body>

</html>