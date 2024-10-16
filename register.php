<?php
include_once "user.php";
session_start();
//Si l'utilisateur est déjà connecté on l'amène sur son espace membre
if (!empty($_SESSION['login'])){
	$log = 'You are already connected.<br>';
	header("Refresh: 1, url=member.php");
}
//Si tout est bon
if (isset($_POST['register']) && $_POST['register'] == 'Register'){
	if( (isset($_POST['login']) && !empty($_POST['login']))
		&& (isset($_POST['password']) && !empty($_POST['password']))
		&& (isset($_POST['password_c']) && !empty($_POST['password_c']))
		&& (isset($_POST['mail']) && !empty($_POST['mail']))){
		//on vérifie le mail
		if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}.[a-z]{2,4}$#", $_POST['mail'])){
			$log = 'invalid mail address.<br>';
		}
		//Les mots de passe
		elseif($_POST['password'] != $_POST['password_c']){
			$log = '<both words are not equivalent.<br>';
		}else{
			//On vérifie que ni le pseudo ni le mail n'est déjà dans notre base de données
			$login = htmlentities($_POST['login']);
			$user = User::findByLogin($login);
			$mail = User::findByMail($_POST['mail']);
			if($user!=false){
				$log = 'User already registered.<br>';
			}elseif($mail!=false){
				$log = 'Mail address already registered.';
			}
			else{
				//Tout va bien, on crée l'utilisateur
				$user = new User();
				$user->setAttr("login", $_POST['login']);
				$user->setAttr("password", $_POST['password']);
				$user->setAttr("mail", $_POST['mail']);
				//On l'insère dans la BDD
				try{$user->insert();}
				catch (Exception $e){
				die('Error : ' . $e->getMessage());}
				$log = 'You are registered, thanks '. $login .' ! <br>';
				$log .= 'Connecting... <br>';
				//On le redirige vers l'accueil

				$_SESSION['login'] = $_POST['login'];
				header("Refresh: 2; url=index.php");
			}
		}
	}else{
		$log = 'At least one space is empty.<br>';
	}
//S'il appuie sur le bouton accueil on l'envoie à l'accueil
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
				<form action="register.php" method="post">
	 				<span class="label"> Login     </span>
	 				<input class="champ" type="text" name="login" maxlength="20" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"/><br>
	 				<br>
					<span class="label">Password </span>
					<input class="champ" type="password" name="password" maxlength="20" value="<?php if (isset($_POST['password'])) echo htmlentities(trim($_POST['password']))?>"/><br>
					<br>
					<span class="label">Confirm   </span>
					<input class="champ" type="password" name="password_c" maxlength="20" value="<?php if (isset($_POST['password_c'])) echo htmlentities(trim($_POST['password_c']))?>"/><br><br>
					<span class="label">Mail         </span>
					<input class="champ" type="text" name="mail" maxlength="50" value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail']))?>"/><br>
					<br><br>
					<?php
					if (isset($log))
						echo '<div class="message">' . $log . '</div><br><br>';
					?>
					<input class="bouton" type="submit" name="register" value="Register" />
					<br><br>
					<input class="bouton" type="submit" name="home" value="Home" />
				</form>
			</div>
		</div>
		<script type="text/javascript" src="js/jquery.min.js"></script>
	</body>
</html>
