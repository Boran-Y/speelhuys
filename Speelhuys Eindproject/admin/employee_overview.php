<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Pagina</title>
    <link rel="stylesheet" href="../styling/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <div class="container-fluid p-0">

            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
                <a class="navbar-brand" href="#">Speelhuys</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../home.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Login</a>
                        </li>
                        <li class="nav-item dropdown">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="insert.php" tabindex="-1" aria-disabled="true">Toevoegen</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>
</head>

<body>

    <table border="1" class="table">
        <tr>
            <th>Set ID</th>
            <th>Naam</th>
            <th>Beschrijving</th>
            <th>Merk ID</th>
            <th>Thema ID</th>
            <th>Prijs</th>
            <th>Afbeelding</th>
            <th>Leeftijd</th>
            <th>Stuks</th>
            <th>Voorraad</th>
            <th>Aanpassen</th>
        </tr>


        <?php
        include "../classes/database.php";
        include "../classes/sessie.php";
        include "../classes/gebruiker.php";
        include "../classes/sets.php";

        Sessions::start(); // verzekerd dat de sessie gestart is

        $userId = Sessions::getUserId();
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

        $sets = Set::FindAll();
        foreach ($sets as $set) { ?>
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

                <td><a class="link-button" href="edit.php?id=<?= $set->id; ?>">Aanpassen</a></td>
            </tr>

            </tr>

        <?php
        }
        ?>
    </table>
</body>

</html>