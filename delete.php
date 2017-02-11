<?php
//if($nom == 'valeur' ) {print 'ok';}
header('content-type : text/plain');
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1';
$ajax = '<div><p><strong>This is changed via Ajax</strong></p></div>';
echo $ajax;

/*
/delete.php?request=ajax
if(!isset($_GET['request']) || $_GET['request'] != 'ajax') {
    die();
}
// rest of the code ...
*/
?>