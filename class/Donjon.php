<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/connexionMySql.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/ModeDonjon.php");

/**
 * Classe représentant un donjon
 * @author JFEU
 */
class Donjon
{
	var $id;
	var $nom;
	var $img;
	var $progression;
	var $modesLst = array();
	
	/**
	 * Constructeur
	 * @param $idIn l'identifiant technique du donjon
	 * @param $nomIn le nom du donjon
	 * @param $imgIn l'image associée au donjon
	 */
	function Donjon($idIn, $nomIn, $imgIn)
	{
		$this->id = $idIn;
		$this->nom = $nomIn;
		$this->img = $imgIn;
		$this->modesLst = $this->getModes();
		$this->progression = $this->getProgression();
	}
	
	/**
	 * Function qui permet de récupérer les modes rattachés au donjon
	 * @return la liste des modes pour le donjon
	 */
	function getModes() {
		$connection = connectMySql();
		$reqSelectModes = "SELECT m.id as idMode, m.nom as nomMode, m.indicDown as indicDown FROM modeDonjon m WHERE m.idDonjon = ".$this->id;
		$resModes = mysql_query($reqSelectModes) or die("<div class='erreur'>[MySql] Erreur : ".htmlentities(mysql_error())."</div>");
	
		$listeModes = array();
		while($row =  mysql_fetch_array( $resModes )) {
			$indicDown = false;
			if($row['indicDown'] == 1) {
				$indicDown = true;
			}
			$nouveauMode = new ModeDonjon($row['idMode'], $row['nomMode'], $indicDown);
			$listeModes[] = $nouveauMode;
		}
		closeConnectMySql($connection);
		
		return $listeModes;
	}
	
	/**
	 * Méthode qui retourne la progession du donjon
	 * @return progression
	 */
	function getProgression() {
		$progress = 0;
		$res = 0;
		$nbrModes = count($this->modesLst);
		foreach($this->modesLst as $mode) {
			if($mode->indicDown) {
				$progress++;
			}
		}
		if($nbrModes > 0) {
			$res = ($progress*100)/$nbrModes;
		}
		
		return $res;
	}
	
	/**
	 * Fonction qui permet d'enregistrer le donjon
	 */
	function save() {
		$connection = connectMySql();
		
		$reqSaveDonjon ="INSERT INTO donjon (id, nom, image) VALUES (".$this->id.", ".$this->nom.", ".$this->image.") 
				ON DUPLICATE KEY UPDATE nom=".$this->nom.", image=".$this->image ;
		
		mysql_query($reqSaveDonjon) or die("<div class='erreur'>[MySql] Erreur : ".htmlentities(mysql_error())."<br/><i>".$req."</i></div>");
		
		foreach($this->modesLst as $mode) {
			$mode->save($this->id);
		}
		
		closeConnectMySql($connection);
	}
}

/**
 * Fonction qui retourne la liste des donjons
 * @return la liste des donjons
 */
function getDonjons() {
	$connection = connectMySql();
	$reqSelectModes = "SELECT d.id as idDonjon, d.nom as nomDonjon, d.image as imageDonjon FROM donjon d";
	$resModes = mysql_query($reqSelectModes) or die("<div class='erreur'>[MySql] Erreur : ".htmlentities(mysql_error())."</div>");
	
	closeConnectMySql($connection);
	
	$listeDonjon = array();
	while($row =  mysql_fetch_array( $resModes )) {
		$nouveauDonjon = new Donjon($row['idDonjon'], $row['nomDonjon'], $row['imageDonjon']);
		$listeDonjon[] = $nouveauDonjon;
	}
	
	return $listeDonjon;
}
?>