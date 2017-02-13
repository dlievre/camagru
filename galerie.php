<?php
require_once('includes.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
require_once('head.php');
require_once('header.php');
$CPrint = new CPrint();

print('<div id="main">');
?>
<style> 
#video { border: 1px solid #000000;margin : 0;}
#canvas { border: 1px solid #000000;margin : 0;}
.btn { padding: 5px; margin: 10px;}
</style>
<?php
$Id = $_SESSION['Id'];



print('</div>'); // fin div main


// afficher les images crees sur le serveur
$dir_user = "upload/user_".$Id.'/';
if (!is_dir($dir_user)) mkdir($dir_user, 0700);
$list_img = scandir ($dir_user, SCANDIR_SORT_DESCENDING);
$taille_img = ' width="100px" ';
print('<div id="div_galerie">');
foreach ( $list_img as $key => $value)
{
	if (substr($value, -4) == '.png') 
	{
		$id = substr($value, 0, strlen($value)-4);
		print '<div class="div_img" >';
		print "<img class=\"galerie_img\" onclick=\"img_delete($id)\" $taille_img id=\"$id\" src=\"$dir_user$value\">";
		print '<div class="div_img_like" >like 12</div>'; 
		print '<div/>'; // div_img

	}

}
print('</div>'); // div  galerie


print '<script src="ajax.js" type="text/javascript"></script>';
print '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
include ('footer.php');
?>
