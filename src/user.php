<?php
include_once 'base.php';

class User{
	private $userid;
	private $login;
	private $password;///haché, salé, rehaché (sha1)
	private $mail;
	private $chmod; //1 si admin, 0 sinon
	public function __toString(){
		return "[".__CLASS__ . "] <br>
			userid : ". $this->userid . "<br>
			login : ". $this->getAttr("login") ."<br>
			password : ". $this->getAttr("password") ."<br>
			mail : ". $this->getAttr("mail") . "<br>
			admin : ". $this->getAttr("chmod");
	}

	public function getAttr($attr_name){
		if(property_exists(__CLASS__, $attr_name)){
			return $this->$attr_name;
		}
		$emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
		throw new Exception($emess, 45);
	}

	public function setAttr($attr_name, $attr_val){
		if(property_exists(__CLASS__, $attr_name)){
			$this->$attr_name=$attr_val;
			return $this->$attr_name;
		}
		$emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
		throw new Exception($emess, 45);
	}

	public function update(){
		if(!isset($this->userid)){
			throw new Exception(__CLASS__ . ":Primary key not defined, cant update");
		}
		$c = Base::getConnection();
		$salt = $this->getAttr("login");
		$this->password = sha1(sha1($this->password).$salt);
		$query = $c->prepare("update users set login= ?,
					password= ?, email= ?, chmod= ?
					where userid= ?");
		$query->bindParam (1, $this->login, PDO::PARAM_STR);
		$query->bindParam (2, $this->password, PDO::PARAM_STR);
		$query->bindParam (3, $this->email, PDO::PARAM_STR);
		$query->bindParam (4, $this->chmod, PDO::PARAM_STR);
		$query->bindParam (5, $this->userid, PDO::PARAM_STR);
		return $query->execute();
	}

	public function delete(){
		$nb = 0;
		if(isset($this->userid)){
			$query = "DELETE FROM users Where userid =".$this->userid;
			$c = Base::getConnection();
			$nb = $c->exec($query);
		}
		return $nb;
	}

	public function insert(){
		$nb = 0;
		$c = Base::getConnection();
		$query = "SELECT max(userid) FROM users";
		$data = $c->query($query);
		$data = $data->fetch();
		$id = $data['max(userid)'] + 1;
		$salt = $id;
		$this->setAttr("chmod", 0);
		$query = "INSERT INTO users VALUES(".$id.", '".$this->login."','".sha1(sha1($this->password).$salt)."', '".$this->mail."', '".$this->chmod."')";
		$nb = $c->exec($query);
		$this->setAttr("userid", $c->LastInsertId());
		return $nb;
	}


	public static function sendMail($userid, $mail){
		$c = Base::getConnection();
		$token = sha1(random_int(0, 9999999999)); // test en local
		//$token = sha1(rand(0, 9999999999)); //test en vrai
		$shatoken = sha1($token);
		$query = 'UPDATE users SET chmod = :shatoken WHERE mail = :mail';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':shatoken', $shatoken);
		$dbres->bindParam(':mail', $mail);
		$dbres->execute();
		$link = "http://localhost/Projet/changepassword.php?token=".$token."&userid=".$userid; // test en local
		//$link = "https://qdeclercq.vvvpedago.enseirb-matmeca.fr/Projet/changepassword.php?token=".$token."&userid=".$userid; // test en vrai
		$to = $mail; //connect with pdo to retrieve user email
		$subject = "Your Password";
		$message = "Hello, you forgot your password, so here is a temporary link to change your password : \r\n".$link." \r\n";
		$headers = "From: croupieirb@enseirb-matmeca.fr" . "\r\n" .
					"X-Mailer: PHP/" . phpversion();

		//$send->mail($to, $subject, $message, $headers); // test en vrai
		//return $send; // test en vrai
		return $link; // test en local
	}

	public static function verifyToken($userid, $chmod){
		$c = Base::getConnection();
		$query = 'SELECT userid, chmod FROM users WHERE userid = :userid';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':userid', $userid);
		$dbres->execute();
		$d = $dbres->fetch(PDO::FETCH_OBJ);
		if($d == false) return false;
		$token = $d->chmod;
		if (sha1($chmod) == $token){ 
			return true;
		}
		else{return false;}
	}

	public static function changePassword($userid, $password){
		$salt = $userid;
		$password = sha1(sha1($password).$salt);
		$c = Base::getConnection();
		$query = 'UPDATE users SET password = :password WHERE userid = :userid';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':userid', $userid);
		$dbres->bindParam(':password', $password);
		$dbres->execute();
		return true;
	}

	public static function raZ($userid){
		$c = Base::getConnection();
		$query = "UPDATE users SET chmod = '0' WHERE userid = '".$userid."'";
		$raz = $c->exec($query);
		return true;
	}

	public static function findAll(){
		$query = "select * from users";
		$c = Base::getConnection();
		$dbres = $c->prepare($query);
		$dbres->execute();
		$d = $dbres->fetchAll();
		$tab = Array();
		foreach ($d as $ligne) {
			$user = new User();
			$user->setAttr("userid", $ligne["userid"]);
			$user->setAttr("login", $ligne["login"]);
			$user->setAttr("password", $ligne["password"]);
			$user->setAttr("mail", $ligne["mail"]);
			$user->setAttr("chmod", $ligne["chmod"]);
			array_push($tab, $user);
		}
		return $tab;
	}

	public static function findById($userid){
		$c = Base::getConnection();
		$query = 'select * from users where userid= :userid';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':userid', $userid);
		$dbres->execute();
		//$user = false;
		$d = $dbres->fetch(PDO::FETCH_OBJ);
		if($d == false) return false;
		$user = new User();
		$user->setAttr("userid", $userid);
		$user->setAttr("login", $d->login);
		$user->setAttr("password", $d->password);
		$user->setAttr("mail", $d->mail);
		$user->setAttr("chmod", $d->chmod);
		return $user;
	}

	public static function findByLogin($login) {
		$c = Base::getConnection();
		$query = 'select * from users where login= :login';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':login', $login);
		$dbres->execute();
		//$user = false;
		$d = $dbres->fetch(PDO::FETCH_OBJ);
		if($d == false) return false;
		$user = new User();
		$user->setAttr("login", $login);
		$user->setAttr("userid", $d->userid);
		$user->setAttr("password", $d->password);
		$user->setAttr("mail", $d->mail);
		$user->setAttr("chmod", $d->chmod);
		return $user;
	}

	public static function findByMail($mail) {
		$c = Base::getConnection();
		$query = 'select * from users where mail= :mail';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':mail', $mail);
		$dbres->execute();
		$user = false;
		$d = $dbres->fetch(PDO::FETCH_OBJ);
		if($d != false){
			$user = new User();
			$user->setAttr("login", $d->login);
			$user->setAttr("userid", $d->userid);
			$user->setAttr("password", $d->password);
			$user->setAttr("mail", $d->mail);
			$user->setAttr("chmod", $d->chmod);
		}
		return $user;
	}

	public static function getNbUser(){
		$query = "select count(*) as nb from users";
		$c = Base::getConnection();
		$res = $c->query($query);
		$data = $res->fetch();
		$nb = $data['nb'];
		return $nb;
	}

	public static function isAdmin($login){
		$current = self::findByLogin($login);
		$admin = $current->getAttr("chmod");
		if($admin==1) $res = true;
		else $res = false;
		return $res;
	}

	public static function displayUsers(){
		$query = "select * from users";
		$c = Base::getConnection();
		$dbres = $c->query($query);
		return $dbres;
	}
	
}
?>
