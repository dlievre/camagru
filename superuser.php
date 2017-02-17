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

$CPrint->titre('Liste Questions secrètes');
$CPrint->content_array($Tabquestion, 'content_left', 'content_left');

$CPrint->titre('Info systèmes');
$CPrint->content('<b>Chemin : </b>'. __FILE__ .'<br />', 'content_left');
$CPrint->content('<b>$_SERVER[\'DOCUMENT_ROOT\' : </b>'.$_SERVER['DOCUMENT_ROOT'].'<br />', 'content_left');



$CPrint->titre('Fichier Glog');
print 'Test Fichier glog.txt';
//$test = $CSession->write_log('superuser connected');
$CPrint->content('Test Fichier glog.txt '.$CSession->write_log('superuser connected'), 'content');
//$CPrint->content($CSession->read_log('content');
$CSession->read_log('glog.txt');

$CPrint->titre('Documentation');
$CSession->read_log('documentation.txt');

// afficher les chmod
$listfile = scandir (getcwd());
$result = array();
foreach ( $listfile as $key => $file)
{

	$result[$file] = substr(sprintf('%o', fileperms($file)), -4);

}

$CPrint->titre('CHMOD Fichiers');
$CPrint->content_array($result, 'content_left', 'content_left');


$indicesServer = array('PHP_SELF', 
'argv', 
'argc', 
'GATEWAY_INTERFACE', 
'SERVER_ADDR', 
'SERVER_NAME', 
'SERVER_SOFTWARE', 
'SERVER_PROTOCOL', 
'REQUEST_METHOD', 
'REQUEST_TIME', 
'REQUEST_TIME_FLOAT', 
'QUERY_STRING', 
'DOCUMENT_ROOT', 
'HTTP_ACCEPT', 
'HTTP_ACCEPT_CHARSET', 
'HTTP_ACCEPT_ENCODING', 
'HTTP_ACCEPT_LANGUAGE', 
'HTTP_CONNECTION', 
'HTTP_HOST', 
'HTTP_REFERER', 
'HTTP_USER_AGENT', 
'HTTPS', 
'REMOTE_ADDR', 
'REMOTE_HOST', 
'REMOTE_PORT', 
'REMOTE_USER', 
'REDIRECT_REMOTE_USER',
'REDIRECT_STATUS', 
'SCRIPT_FILENAME', 
'SERVER_ADMIN', 
'SERVER_PORT', 
'SERVER_SIGNATURE', 
'PATH_TRANSLATED', 
'SCRIPT_NAME', 
'REQUEST_URI', 
'PHP_AUTH_DIGEST', 
'PHP_AUTH_USER', 
'PHP_AUTH_PW', 
'AUTH_TYPE', 
'PATH_INFO', 
'ORIG_PATH_INFO') ; 

//$CPrint->content_array($indicesServer, 'content_left', 'content_left');

echo '<table cellpadding="10">' ; 
foreach ($indicesServer as $arg) { 
    if (isset($_SERVER[$arg])) { 
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ; 
    } 
    else { 
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ; 
    } 
} 
echo '</table>' ; 
print('</div>');	
include ('footer.php');
?>