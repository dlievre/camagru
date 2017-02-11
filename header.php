<?php
print '<div>';
print '<div id="header"><div class="header_titre"><h1>Camagru</h1></div>';

if ($_SESSION["valide"]=='ok') {
	$status = ' : Login';
	$nom = 'Nom';
	$SuperUser = '';
	if ($_SESSION['Superuser'] == 'yes')
		$SuperUser = '<a href="superuser.php">SuperUser</a><br />';
	print '<div id="header_user" class="header_user"><p class="header_user">';
	print $_SESSION["email"].$status.'<br />';
	print $SuperUser;
	print '</p></div>';

	print '<div id="header_menu" class="header_menu"><p class="header_menu">';
	print '<a href="galerie.php">Galerie</a>'.'<span class="menu"> | </span>';
	print '<a href="logoff.php">Log out</a>'.'<span class="menu"> | </span>';
	print '<a href="profile.php">Profile</a>'.'<span class="menu"> | </span>';
	print '<a href="index.php">Home</a>';
	print '</p></div>';

}
else
{
	print '<div id="header_user" class="header_user"><p class="header_user">';
	print 'Not Logged<br /><a href="login.php">Login</a>';
	print '</p></div>';
}

print '</div>';
?>