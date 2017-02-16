<?php
if(!isset($_SESSION)) {session_start();}
Class CSession
{
    public static $verbose = False;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "camagru";
    private $tbl = "tbl_camagru";
    private $tbl_photos = "photos";
    //private $conn =''; pas necessaire
////////

///////
    public function __construct()
    {
        //print '__construct';
        // a l'initialisation de la class on genere la variable de conenxion a la base
        $this->conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return;
    }

    public function user_login()
    {
        $email = strtolower(strip_tags($_POST['email']));
        $Password = $this->user_pass_hash($_POST['Password']);
        $retour = 'user not exit';
        try {
            $rq = $this->secure("SELECT Id, Nom, Prenom, email, Password, Confirm, Keyuser FROM $this->tbl WHERE email = '$email'");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            while($lignes = $requete->fetch(PDO::FETCH_OBJ)){
                    if ($lignes->email == $email && $lignes->Password == $Password && $lignes->Confirm == 1)
                    {
                        $this->set_session($lignes->email, $lignes->Nom, $lignes->Prenom, $lignes->Confirm, $lignes->Id );
                        $retour = 'user_login';
                    }
                    if ($lignes->email == $email && $lignes->Password == $Password && $lignes->Confirm == 0)
                        $retour = 'user not confirmed';

                    if ($lignes->email == $email && $lignes->Password != $Password)
                        $retour = 'user password bad';

                    if ($lignes->email != $email )
                        $retour = 'user not exit';
                }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); }
        //$conn = null;
        return($retour);
    }

        public function user_info($email_key, $origin)
    {
        // tester si origin = email ou key
        //print $email_key.' ' . $origin;
        if ($origin == 'key' ) {$email = $this->userkey_exist($email_key);}
        if ($origin == 'email' ) {$email = $email_key;}

        if ($this->user_exist($email) == 'no') // le mail n'est pas bon
        { 
            $tbl['email'] = 'no';
            return ($tbl);
        } 
        try {
            $rq = $this->secure("SELECT Id, Nom, Prenom, email, Password, Confirm, Keyuser, Questionsecrete, Reponsesecrete FROM $this->tbl WHERE email = '$email'");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            while($lignes = $requete->fetch(PDO::FETCH_OBJ)){
                $tbl['Id'] = $lignes->Id;
                $tbl['email'] = $lignes->email;
                $tbl['Nom'] = $lignes->Nom;
                $tbl['Prenom'] = $lignes->Prenom;
                $tbl['Password'] = $lignes->Password;
                $tbl['Confirm'] = $lignes->Confirm;
                $tbl['Keyuser'] = $lignes->Keyuser;
                $tbl['Questionsecrete'] = $lignes->Questionsecrete;
                $tbl['Reponsesecrete'] = $lignes->Reponsesecrete;
                }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); }
        //$conn = null;
        return($tbl);
    }

    public function maj_key($email)
    {
        $generatedKey = uniqid();
        try {
            $rq = $this->secure("UPDATE $this->tbl SET Keyuser = '$generatedKey' WHERE email = '$email'");
            $requete = $this->conn->prepare($rq); 
            $requete->execute();
            if ($requete)
                $retour = $generatedKey;
            else
                {
                    $retour = 'maj key err';
                    $CPrint = new CPrint();
                    $CPrint->content('Erreur maj key', 'msg_err');
                    exit;
                }
            }

        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur'; return($exist);}
        //$conn = null;
        return($retour);
    }

    public function user_exist($email)
    {
        if (!$email) $email = strtolower(strip_tags($_POST['email']));
       ///   securisation : https://openclassrooms.com/courses/securite-php-securiser-les-flux-de-donnees
        try {
            //$requete = $this->conn->prepare("SELECT email FROM $this->tbl WHERE email = :email"); 
            //$requete->bindValue(':email', $email, PDO::PARAM_STR);
            $rq = $this->secure("SELECT email FROM $this->tbl WHERE email = '$email'");
            $requete = $this->conn->prepare($rq);
            $requete->execute();
            $exist = 'no';
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                if ($lignes->email == strtolower($email) ) { $exist = 'yes'; }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur'; return($exist);}
        //$conn = null;
        return($exist);
    }

        public function userkey_exist($key)
    {
        if (!$key) {print 'erreur in userkey_exist'; exit; }
       ///   securisation : https://openclassrooms.com/courses/securite-php-securiser-les-flux-de-donnees
        try {
            $rq = $this->secure("SELECT email, Keyuser FROM $this->tbl WHERE Keyuser = '$key'");
            $requete = $this->conn->prepare($rq);
            $requete->execute();
            $retour = 'no';
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                if ($lignes->Keyuser == $key ) { $retour = $lignes->email;}
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur'; return($exist);}
        return($retour);
    }

    private function quotesep($val)// securise le passage des variables dans la requete sql, avec separateur
    {
        return("'".$val."', ");
    }

    private function quote($val)// securise le passage des variables dans la requete sql, sans separateur
    {
        return("'".$val."'");
    }

        public function user_add()
    {
        $email = strtolower(strip_tags($_POST['email']));
        $Nom = strip_tags($_POST['Nom']);
        $Prenom = strip_tags($_POST['Prenom']);
        $Password = $this->user_pass_hash($_POST['Password']);
        $Confirm = 0;
        $CInscription = new CInscription();
        $Keyuser = $CInscription->set_key_validation();
        $Cpt_reinit = 5;

        // contre les injection sql : https://openclassrooms.com/courses/pdo-comprendre-et-corriger-les-erreurs-les-plus-frequentes

        try {
            $rq = $this->secure("INSERT INTO $this->tbl (Nom, Prenom, email, Password, Confirm, Keyuser, Cpt_reinit, Questionsecrete, Reponsesecrete, Info) VALUES ('$Nom', '$Prenom', '$email', '$Password', '$Confirm', '$Keyuser', '$Cpt_reinit', '$_POST[Question]', '$_POST[Reponse]', 'Info')"); // ne pas mettre les '' dans $_POST['Nom']
            $requete = $this->conn->prepare($rq);
            $requete->execute();

            // envoi validation par mail uniquement si base maj
            //print ($email.' '.$lignes->Prenom.' '.$lignes->Nom.' '.$lignes->Keyuser);
            $CInscription->send_validation($email, $Prenom, $Nom, $Keyuser);
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); print 'Erreur user_add'; exit;}
        //$conn = null;
        return('user_add');
    }

    function user_pass_modify($email, $pass)
    {
        $hashkey = $this->user_pass_hash($pass);
        try {
            $rq = $this->secure("UPDATE $this->tbl SET Password = '$hashkey' WHERE email = '$email'");
            
            $requete = $this->conn->prepare($rq); 
            $requete->execute();
            if ($requete)
                $retour = 'ok';
            else
                $retour = 'Erreur modification password';
            }

        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur'; return($exist);}
        //$conn = null;
        return($retour);
    }

    function user_pass_hash($pass)
    { 
        return (hash('whirlpool',$pass));
    }

    public function user_list($class1, $class2) // reservé superuser
    {
        try {
            //$conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $this->conn->prepare("SELECT Id, Nom, Prenom, email, Confirm, Keyuser, Cpt_reinit, Questionsecrete, Reponsesecrete, Info FROM ".$this->tbl); 
            $requete->execute();
            print '<table>';
            print "<tr><td><p class=\"$class1\">Id</p></td>";
            print "<td><p class=\"$class1\">email</p></td>";
            print "<td><p class=\"$class1\">Nom</p></td>";
            print "<td><p class=\"$class1\">Prenom</p></td>";
            print "<td><p class=\"$class1\">Confirm</p></td>";
            print "<td><p class=\"$class1\">Keyuser</p></td>";
            print "<td><p class=\"$class1\">Cpt_reinit</p></td>";
            print "<td><p class=\"$class1\">Question secrete</p></td>";
            print "<td><p class=\"$class1\">Reponse secrete</p></td>";
            print "<td><p class=\"$class1\">Info</p></td>";
            print '</tr>';
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                {
                    print '<tr><td><p class="'.$class1.'">'.$lignes->Id.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->email.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->Nom.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->Prenom.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->Confirm.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->Keyuser.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->Cpt_reinit.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->Questionsecrete.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->Reponsesecrete.'</p></td>';
                    print '<td><p class="'.$class1.'">'.$lignes->Info.'</p></td>';
                    print '</tr>';
                }
            print '</table>';
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur';}
        //$conn = null;
        return;
    }

    public function set_session($email, $nom, $prenom, $confirm, $Id)
   {
        $_SESSION['Id'] = $Id;
        $_SESSION['email'] = $email;
        $_SESSION['Nom'] = $nom;
        $_SESSION['Prenom'] = $prenom;
        $_SESSION['Confirme'] = $confirm;
        $_SESSION['valide'] = 'ok';
        if ($_SESSION["email"] == 'dominique@lievre.net' or $_SESSION["email"] == 'tpasqual@student.42.fr') $_SESSION['Superuser'] = 'yes';
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
        $var = strip_tags($var);
        return($var); // pour l'instant on ne fait que le strip_tags car protege par 'value'
        //return (mysql_real_escape_string($var)); // ne fonctionne pas
        //return($var);
    }

    function ismajuscule($var)// permet de verifier si il y a une majuscule dans la chaine pour les mauvais password
    {
        $nb = strlen($var);
        $retour = 'minuscule';
        for($i = 0; $i < $nb; $i++) {
            if (ctype_upper (substr($var, $i, 1))) 
                $retour = 'majuscule';
        }
        return($retour);
    }

//*********   gestion des images dans la base *********

    function imgage_add($id_photo, $Id)// ajoute une image dans la base
    {
        //$this->write_log('var '.$id_photo. ' '. $Id);
        try
        {
            $rq = $this->secure("INSERT INTO $this->tbl_photos (Id_owner, Name_img) VALUES ('$Id', '$id_photo')"); // ne pas mettre 
            $requete = $this->conn->prepare($rq);
            $requete->execute();
        }
        catch(PDOException $e)
        { 
            return "image_add Error Database : " . $e->getMessage();
        }

        return('imgage_add'); 
    }
    
        public function images_galerie()
    {

        try {
            $rq = $this->secure("SELECT Id, Id_owner, Name_img FROM $this->tbl_photos");  //ORDER BY 'Date' DESC  , 'Date'
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            $nb = 0;
            while($lignes = $requete->fetch(PDO::FETCH_OBJ)){
                $tbl[$nb]['Id'] = $lignes->Id;
                $tbl[$nb]['Id_owner'] = $lignes->Id_owner;
                $tbl[$nb]['Name_img'] = $lignes->Name_img;
                $nb++;
                }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); }
        //$conn = null;
        return($tbl);
    }


    public function __destruct()
    {
        //print ('<p>destruct</p>');
        $this->conn = null; // on efface la connexion a la base
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

    public function write_log($errtxt)
    {
        $fp = fopen('log.txt','a+'); // ouvrir le fichier ou le créer
        fseek($fp,SEEK_END); // poser le point de lecture à la fin du fichier
        $nouverr=$errtxt."\r\n"; // ajouter un retour à la ligne au fichier
        fputs($fp,$nouverr); // ecrire ce texte
        fclose($fp); //fermer le fichier
        return 'ok';
    }

}


?>
