<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchstart.php"); ?>
<?php  
include('../theme.php');

if( !strpos($_SERVER["SCRIPT_URL"], $prefix) ){
	//include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchend.php"); 
	header('Location: ' . $prefix . 'index.php'); 
	exit;
}

?>