<?php
if(!isset($_SESSION)) {session_start();}
header('content-type : text/plain');
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1';

if( $_GET['action'] == 'refresh')
{
	$retour = '';
	$Id = $_SESSION['Id'];

//$retour .= 'test'.$_GET['action'].'<br>';
//$retour .= 'test id '.$Id.'<br>';
	// afficher les images crees sur le serveur
	$dir_user = "upload/user_".$Id.'/';
	if (!is_dir($dir_user)) mkdir($dir_user, 0700);
	$list_img = scandir ($dir_user, SCANDIR_SORT_DESCENDING);
	$taille_img = ' width="100px" ';
	//print('<div id="user_imgs">');
	foreach ( $list_img as $key => $value)
	{
		if (substr($value, -4) == '.png')
		{
			$id = substr($value, 0, strlen($value)-4);
			$id_div = $id;
			$id_photo = $id;
			print "<div id=\"$id_div\"><img class=\"user_img\" onclick=\"traitement.delete_img_usr($id_photo, $id_div)\" $taille_img id=\"img$id_photo\" src=\"$dir_user$value\"></div>"; //delete_img_usr(id_photo, id_div)
		}

	}
echo $retour;
}

if( $_GET['action'] == 'delete')
{
$retour = 'Delete : '.$_GET['id_photo'] ;
echo $retour;
}

?>