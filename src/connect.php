<?php
include_once "user.php";
session_start();
if (!empty($_SESSION['login'])){
	$log = 'You are already connected.<br>';
	header("Refresh: 1, url=index.php");
}
//Si on a bien envoyé le formulaire et que tout est rempli
if (isset($_POST['log']) && $_POST['log'] == 'Log in'){
	if (isset($_POST['login']) && !empty($_POST['login'])
		&& (isset($_POST['pass']) && !empty($_POST['pass']))){
		$login = htmlentities($_POST['login']);
		$user = User::findByLogin($login);
		//Si l'utilisateur n'existe pas
		if($user==false){
			$log = "This user does not exist.<br>";
		}else{
			$pw = $user->getAttr("password");
			$salt = $user->getAttr("userid");
			if($pw != sha1(sha1($_POST['pass']).$salt)){
				$log = 'Wrong password.<br>';
			}else{
				//Sinon tout est bon, on le connecte et on le redirige vers l'accueil
				$log = 'Connecting...<br>';
				$_SESSION['login'] = $_POST['login'];
				header("Refresh: 1; url=index.php");
			}
		}
	}else{
		$log = 'At least one space is empty.<br>';
	}
}else if(isset($_POST['home']) && $_POST['home'] == 'Home') {
	header("Location: index.php");
}else if(isset($_POST['register']) && $_POST['register'] == 'Not registered ?') {
	header("Location: register.php");
}else if(isset($_POST['password']) && $_POST['password'] == 'Forgot password ?') {
	header("Location: forgotpassword.php");
}
?>


<!-- Code html du formulaire-->
<html>
  <?php $page = basename(__FILE__);
        $name = '';
        include ('head.php');
  ?>
  <body>

    <?php include ('header.php') ?>
    <!-- title -->
    <h1 class="big-title centered"><?php echo $name ?></h1>

    <div class="formulaire">
    	<div class="jumbotron row centered shadow rounded">
			<form action="connect.php" method="post">
				<span class="label"> Login     </span>
	 			<input class="champ" type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"/><br><br>
				<span class="label">Password </span>
				<input class="champ" type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass']))?>"/><br><br>
				<br>
				<?php
				if (isset($log))
					echo '<div class="message">' . $log . '</div><br><br>';
				?>
				<input class="bouton" type="submit" name="log" value="Log in" />
				<br>
				<input class="bouton" type="submit" name="register" value="Not registered ?" />
				<input class="bouton" type="submit" name="password" value="Forgot password ?" />
				<br><br>
				<input class="bouton" type="submit" name="home" value="Home" />
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	</body>
</html>