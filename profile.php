<?php
require_once('includes_session.php');

if ($_SESSION['valide'] == 'ok')
{
  $session = new CSession();
  require_once('head.php');
  require_once('header.php');
  print('<div id="main">');

  $CSession = new CSession();
  $TabProfil = $CSession->get_profile();

  $CPrint = new CPrint();
  //$print->profil('Profile Utilisateur', $TabProfil);

  $CPrint->titre('Profile Utilisateur');
  $CPrint->content_array($_SESSION, 'content_left', 'content_left');
  //$CPrint->content( "Connecté depuis  ".round((time() - $_SESSION['Logstart'])/60 )  ."minutes", 'content_left', 'content_left'); // -time()

  print('</div>'); 
  include ('footer.php');
}
  else
{
  header('Location: index.php');
}
?>