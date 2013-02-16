<?php 
/**
 * Classe représentant un mode pour un donjon
 * @author JFEU
 */
class ModeDonjon
{
	var $id;
	var $nom;
	var $indicDown;
	
	/**
	 * Constructeur
	 * @param $idIn l'identifiant technique du mode
	 * @param $nomIn le nom du mode
	 * @param $indicDownIn indicateur de réalisation du mode
	 */
	function ModeDonjon($idIn, $nomIn, $indicDownIn)
	{
		$this->id = $idIn;
		$this->nom = $nomIn;
		$this->indicDown = $indicDownIn;
	}
	
	/**
	 * Fonction qui permet d'enregistrer le mode du donjon
	 * @param $idDonjonIn le donjon auquel le mode est rattaché
	 */
	function save($idDonjonIn) {
		$connection = connectMySql();
		
		$reqSaveModeDonjon ="INSERT INTO modedonjon (id, nom, indicDown, idDonjon) VALUES (".$this->id.", ".$this->nom.", ".$this->indicDown.", ".$idDonjonIn.") 
				ON DUPLICATE KEY UPDATE nom=".$this->nom.", indicDown=".$this->indicDown ;
		
		mysql_query($reqSaveModeDonjon) or die("<div class='erreur'>[MySql] Erreur : ".htmlentities(mysql_error())."<br/><i>".$req."</i></div>");
		
		closeConnectMySql($connection);
	}
}
?>