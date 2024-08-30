<?php
include_once "database.php";
include_once "gebruiker.php";
include_once "sessie.php";

Sessie::start(); // Zorgt ervoor dat een sessie gestart word

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];
    $wachtwoord = $_POST['wachtwoord'];

    $gebruiker = new Gebruiker();
    $userId = $gebruiker->validateLogin($naam, $wachtwoord);

    if ($userId) {
        Sessie::setUserId($userId);  // Zet de user ID in de sessie
        $userRole = $gebruiker->getUserRole($userId);
        
        if ($userRole === 'admin') {
            header("Location: admin_overview.php");  // Redirect naar admin pagina
        } elseif ($userRole === 'employee') {
            header("Location: employee_overview.php");  // Redirect naar employee pagina
        } else {
            header("Location: index.php"); // Standaard  redirect
        }
        exit;
    } else {
        $error = "Ongeldige naam of wachtwoord!";
    }
}
?>

<div class="container">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label for="naam">Naam</label>
            <input type="text" class="form-control" id="naam" name="naam" required>
        </div>
        <div class="form-group">
            <label for="wachtwoord">Wachtwoord</label>
            <input type="wachtwoord" class="form-control" id="wachtwoord" name="wachtwoord" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
