<?php
include_once "database.php";
include_once "gebruiker.php";
include_once "sessie.php";

Sessions::start(); // Zorgt ervoor dat een sessie gestart word

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];
    $wachtwoord = $_POST['wachtwoord'];

    $gebruiker = new Gebruiker();
    $userId = $gebruiker->validateLogin($naam, $wachtwoord);

    if ($userId) {
        Sessions::userId($userId);  // Zet de user ID in de sessie
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
    <link rel="stylesheet" href="style.css">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <form>
        <div class="login">
           
            <form action="admin_overview.php" class="login__form" method="POST" enctype="multipart/form-data">
                <img src="6998021.png" alt="Avatar" class="avatar">
                <h1 class="login__title">Login</h1>

                <div class="login__inputs">
                    <div class="login__box">
                        <input type="username" placeholder="gebruikersnaam" name="gebruikersnaam" required class="login__input">
                        <i class="ri-mail-fill"></i>
                    </div>

                    <div class="login__box">
                        <input type="password" placeholder="wachtwoord" name="wachtwoord" required class="login__input">
                        <i class="ri-lock-2-fill"></i>
                    </div>
                </div>

                <button type="submit" value="inloggen" class="login__button">Login</button>

            </form>
        </div>
    </form>

    <?php

include 'sessie.php';
include 'gebruiker.php';

if (isset($_POST["gebruikersnaam"])) {
  $username = $_POST["gebruikersnaam"];
  $password = $_POST["wachtwoord"];

  $users  = User::findByUsernameAndPassword($username, $password);
  if (count($users) == 0) {
    echo'<script>alert("fout gevonden")</script>';
    header("location: index.php");
    exit;
  }


  $key = md5(uniqid(rand(), true));
  $session = new sessions();
  $session->sessionUserId =  $users[0]->userId;
  $session->sessionKey = $key;
  $session->sessionStart = date("Y-m-d H : i :s");
  $session->sessionEnd = date("Y-m-d H:i : s ", strtotime("+1 month"));
  $session->insert();

  setcookie("keukenprins-session", $key, strtotime("+1 month"), "/");
  header("location: admin.php");
}
?>