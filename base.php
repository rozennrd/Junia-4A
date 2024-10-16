<?php
 /*
  * Permet d'établir la connection
  * avec la base de données
  */
include_once 'param.php';
class Base{
	private static $connection;
	/* Permet d'obtenir une connection à la base
	 * (Les paramètres de connections sont stockés dans un fichier)
	 */
	public static function getConnection(){
		if (isset(self::$connection)) {
			return self::$connection;
		}else{
			self::$connection = self::connect();
			return self::$connection;
		}
	}
	public static function connect(){
		global $host, $user, $pass, $base;
		try{
			$dns = "mysql:host=$host;dbname=$base";
			$connection = new PDO($dns, $user, $pass,
					array(PDO::ERRMODE_EXCEPTION=>true,
					PDO::ATTR_PERSISTENT=>true));
			$connection->exec("SET CHARACTER SET utf8");
			return($connection);
		}catch (Exception $e){
			die('Error : ' . $e->getMessage());
		}

	}
}
?>
