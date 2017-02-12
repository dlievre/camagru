<?php
require_once('includes_session.php');
if ($_SESSION['valide'] != 'ok') {header('Location: login.php');}
if ( $_SESSION["email"] != 'dominique@lievre.net' ) exit;
require_once('head.php');
require_once('header.php');

$CPrint = new CPrint;
$CSession = new CSession;
print('<div id="main">');

$CPrint->titre('Liste des users');
$CSession->user_list('content_left', 'content_left');

$CPrint->content('<b>Chemin : </b>'. __FILE__ .'<br />', 'content_left');
$CPrint->content('<b>$_SERVER[\'DOCUMENT_ROOT\' : </b>'.$_SERVER['DOCUMENT_ROOT'].'<br />', 'content_left');

// afficher les chmod
$listfile = scandir (getcwd());
$result = array();
foreach ( $listfile as $key => $file)
	$result[$file] = substr(sprintf('%o', fileperms($file)), -4);

$CPrint->titre('CHMOD Fichiers');
$CPrint->content_array($result, 'content_left', 'content_left');

print('</div>');	
include ('footer.php');
?>