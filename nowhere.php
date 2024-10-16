<!DOCTYPE html>

<?php
session_start();
include_once 'base.php';
header("Refresh: 3; url=index.php");
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

    <div class="container">
      <h3 class="centered">This page does not exist, redirecting...</h3>
      <br>
    </div>

    <script type="text/javascript" src="js/jquery.min.js"></script>
  </body>
</html>