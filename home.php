<?php
require_once('includes.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');
//$CPrint = new CPrint();
print('<div id="main">');
?>
<style> 
#video { border: 1px solid #000000;margin : 0;}
#canvas { border: 1px solid #000000;margin : 0;}
.btn { padding: 5px; margin: 10px;}
</style>
<?php
$Id = $_SESSION['Id'];


print "<form method='post' accept-charset='utf-8' name='form1'>";
print "<input name='hidden_data' id='hidden_data' type='hidden'/>";
print "<input name='hidden_fond' id='hidden_fond' type='hidden'/>";
//print "<input name='hidden_id' id='hidden_id' type='hidden' value='$Id'/>";
print "</form>";

print '<div id="div_video_fond">';
print('<div  id="div_video"><video id="video"  width="514px" height="386px"></video></div>');
print('<div  id="div_fond" width="514px" height="386px"><p id="div_fond_text">Choisir votre fond<p></div>');
print('<div  id="div_canvas"><canvas style="display:none" width="514px" height="386px"  id="canvas"></canvas></div>');

print '</div>'; // fin div div_video_fond
print('<div id="draw" style="display:none"><button id="btn_draw" onclick="traitement.draw(\'fond01\');">Prendre une photo</button></div>');
print('<div id="activer_camera" style="display:none"><button id="btn_cam" onclick="traitement.camera();">Revenir à la caméra</button></div>');
print '<div id="transfert" style="display:none"><input type="button" onclick="traitement.uploadEx()" value="Transférer un Fichier..." /></div>';
print('<div id="test" style="display:none"><button id="btn_test" onclick="traitement.test(\'fond01\');">test</button></div>');

$dir_fonds = "fonds";
$listfond = scandir ('fonds');
$taillefond = ' width="51px" ';
print('<div id="fonds" width="514px">');
$CPrint = new CPrint;

$compteur = 0;
foreach ( $listfond as $key => $value)
{
	if (substr($value, -4) == '.png')
	{
		if ( ++$compteur > 9 )  { print '<br />'; $compteur = 0; }
		$id = substr($value, 0, strlen($value)-4);
		
		 if ($key < 19 )print '<img onclick="traitement.changefond('."'".$id."')".'" '.$taillefond.'id="'.$id.'" class="img_fond" src="fonds/'.$value.'"> ';
	}

}

print('</div>'); // div fonds
print ('<div id="msg_fonds">');
$CPrint->content(' Choisissez votre fond avant de prendre la photo', 'content');
print ('</div>');
print('</div>'); // fin div main


// afficher les images crees sur le serveur
$dir_user = "upload/user_".$Id.'/';
if (!is_dir($dir_user)) mkdir($dir_user, 0700);
$list_img = scandir ($dir_user, SCANDIR_SORT_DESCENDING);
$taille_img = ' width="100px" ';
print('<div id="user_imgs">');
foreach ( $list_img as $key => $value)
{
	if (substr($value, -4) == '.png')
	{
		$id = substr($value, 0, strlen($value)-4);
		print '<img class="user_img" onclick="img_delete('."'".$id."')".'" '.$taille_img.'id="'.$id.'" src="'.$dir_user.$value.'">';
	}

}
print('</div>'); // div  img_user
print('<div id="user_texte">');
$CPrint->content('<b>Prise de photos</b><br />Choisissez un fond en premier, un bouton apparaitra pour prendre votre photo et la stocker dans votre espace privé', 'notice');
$CPrint->content('<b>Gestion des photos</b><br />Suppression, cliquez sur une photo et la supprimer si souhaité', 'notice');
$CPrint->content('<b>Sans Caméra</b><br />Si vous n\'avez pas de caméra le transfert de fichier jpg est envisageable, à l\'aide du bouton \'Transférer un Fichier..\' une fois le fond choisi', 'notice');
print('</div>'); // div  user_texte


print '<script src="camera.js" type="text/javascript"></script>';
print '<script src="ajax.js" type="text/javascript"></script>';
include ('footer.php');
?>
