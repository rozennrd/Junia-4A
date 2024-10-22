<?php if ($page == "index.php") { $name = "Croupi'eirb";}
      elseif ($page == "blackjack.php") {$name = 'Blackjack';}
      elseif ($page == "poker.php") {$name = 'Poker';}
      elseif ($page == "about.php") {$name = 'About';}
      elseif ($page == "connect.php") {$name = 'Login';}
      elseif ($page == "register.php") {$name = 'Register';}
      elseif ($page == "member.php") {$name = 'Member space';}
      elseif ($page == "forgotpassword.php") {$name = 'Forgot password';}
      elseif ($page == "changepassword.php") {$name = 'Change password';}
      elseif ($page == "confirmdelete.php") {$name = 'Confirm deleting';}
      elseif ($page == "nowhere.php") {$name = 'Erreur';}
?>


<head>
  <title><?php echo $name ?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link rel="icon" href="img/icon.png" type="image/png">
</head>
