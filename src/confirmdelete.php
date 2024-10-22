<!DOCTYPE html>

<?php
session_start();
include_once 'user.php';

if (!isset($_SESSION['login'])){
  header('Location: nowhere.php');
}

$currentadmin = $_SESSION['login'];
$admin = User::isAdmin($currentadmin);

if ($admin!=true){
  header('Location: nowhere.php');
}

if (isset($_GET["userid"])){
  $userid = $_GET["userid"];
  $user = User::findById($userid);
  $login = $user->getAttr("login");
  }else {
      header('Location: nowhere.php');
  }


if(isset($_POST['yes']) && $_POST['yes'] == 'Yes') {
  $_SESSION['login']= $login;
  unset($_SESSION['login']);
  $user = User::findByLogin($login);
  $del = $user->delete();
  $log = 'The user has been deleted.<br>';
  $_SESSION['login']= $currentadmin;
  header("Refresh: 2; url=member.php");

}else if(isset($_POST['no']) && $_POST['no'] == 'No') {
  header("Location: member.php");
}

?>

<html>
  <?php $page = basename(__FILE__);
        $name = '';
        include ('head.php');
  ?>
  <body>

    <?php include ('header.php') ?>
    <!-- title -->
    <h1 class="big-title centered"><?php echo $name ?></h1>

    <h3 class="centered">Would you really like to delete user "<?php echo $login ?>" ?</h3>

    <div class="formulaire">
      <div class="jumbotron row centered shadow rounded">
        <form action=<?php echo '"confirmdelete.php?userid='.$userid.'"' ?> method="post">
            <input class="bouton" type="submit" name="yes" value="Yes"/>
            <input class="bouton" type="submit" name="no" value="No"/>
            <br>
          <?php
            if (isset($log))
              echo '<div class="message">' . $log . '</div><br><br>';
            ?>
        </form>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.min.js"></script>
  </body>
</html>