<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchstart.php"); ?>
<?php  
error_reporting(E_ALL);
ini_set("display_errors", "1");
    session_start();
    $_SESSION = array();
    session_destroy();

include("../theme.php");
//include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchend.php"); 
header("Location: ".$prefix."index.php");

?><?php ?>
