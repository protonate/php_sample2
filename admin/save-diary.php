
<?php  
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once('../db.php');

$form = $_POST["form-type"];
$return_url = $_POST["return-url"];
$diarist_id = $_POST["diarist-id"];

if($form == "diary"){
	$diary = mysql_real_escape_string(encrypt($_POST["diary-text"]));
	$sql = "select count(ID) as cnt from diaries where diarist_id = $diarist_id";
	$result = mysql_query($sql, $link);
	$row = mysql_fetch_object($result);
	if($row->cnt > 0) {
		$sql = "update diaries set diary = '" . $diary . "' where diarist_id = $diarist_id";		
	} else {
		$sql = "insert into diaries (diarist_id, diary) values ($diarist_id, '" . encrypt($diary) . "')";
	}
//	echo $sql;
//	exit();
	mysql_query($sql, $link) or die(mysql_error());		
}

header("Location: $return_url");
?>
