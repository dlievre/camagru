<?php
require_once('includes.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');


print('<div id="global">');
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


print('<video style="display:inline" width="514px" height="386" id="video"></video>');
print('<canvas style="display:none" width="514px" height="386"  id="canvas"></canvas>');
print('<div id="draw" style="display:none"><button id="btn_draw" onclick="traitement.draw(\'fond01\');">Prendre une photo</button></div>');
print('<div id="activer_camera" style="display:none"><button id="btn_cam" onclick="traitement.camera();">Revenir à la caméra</button></div>');
print '<div id="transfert" style="display:none"><input type="button" onclick="traitement.uploadEx()" value="Transferer un Fichier..." /></div>';

$dir_fonds = "fonds";
$listfond = scandir ('fonds');
$taillefond = ' width="51px" ';
print('<div id="fonds">');
$CPrint = new CPrint;
print ('<div id="msg_fonds">');
$CPrint->content(' Choisissez votre fond avant de prendre la photo', 'content');
print ('</div>');
$compteur = 0;
foreach ( $listfond as $key => $value)
{
	if (substr($value, -4) == '.png')
	{
		if ( ++$compteur > 9 )  { print '<br />'; $compteur = 0; }
		$id = substr($value, 0, strlen($value)-4);
		
		print '<img onclick="traitement.changefond('."'".$id."')".'" '.$taillefond.'id="'.$id.'" class="fond" src="fonds/'.$value.'"> ';
	}

}
print('</div>'); // div fonds
print('</div>'); // fin div main


// afficher les images crees sur le serveur
$dir_user = "upload/user_".$Id.'/';
if (!is_dir($dir_user)) mkdir($dir_user, 0700);
$list_img = scandir ($dir_user);
$taille_img = ' width="100px" ';
print('<div id="user_img">');
$compteur = 0;
foreach ( $list_img as $key => $value)
{
	if (substr($value, -4) == '.png')
	{
		if ( ++$compteur > 9 )  { print '<br />'; $compteur = 0; }
		$id = substr($value, 0, strlen($value)-4);
		
		print '<img onclick="traitement.changefond('."'".$id."')".'" '.$taille_img.'id="'.$id.'" class="user_img" src="'.$dir_user.$value.'"><br /> ';
	}

}
print('</div>'); // div  img_user
print('</div>'); // div  global
print '<script src="camera.js" type="text/javascript"></script>';
include ('footer.php');
?>
