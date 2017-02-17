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
		print "<img class=\"galerie_img\" onclick=\"traitement.view_comment($name_img, 'div_galerie_cmt');\" $taille_img id=\"$id_img\" src=\"$dir_user$value\">";
		$CView->div_end(); // div_img
		print "<div class=\"div_like\" ><p class=\"like\">Like $key</p></div>"; 
		print "<div class=\"div_comment\" ><p class=\"comment\"><a onclick=\"traitement.view_comment($name_img, 'div_galerie_cmt');\">+</a></p></div>";
		$CView->div_end(); // div_img_like_cmt
		$nb++;
	}
	// important sinon erreur javascript sur le constructor
	print("<div style=\"display:none\"  id=\"div_video\"><video id=\"video\" width=\"100px\" height=\"50px\"></video></div>");
	print('</div>'); // div  galerie
	print('<div  id="div_galerie_cmt">');
	$CView->content('Cliquez sur une photo pour voir les commentaires', 'content');
	/*$CView->content('commentaire de photos, elle est vraiment super cette photo', 'content');
	$images_comment = $CSession->image_comment('1487264490', 'div_galerie_cmt');
	foreach ($images_comment as $key => $value) {
		$CView->content($value, 'content');
	}*/
	print('</div>'); // div  div_galerie_cmt
	print('</div>'); // div  galerie

//print('</div>'); // fin div main


print '<script src="js_camera.js" type="text/javascript"></script>';
//print '<script src="js_galerie.js" type="text/javascript"></script>';
//print '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
include ('footer.php');
?>
