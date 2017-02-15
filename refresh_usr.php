<?php
if(!isset($_SESSION)) {session_start();}
header('content-type : text/plain');
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1';
//$ajax = '<div><p><strong>This is changed via Ajax</strong></p></div>';
//echo $ajax;

$retour = '';
	$Id = $_SESSION['Id'];

	// afficher les images crees sur le serveur
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
			//print '<img class="user_img" onclick="send('."'".$id."')".'" '.$taille_img.'id="'.$id.'" src="'.$dir_user.$value.'">';
			print "<img class=\"user_img\" onclick=\"send($id, 'user_imgs')\" $taille_img id=\"$id\" src=\"$dir_user$value\">";
		}

	}
	//print('</div>'); // div  user_imgs


echo $retour;

/*
/delete.php?request=ajax
if(!isset($_GET['request']) || $_GET['request'] != 'ajax') {
    die();
}
// rest of the code ...
*/
?>