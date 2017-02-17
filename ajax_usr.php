<?php
if(!isset($_SESSION)) {session_start();}
require_once('includes_session.php');
$CView = new CPrint();
$CSession = new CSession();
header('content-type : text/plain');
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1';

$Err = 'Erreur';
$Id = $_SESSION['Id'];
$dir_user = "upload/user_".$Id.'/';

if( $_GET['action'] == 'refresh')
{
	// afficher les images crees sur le serveur
	
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
	$Err = '';
}

//*************  action=delete image ************
if( $_GET['action'] == 'delete')
{
	$Id_img = $_GET['id_photo'];

	try {
        $rq = $CSession->secure("DELETE FROM photos WHERE Id_owner = $Id AND Name_img = '$Id_img'");
       	
		$CSession->write_log($rq."\r\n"); // qwerty enlever quand ok
       
        $requete = $CSession->conn->prepare($rq); 
        $requete->execute();
        if ($requete)
        {	
        	unlink($dir_user.$Id_img.".png");
        	$retour = 'ok';
        }
        else
            {
                $retour = 'delete img err';
                exit;
            }
        }

        catch(PDOException $e)
            { $retour = "delete img, Error Database : " . $e->getMessage();}
        //$conn = null;
	echo $retour;
	$Err = '';
}

//*************  action=view_comment ************
if( $_GET['action'] == 'view_comment' && $_GET['image'])
{
	// afficher les comment images 
	$id_img = $_GET['image'];
	//print('<div id="div_galerie_cmt">');
	//$images_like = $CSession->image_nb_liked($id_img);
	//$CView->content('&bull; Nb Like '.$images_like, 'content');
	$CView->Titre('Commentaires des users');
	$images_comment = $CSession->image_comment($id_img);
	if (!$images_comment) $images_comment[] = 'Aucun commentaire';
	foreach ($images_comment as $key => $value)
		$CView->content('&bull; '.$value, 'content');
	$Err = '';
}

echo $Err;
?>