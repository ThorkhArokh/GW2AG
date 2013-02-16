<?php 
	include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/session.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/connexionMySql.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/User.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/constantes.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/session.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/gw2AG/class/Donjon.php");
	
	//On démarre la session
	session_start();
	
	//On récupère l'identifiant de l'utilisateur
    getSession();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Guild Wars 2 - Avanc&eacute;e Guilde</title>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="css/commun.css"/>
		<link rel="stylesheet" type="text/css" href="css/gw2ag.css" />
		<link rel="stylesheet" type="text/css" href="css/checkbox-radio.css"/>
	</head>
	<body>
    	<div id="wrapper">
    		<?php 
    			$listeDonjons = getDonjons();
    			$i = 0;
    			foreach($listeDonjons as $donjon) {
    				echo "<section id='section".$i."'>";
    				echo "<div id='general".$i."' onclick=\"showHide('.details".$i."');\">";
    				echo "<div class='donjonImg'>";
    				echo "<img src=\"images/icons/".$donjon->img."\" />";
    				echo "</div>";
    				echo "<div class='titre'>";
    				echo "<div>".htmlentities($donjon->nom)."</div>";
    				echo "<progress value='".$donjon->progression."' max='100'></progress>";
    				echo "</div>";
    				echo "</div>";
    				if(count($donjon->modesLst) > 0) {
	    				echo "<div class='details".$i."'>";
	    				echo "<ul class='choices-border'>";
	    				$j=0;
	    				foreach($donjon->modesLst as $mode) {
	    					$check = "";
	    					if($mode->indicDown) {
	    						$check = "checked";
	    					}
	    					echo "<li><input type='checkbox' name='check-".$j."' id='check-".$j."' ".$check." onclick='saveAvanceeMode(this, ".$donjon->id.", ".$mode->id.");'/><label for='check-".$j."'>".htmlentities($mode->nom)."</label></li>";
	    					$j++;
	    				}
	    				echo "</ul>";
	    				echo "</div>";
    				}
    				echo "</section>";
    				echo "<div class='spacer'></div>";
    				$i++;
    			}
    		?>
    		<div class="spacer"></div>
    		<section class="copyright">
    			<?php echo "<span>GW2AG &copy; 2013 - Version ".$GLOBALS['VERSION']."</span>"; ?>
    		</section>
        </div>
        <!-- APPELS JS -->
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
		<script type="text/javascript" src="js/gw2ag.js"></script>
	</body>
</html>