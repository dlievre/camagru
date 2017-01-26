<?php
Class CSession
{

    public static $verbose = False;
    private $servername = "host=localhost";
    private $username = "admin";
    private $password = "admin";
    private $dbname = "dbname=camagru";


    public function __construct()
    {
        return;
    }

    public function user_login()
    {
        $email = strip_tags($_POST['email']);
        $Password = strip_tags($_POST['Password']);
        try {
            $conn = new PDO('mysql:host=localhost;dbname=camagru', $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT id, Nom, Prenom, email, Password FROM tbl_camagru LIMIT 1"); 
            $requete->execute();
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                    if ($lignes->email == $email && $lignes->Password == $Password )
                        $this->set_session($lignes->email, $lignes->Nom, $lignes->Prenom );
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); }
        $conn = null;
        return;
    }

    public function user_exist()
    {
        $email = strip_tags($_POST['email']);
        try {
            $conn = new PDO('mysql:host=localhost;dbname=camagru', $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT email FROM tbl_camagru LIMIT 1"); 
            $requete->execute();
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                    if ($lignes->email == $email )
                        $user_exist = 'yes';

            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); }
        $conn = null;
        return($user_exist);
    }

    public function __destruct()
    {
        print ('<p>destruct</p>');
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

    public function set_session($email, $Nom, $Prenom)
   {
    //PRINT 'SESSION<BR />';
        $_SESSION['email'] = $email;
        $_SESSION['Nom'] = $Nom;
        $_SESSION['Prenom'] = $Prenom;
        $_SESSION['valide'] = 'ok';
        //print ('user valide<br />');
        //foreach ($_SESSION as $key => $value)
            //echo $value.'<br />';
        return('ok');
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
    public function kill_session()
   {
        $_SESSION = array(); session_destroy(); 
        return('ok');
   }
   
}


?>
