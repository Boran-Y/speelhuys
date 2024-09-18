<?php

include "classes/sets.php";
include "classes/database.php";
include "classes/gebruiker.php";
include "classes/sessie.php";

$sets_per_page = 6;

// Bepaal de huidige pagina
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $sets_per_page;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sets = Sets::findAll($offset, $sets_per_page, $search);

$total_sets = Sets::countAll($search);
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
    <link rel="stylesheet" href="style/homestyle.css">
</head>

<body class="backgroundHome" background="SpeelhuysAchtergrond.jpg">

    
        <a class="homeButton" href="home.php">
            <img class="imageHome" src="speelhuys.png" alt="Home">
        </a>

    <div class="loginKnop">
        <button class="login" onclick="window.location.href = 'admin/index.php';">Log in</button><br>
    </div>

    <div class="search-container">
        <form method="GET" action="home.php">
            <div class="input-group">
                <input type="text" class="search-input" name="search" placeholder="Zoek sets..." value="<?= htmlspecialchars($search); ?>">
                <button class="search-button" type="submit">Zoeken</button>
            </div>
        </form>
    </div>

    <div class="centerBlog">
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
                        <a class="page-link" href="?page=<?= $page - 1; ?>&search=<?= urlencode($search); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>&search=<?= urlencode($search); ?>"><?= $i; ?></a>
                    </li>
                <?php } ?>

                <?php if ($page < $total_pages) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1; ?>&search=<?= urlencode($search); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    </div>
</body>

</html>