<?php
Class CSession
{

    public static $verbose = False;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "camagru";
    private $tbl = "tbl_camagru";


    public function __construct()
    {
        return;
    }

    public function user_login()
    {
        $email = strip_tags($_POST['email']);
        $Password = strip_tags($_POST['Password']);
        $retour = 'user not exit';
        try {
            //$conn = new PDO('mysql:host=localhost;dbname=camagru', $username, $password);
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT Id, Nom, Prenom, email, Password, Confirm, Keyconfirm FROM ".$this->tbl." LIMIT 1"); 
            $requete->execute();
            while($lignes = $requete->fetch(PDO::FETCH_OBJ)){
                    if ($lignes->email == $email && $lignes->Password == $Password && $lignes->Confirm == 1)
                    {
                        $this->set_session($lignes->email, $lignes->Nom, $lignes->Prenom, $lignes->Confirm );
                        $retour = 'user_login';
                    }
                    if ($lignes->email == $email && $lignes->Password == $Password && $lignes->Confirm == 0)
                        $retour = 'user not confirmed';

                    if ($lignes->email == $email && $lignes->Password != $Password)
                        $retour = 'user password bad';
                }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); }
        $conn = null;
        return($retour);
    }

    public function user_exist()
    {
        $email = strip_tags($_POST['email']);
       ///   securisation : https://openclassrooms.com/courses/securite-php-securiser-les-flux-de-donnees
        try {
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT email FROM $this->tbl WHERE email = :email"); 
            $requete->bindValue(':email', $email, PDO::PARAM_STR);
            $requete->execute();
            $exist = 'no';
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                    if ($lignes->email == $email ) { $exist = 'yes'; }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur'; return($exist);}
        $conn = null;
        return($exist);
    }

        private function quotesep($val)
        {
               return("'".$val."', ");
        }

        private function quote($val)
        {
            return("'".$val."'");
        }

        public function user_add()
    {
        $email = strip_tags($_POST['email']);
        $Password = strip_tags($_POST['Password']);
        $Confirm = 0;
        $CInscription = new CInscription();
        $Keyconfirm = $CInscription->set_key_validation;
        $Keyconfirm = "sdfgsdhf";
        $cpt_reinit = 5;

        // contre les injection sql : https://openclassrooms.com/courses/pdo-comprendre-et-corriger-les-erreurs-les-plus-frequentes

        try {
            //$conn = new PDO('mysql:host=localhost;dbname=camagru', $username, $password);
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$req = "INSERT INTO ". $this->tbl." (Nom, Prenom, email, Password, Confirm, Keyconfirm, cpt_reinit, Info) VALUES (".$this->quotesep($_POST['Nom']).$this->quotesep($_POST['Prenom']).$this->quotesep($email).$this->quotesep($_POST['Password']).$Confirm.', '.$this->quotesep($Keyconfirm).$cpt_reinit.", "."'info')";
            $requete = $conn->prepare($req);
            $requete->execute();

            // envoi validation par mail uniquement si base maj
            //print ($email.' '.$lignes->Prenom.' '.$lignes->Nom.' '.$lignes->Keyconfirm);
            $CInscription->send_validation($email, $lignes->Prenom, $lignes->Nom, $lignes->Keyconfirm);
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); print 'Erreur user_add'; exit;}
        $conn = null;
        return('user_add');
    }

    public function user_list() // reservé superuser
    {
        try {
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT Nom, Prenom, email FROM ".$this->tbl); 
            $requete->execute();
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                {
                    print '<p>'.$lignes->email.'<br />';
                    print $lignes->Nom.'<br />';
                    print $lignes->Prenom.'<br />';
                    print '</p>';
                }

            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur';}
        $conn = null;
        return;
    }

    public function set_session($email, $nom, $prenom, $confirm)
   {
        $_SESSION['email'] = $email;
        $_SESSION['Nom'] = $nom;
        $_SESSION['Prenom'] = $prenom;
        $_SESSION['Confirme'] = $confirm;
        $_SESSION['valide'] = 'ok';

        return('ok');
   }

    public function get_profile()
    {
        if ($_SESSION['valide'] == 'ok') {
            $tab = array();
            foreach ($_SESSION as $nom => $value)
                $tab[$nom] = $value;
            return($tab);
        }
        else
            return('erreur');
    }

    function secure($var)
    {
        return (mysql_real_escape_string($var));
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
       return (file_get_contents('documentation.txt'));
    }



    
    public function kill_session()
   {
        $_SESSION = array(); session_destroy(); 
        return('ok');
   }


   
}


?>
