<?php
session_start();
//Si un utilisateur non connecté essaye d'accéder à cette partie
//on le redirige immédiatemment vers la page de connexion
if (!isset($_SESSION['login'])){
	header('Location: connect.php');
}
include_once "user.php";

$admin = User::isAdmin($_SESSION['login']);

?>

<html>
  <?php
    $page = basename(__FILE__);
    $name = '';
    include ('head.php');
  ?>
  <body>

    <?php include ('header.php') ?>
    <!-- title -->
    <h1 class="big-title centered"><?php echo $name ?></h1>

    <div class="container">
      <h3 class="centered">Welcome <?php if ($admin == true){echo 'Admin '.$_SESSION['login'];} else{echo $_SESSION['login'];} ?> !</h3>
      <br>
      <div class="jumbotron row centered shadow rounded">
        <div class="col">
          <a class="bouton" href="index.php">Home</a>
        </div>
        <div class="col">
          <a class="bouton" href="changepassword.php">Change password</a>
        </div>
        <div class="col">
          <a class="bouton" href="disconnect.php">Disconnect</a>
        </div>
      </div>
    </div>

    <br><br><br><br>
    <?php if ($admin==true) include ('admin.php') ?>
  </body>
</html>
