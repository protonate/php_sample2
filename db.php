<?php 
//db connection
$db_server = "localhost";
$db_user = "REDEACTED";
$db_password = "REDACTED";
$db_database = "REDACTED";

$link = mysql_connect($db_server, $db_user, $db_password)  or  die (" È impossibile  contattare  il  database<br />" . mysql_error());
mysql_select_db($db_database) or die ("È impossibile individuare il database<br />" . mysql_error());

$locking = "off"; //turn on locking IP address to session, turn this off if users are complaining about losing their session/login
$clearkey = "REDACTED"; //encryption key, DO NOT CHANGE 

function encrypt($text) 
{

//return $text;

	if($text == "" || !isset($text)){
		return;
	}	
	global $clearkey;
	$key=base64_decode($clearkey);
	$td = mcrypt_module_open('tripledes','','ecb','');
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	$init_test = mcrypt_generic_init($td, $key, $iv);
	if( ($init_test < 0) || ($init_test === false)){
		echo "error with encryption";
	}
	$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
	mcrypt_generic_init($cipher, $key, $iv);
	$decrypted = mcrypt_generic($cipher,$text);
	mcrypt_generic_deinit($cipher);
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
		//returns cyphertext and initilization vector (iv) for storage in database as a comma separated string
	return (implode('%%',array(base64_encode($decrypted), base64_encode($iv) ) ));
}

function decrypt($text)
{

	if($text == "" || !isset($text)){
		return $text;
	}
	
	global $clearkey;
	$encdata=explode('%%',$text);
	if(count($encdata) < 2){
		return $text;
	}
	if($encdata[0] == "" || !isset($encdata[0])){
		return $text;
	}
	
	$encrypted_text=$encdata[0];
	$iv=$encdata[1];
	if(strlen($iv) != 12){
		return $text;
	}
	$key=base64_decode($clearkey);
	$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
	$init_test = mcrypt_generic_init($cipher, $key, base64_decode($iv));
	if( ($init_test < 0) || ($init_test === false)){
		echo  'something is wrong';		
		return $text;
	}
	$decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));
	mcrypt_generic_deinit($cipher);
	$last_char=substr($decrypted,-1);
	return rtrim($decrypted, "\0");
}

?>
