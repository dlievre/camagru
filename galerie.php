<?php
require_once('includes_session.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');
$CView = new CPrint();
$CSession = new CSession();
$CForm = new CForm;
//print('<div id="main">');

	$Id = $_SESSION['Id'];

	$taille_img = ' width="150px" height="auto" ';
	print('<div id="div_galerie">');

	$images_galerie = $CSession->images_galerie();

	$nb = 0;
	foreach ($images_galerie as $key => $value) 
	{
		$CView->div('','div_img_like_cmt');
		$CView->div('','div_img');
		$id_img = $images_galerie[$nb]['Id'];
		$name_img = $images_galerie[$nb]['Name_img'];
		$images_like = $CSession->image_nb_liked($name_img);
		if ($images_like > 0) $info_images_like = 'Like '.$images_like; else $info_images_like = '';
		$dir_user = 'upload/user_'.$images_galerie[$nb]['Id_owner'].'/';
		$value = $name_img.'.png';
		print "<img class=\"galerie_img\" onclick=\"traitement.view_comment($name_img, 'div_cmt');\" $taille_img id=\"$id_img\" src=\"$dir_user$value\">";
		$CView->div_end(); // div_img
		print "<div class=\"div_like\" ><p class=\"like\">$info_images_like</p></div>"; 
		print "<div class=\"div_comment\" ><p class=\"comment\"><a onclick=\"traitement.add_like($name_img, 'div_cmt');\">+</a></p></div>";
		$CView->div_end(); // div_img_like_cmt
		$nb++;
	}
	// important sinon erreur javascript sur le constructor
	print("<div style=\"display:none\"  id=\"div_video\"><video id=\"video\" width=\"100px\" height=\"50px\"></video></div>");
	print('</div>'); // div  galerie

	print('<div id="div_galerie_cmt">');

	//$CView->div('form_cmt','');
	//print("<div id=\"div_form_cmt\">");// style=\"display:none\" >");
	$CView->div('div_form_cmt','');
	$CView->titre('Votre Commentaire');

	print "<textarea id=\"send_comment\" rows=\"4\" cols=\"35\" placeholder=\"Saisissez votre commentaire\"></textarea>";
	print("<div id=\"div_send_cmt\"><button id=\"btn_send_cmt\" onclick=\"traitement.send_comment($Id, 'div_cmt');\">Envoyer</button></div>");
	$CView->div_end(); // form_cmt

	//$CView->div('div_cmt','');
	print("<div id=\"div_cmt\">");// style=\"display:none\" >");
	$CView->content('Cliquez sur une photo <br/>&bull; pour voir les commentaires des utilisateurs<br />&bull; pour Liker et envoyer votre commentaire ', 'content');
	$CView->div_end(); // div_cmt

	print('</div>'); // div  div_galerie_cmt
	print('</div>'); // div  galerie

//print('</div>'); // fin div main

print '<script src="js_camera.js" type="text/javascript"></script>';
//print '<script src="js_galerie.js" type="text/javascript"></script>';
//print '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
include ('footer.php');
?>
