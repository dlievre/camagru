<?php
if(!isset($_SESSION)) {session_start();}
header('content-type : text/plain');
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1';
//$ajax = '<div><p><strong>This is changed via Ajax</strong></p></div>';
//echo $ajax;

$retour = '';
	$Id = $_SESSION['Id'];

$retour .= "<p>begin $Id</p>";
	// afficher les images crees sur le serveur
	$dir_user = "upload/user_".$Id.'/';
	if (!is_dir($dir_user)) mkdir($dir_user, 0700);
	$list_img = scandir ($dir_user, SCANDIR_SORT_DESCENDING);
	$taille_img = ' width="150px" height="auto" ';
	$retour .= '<div id="div_galerie">';
	$retour .= '<p>galerie</p>';
		foreach ( $list_img as $key => $value)
		{
			if (substr($value, -4) == '.png') 
			{
				$id = substr($value, 0, strlen($value)-4);
				$retour .= '<div class="div_img_like_cmt">';
				$retour .= '<div class="div_img">';
				$retour .= "<img class=\"galerie_img\" onclick=\"galerie.view_comment($id);\" $taille_img id=\"$id\" src=\"$dir_user$value\">";
				$retour .= '</div>'; // div_img
				$retour .= "<div class=\"div_like\" ><p class=\"like\">Like $key</p></div>"; 
				$retour .= "<div class=\"div_comment\" ><p class=\"comment\"><a onclick=\"galerie.view_comment($id);\">+</a></p></div>";
				$retour .= '</div>'; // div_img_like_cmt
				//print '<br />';

			}

		}
	$retour .=('</div>'); // div  galerie

	$retour .=('<div id="div_galerie_cmt">');
	//$retour .= $CPrint->content('commentaire de photos, elle est vraiment super cette photo', 'content');
	$retour .=('</div>'); // div  galerie

echo $retour;

/*
/delete.php?request=ajax
if(!isset($_GET['request']) || $_GET['request'] != 'ajax') {
    die();
}
// rest of the code ...
*/
?>