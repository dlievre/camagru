<?php 
Class CDatabase // ***** Class 
{
	public function database()
	{
		$DB_DSN = "mysql:dbname=camagru;host=localhost";
		$DB_USER = "root";
		$DB_PASSWORD = "";

		$DB_DSN1 = "mysql:dbname=db665127288;host=db665127288.db.1and1.com;";
		$DB_USER1 = "dbo665127288";
		$DB_PASSWORD1 = "42piscinedltp";

		$Domaine_Serveur = str_replace ( 'www.' , '', $_SERVER['HTTP_HOST']);
		if ($Domaine_Serveur == 'camagru.photeam.com')
			$conn = new PDO($DB_DSN1, $DB_USER1, $DB_PASSWORD1);
		else
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

		return ($conn);
	}
}
?>