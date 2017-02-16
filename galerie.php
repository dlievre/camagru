<?php
require_once('includes_session.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');
$CView = new CPrint();
$CSession = new CSession();
//print('<div id="main">');

	$Id = $_SESSION['Id'];



	$taille_img = ' width="150px" height="auto" ';
	print('<div id="div_galerie">');

	$images_galerie = $CSession->images_galerie();

	/*$nb = 0;
	foreach ($images_galerie as $key => $value) {
		$CView->content_array($images_galerie[$nb], 'content',  'content');
		$nb++;
	}*/

	$nb = 0;
	foreach ($images_galerie as $key => $value) {
		$CView->div('','div_img_like_cmt');
		$CView->div('','div_img');
		$id_img = $images_galerie[$nb]['Id'];
		$name_img = $images_galerie[$nb]['Name_img'];
		$dir_user = 'upload/user_'.$images_galerie[$nb]['Id_owner'].'/';
		$value = $name_img.'.png';
		print "<img class=\"galerie_img\" onclick=\"galerie.view_comment($id_img);\" $taille_img id=\"$id_img\" src=\"$dir_user$value\">";
		$CView->div_end(); // div_img
		print "<div class=\"div_like\" ><p class=\"like\">Like $key</p></div>"; 
		print "<div class=\"div_comment\" ><p class=\"comment\"><a onclick=\"galerie.view_comment($id);\">+</a></p></div>";
		$CView->div_end(); // div_img_like_cmt
		$nb++;
	}

/*print'<br><br><br>';
	// afficher les images crees sur le serveur
	$dir_user = "upload/user_".$Id.'/';
	if (!is_dir($dir_user)) mkdir($dir_user, 0700);
	$list_img = scandir ($dir_user, SCANDIR_SORT_DESCENDING);
		foreach ( $list_img as $key => $value)
		{
			if (substr($value, -4) == '.png') 
			{
				$id = substr($value, 0, strlen($value)-4);
				print '<div class="div_img_like_cmt">';
				print '<div class="div_img">';
				print "<img class=\"galerie_img\" onclick=\"galerie.view_comment($id);\" $taille_img id=\"$id\" src=\"$dir_user$value\">";
				print '</div>'; // div_img
				print "<div class=\"div_like\" ><p class=\"like\">Like $key</p></div>"; 
				print "<div class=\"div_comment\" ><p class=\"comment\"><a onclick=\"galerie.view_comment($id);\">+</a></p></div>";
				print '</div>'; // div_img_like_cmt
				//print '<br />';

			}

		}*/
	print('</div>'); // div  galerie

	print('<div id="div_galerie_cmt">');
	$CView->content('commentaire de photos, elle est vraiment super cette photo', 'content');
	print('</div>'); // div  galerie

//print('</div>'); // fin div main


print '<script src="js_ajax.js" type="text/javascript"></script>';
print '<script src="js_galerie.js" type="text/javascript"></script>';
print '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
include ('footer.php');
?>
