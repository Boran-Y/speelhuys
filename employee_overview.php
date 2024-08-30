<?php
include_once "database.php";
include_once "sessie.php";
include_once "gebruiker.php";

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
?>

<div class="container">
    <h1>Employee pagina</h1>
    <p>what the sigma</p>
    <img src="https://media1.tenor.com/m/usq5pdrpMjoAAAAC/could-you-repeat-that.gif" alt="Guh??" width="900" height="540" style="vertical-align:middle">
</div>
