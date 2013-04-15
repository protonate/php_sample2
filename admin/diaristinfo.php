<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
header("Content-type: text/html; charset=utf-8");

include_once('../db.php');

header("Content-type: text/html; charset=utf-8");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="icon" href="../favicon.ico" type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>sex diaries project - administration</title>
	<link href="../main.css" rel="stylesheet" type="text/css" />
	<link href="admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="header">
		<div id="logo"><img src="../account/images/style-it-header.png" /></div>
	</div>
	<h1>view hidden details</h1>
	<p><a href="index.php">&lt;&lt; back</a></p>
	
	<?php 
	
		if(is_numeric($_POST['ident'])){
			$diarist_id = $_POST['ident'];
			$sql = "select * from diarists where id = $diarist_id";
			$result = mysql_query($sql,$link);
			$row = mysql_fetch_assoc($result);
		}else{
			$email = $_POST["ident"];
			$sql = "select * from diarists";
			$result = mysql_query($sql,$link);
			while($therow = mysql_fetch_assoc($result)){
				if($email == decrypt($therow["email"]) || $email == decrypt($therow["origemail"])){
				  $row = $therow;
				  break;
				}
			}
		}
		
		if(isset($row) && count($row) > 0) {
			$diarist_id = $row["ID"];
		} else {
			echo "does not exist";
			exit;
		}	
	
		$firstname = decrypt($row['firstname']);
		$lastname = decrypt($row['lastname']);
		$alias = decrypt($row['alias']);
		$password = decrypt($row['password']);
		$data_day = $row['data_day'];
		$timezone = $row['timezone'];
		$email = decrypt($row['email']);
		$origemail = decrypt($row['origemail']);
		$mobile = decrypt($row['mobile']);
		$origmobile = decrypt($row['origmobile']);
		$city = decrypt($row['city']);
		$age = $row['age'];
		$active = $row['active'];
		$complete = $row['complete'];
		$edited = $row['edited'];
		$published = $row['published'];
		$closed = $row['closed'];
		
		$status = '';
		if($active == 1) {
			$status = "in progress";
		} elseif ($active == 2 && $complete == 0) {
			$status = "pending diarist submit";		
		} elseif ($active == 2 && $complete == 1 && $edited == 0) {
			$status = "diary complete";				
		} else if ($active == 2 && $complete == 1 && $edited == 1 && $published == 0) {
			$status = "diary edited";
		} else if ($active == 2 && $complete == 1 && $edited == 1 && $published == 1 && $closed == 0) {
			$status = "diary published";
		} else if ($active == 2 && $complete == 1 && $edited == 1 && $published == 1 && $closed == 1) {
			$status = "diary closed";
		}

		?>
		<hr />
		<h3><a name="<?php echo $diarist_id ?>"></a>Diary for <?php echo "diarist id $diarist_id"; ?> </h3>
		<ul>
			<li>name: <?php echo $firstname . " " . $lastname; ?></li>
			<li>alias: <?php echo $alias; ?></li>
			<li>data day: <?php echo $data_day; ?></li>
            <li>status: <?php echo $status; ?></li>
			<li>timezone: <?php echo $timezone; ?></li>
			<li>email: <?php echo $email; ?></li>
			<li>original email: <?php echo $origemail; ?></li>
			<li>mobile: <?php echo $mobile; ?></li>
			<li>original mobile: <?php echo $origmobile; ?></li>
			<li>password: <?php echo $password; ?></li>
		</ul>
	<hr />
</body>
</html>