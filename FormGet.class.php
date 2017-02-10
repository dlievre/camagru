<?php
require_once('includes_session.php');
//session_start();
Class CFormGet{
    public $newvar = 0;
    public static $verbose = False;
    //private tabpost = array();

    public function __construct()
    {
             //print('C').PHP_EOL;

        return;
    }

    public function __destruct()
    {
         if (self::$verbose == True)
            print('D').PHP_EOL;
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
       return (file_get_contents('CFormGet.doc.txt'));
    }

}
?>
<?php
$session = new CSession();

//print 'session status get '.$_SESSION["status"].'<br />';
/*$formget = new CFormGet;
foreach ($_POST as $key => $value)
print ($value.'<br />');*/
//$_SESSION["user"]=$_POST['email'];
//$_SESSION["valide"]='ok';
//print ('session : '.$_SESSION["user"].'<br />');
if ($_SESSION["valide"]=='oui') {header('Location: index.php');}
//header('index.php');
?>