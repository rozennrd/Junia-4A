<?php
include_once "user.php";
session_start();

if (!empty($_SESSION['login'])){
	$log = 'You are already connected.<br>';
	header("Refresh: 2, url=index.php");
}
if (isset($_POST['submit']) && $_POST['submit'] == 'Submit'){
	if (isset($_POST['mail']) && !empty($_POST['mail'])){
		if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}.[a-z]{2,4}$#", $_POST['mail'])){
			$log = 'invalid mail address.<br>';
		}else{
			$mail = htmlentities($_POST['mail']);
			$user = User::findByMail($mail);
			$userid = $user->getAttr("userid");
			//Si l'utilisateur n'existe pas
			if($user==false){
				$log = "This user does not exist.<br>";
			}else{
				//Tout va bien
				$link = User::sendMail($userid, $mail); // test en local
				//$issent = User::sendMail($userid, $mail); // test en vrai
				//if($issent!=false){ // test en vrai
					$log = 'E-mail sent ! <br>';
					$log .= '<a href="'.$link.'">'.$link.'</a> <br>'; // test en local
					$log .= 'redirecting... <br>';
					//On le redirige vers l'accueil

					header("Refresh: 2; url=connect.php");
				//}else{
				//	$log = 'Password update failed.<br>'; // test en vrai
				//}
			}
		}
	}else{
	$log = 'Mail is empty.<br>';
	}
}else if(isset($_POST['home']) && $_POST['home'] == 'Home') {
	header("Location: index.php");
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
				<form action="forgotpassword.php" method="post">
					<span class="label">Mail         </span>
					<input class="champ" type="text" name="mail" maxlength="50" value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail']))?>"/><br><br>
					<?php
					if (isset($log))
						echo '<div class="message">' . $log . '</div><br><br>';
					?>
					<input class="bouton" type="submit" name="submit" value="Submit" />
					<br><br>
					<input class="bouton" type="submit" name="home" value="Home" />
				</form>
			</div>
		</div>
		<script type="text/javascript" src="js/jquery.min.js"></script>
	</body>
</html>