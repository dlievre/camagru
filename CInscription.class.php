<?php
Class CInscription
{

    public static $verbose = False;
    private $servername = "localhost";
    private $username = "admin";
    private $password = "admin";
    private $dbname = "camagru";
    private $tbl = "tbl_camagru";

    public function __construct()
    {
        return;
    }

//send_validation
//cle_validation
//send_email
//validation_user
//reset_password
//remove_user

    public function send_validation($info_user)
    {
        foreach ($info_user as $key => $value) {
            print '<p>'.$value.'</p>';
        }
       // $email = strip_tags($_POST['email']);
        //$Password = strip_tags($_POST['Password']);

        return;
    }

    public function send_email()
    {
        print '
        Bonjour dominique LIEVRE

Félicitations vous venez de vous inscrire sur Freelancerepublik.

Pour valider cette inscription, il ne vous reste plus qu\'à cliquer sur le lien suivant :

http://www.freelancerepublik.com/users/valid/0b70b440-9f4a-11e5-8d37-a3ba02c0c87c';
    }

    public function __destruct()
    {
        //print ('<p>destruct</p>');
        return;
    }

   public function __toString() //print ($Form);
   {
        return('toString');
   }

   public function __invoke() //print ($Form());
   {
        return('invoke');
   }

    static function doc()
    {
        $info = '';
        //INSERT INTO `tbl_camagru` (`id`, `Nom`, `Prenom`, `email`, `password`, `info`) VALUES (NULL, 'LIEVRE', 'Dominique', 'dominique@lievre.net', 'test', 'sans');
       return (file_get_contents('Form.doc.txt'));
    }



       public function get_Profile()
   {
    //PRINT 'SESSION<BR />';
    if ($_SESSION['valide'] == 'ok')
    {
        $tab = array();
        $tab[] = "Email"; $tab[] = $_SESSION['email'];
        $tab[] = "Nom"; $tab[] = $_SESSION['Nom'];
        $tab[] = "Prenom"; $tab[] = $_SESSION['Prenom'];
        $tab[] = "Session"; $tab[] = $_SESSION['valide'];

        return($tab);
    }
    else
        return('erreur');

   }

   
}

?>