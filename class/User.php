<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/connexionMySql.php");

class User
{
	var $id;
	var $login;
	var $armeChoisie = 0;

	function User($idIn, $loginIn) {
		$this->id = $idIn;
		$this->login = $loginIn;
	}
	
	function setArmeChoisie($armeChoisieIn) {
		$this->armeChoisie = $armeChoisieIn;
	}
	
	function modifierLogin($nomUserIn) {
		$this->login = $nomUserIn;
		
		$connection = connectMySql();
		
		$reqSaveUser ="INSERT INTO user (id, login, armeChoisie) VALUES (".$this->id.", '".$this->login."', ".$this->armeChoisie.") 
		ON DUPLICATE KEY UPDATE login='".$nomUserIn."'";	
		mysql_query($reqSaveUser) or die("<div class='erreur'>[MySql] Erreur : ".htmlentities(mysql_error())."<br/><i>".$reqSaveUser."</i></div>");
		
		closeConnectMySql($connection);
	}
}

/**
 * Fonction qui récupère un utilisateur selon l'identifiant donné
 * @param int $idUser
 * @return User|NULL
 */
function getUser($idUser) {
	$connection = connectMySql();
	
	$sql = 'SELECT count(*),u.id, u.login, u.armeChoisie FROM user u WHERE u.id='.$idUser;
	$req = mysql_query($sql) or die("<div class='erreur'>Erreur SQL !<br />".$sql."<br />".mysql_error()."</div>");
	$data = mysql_fetch_array($req);
	mysql_free_result($req);
	
	closeConnectMySql($connection);
	
	if ($data[0] == 1) {
		$user = new User($data[1],$data[2]);
		$user->setArmeChoisie($data[3]);
		return $user;	
	} else {
		return null;
	}
}

?>