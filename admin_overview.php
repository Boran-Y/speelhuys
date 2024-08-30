<?php
include_once "database.php";
include_once "sessie.php";
include_once "gebruiker.php";

Sessie::start(); // Verzekerd dat de sessie gestart is

$userId = Sessie::getUserId();
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
?>

<div class="container">
    <h1>Admin pagina</h1>
    <p>augh</p>
    <img src="https://media.discordapp.net/attachments/1242489784027451443/1243566279189860403/i-put-my-balls-in-a-deep-fryer-title-text-here.gif?ex=66d27b19&is=66d12999&hm=1a5002f5a56893c57a7fad66c8ef7bc406c4fe9bc682f6efee64ccee2222c38e&=&width=800&height=440" alt="Guh??" width="900" height="540" style="vertical-align:middle">
</div>
