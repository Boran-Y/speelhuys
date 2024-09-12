<?php
include "gebruiker.php";
include "sessie.php";
include "database.php";


Sessions::start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['gebruikersnaam'];
    $password = $_POST['wachtwoord'];

    $gebruiker = new Gebruiker();
    $userId = $gebruiker->validateLogin($username,$password); 

    if ($userId) {
        Sessions::setuserId($userId);  // Zet de user ID in de sessie
        $userRole = $gebruiker->getuserRole($userId);

        if ($userRole == 'admin') {
            header("Location: admin_overview.php");  // Redirect naar admin pagina
        } elseif ($userRole == 'employee') {
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
        <div class="login">
           
        <form method="post">
        <div class="form-group">
        <img src="6998021.png" alt="Avatar" class="avatar">
            <div class="login__box">
                    <input type="username" placeholder="gebruikersnaam" name="gebruikersnaam" required class="login__input">
                    <i class="ri-mail-fill"></i>
                </div>
        <div class="login__box">
                    <input type="password" placeholder="wachtwoord" name="wachtwoord" required class="login__input">
                    <i class="ri-lock-2-fill"></i>
                </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
        </div>
    
    <?php


if (isset($_POST["gebruikersnaam"])) {
  $username = $_POST["gebruikersnaam"];
  $password = $_POST["wachtwoord"];

  $users  = Gebruiker::findByUsernameAndPassword($username, $password);
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

  setcookie("speelhuys-session", $key, strtotime("+1 month"), "/");
  header("location: /admin_overview.php");
}
?>
   