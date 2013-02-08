<?php 
if(isset($_POST['Enregistrer'])) {
//	$isValid = true;
//	$content_dir = 'photos/membres/'; // dossier où sera déplacé le fichier
//	$nomFichierTmp = $content_dir."avatar_defaut.gif";
//	if($_FILES['fichier']['tmp_name'])
//	{
//		//Gestion de l'upload de l'image
//		$tmp_file = $_FILES['fichier']['tmp_name'];
//		$nomFichierTmp = $content_dir;
//		if( !is_uploaded_file($tmp_file) )
//		{echo "<div class='erreur'>Le fichier est introuvable</div>";$isValid=false;}
//		else
//		{
//			//on vérifie maintenant l'extension
//			$type_file = $_FILES['fichier']['type'];
//			if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') )
//			{echo "<div class='erreur'>Le fichier n'est pas une image</div>";$isValid=false;}
//			else
//			{
//				$name_file = $_FILES['fichier']['name'];
//				if(strlen($name_file)>50)
//				{echo "<div class='erreur'>Le nom du fichier est trop long.</div>";$isValid=false;}
//				else
//				{
//					$nomFichierTmp = $nomFichierTmp.$name_file;
//					//on copie le fichier dans le dossier de destination
//					if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
//					{echo "<div class='erreur'>Impossible de copier le fichier dans $content_dir</div>";$isValid=false;}
//				}
//			}
//		}
}
?>

<div id="dialog-form" title="Cr&eacute;er un nouveau donjon">
<p class="validateTips">Taille de la photo : 50x50 pixels. Evitez les noms trop long.</p>
<form method='post' id="formAddDonjon" name="formAddDonjon" enctype='multipart/form-data'>
<fieldset>
<label for="name">Nom</label>
<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
<label for="image">Image</label>
<input type="hidden" name="MAX_FILE_SIZE" value="2097152">   
<input type="file" name="fichier" class="text ui-widget-content ui-corner-all"> 
</fieldset>
</form>
</div>