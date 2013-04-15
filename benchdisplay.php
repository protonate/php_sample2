<form action="" method="POST">
	<input type="submit" name="delete" value="delete entries">
</form>
<form action="" method="POST">
	<input type="submit" name="refresh" value="refresh without delete">
</form>

<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '1');
 
include('db.php');

if(isset($_POST["delete"])){
	$sql = "delete from Stats";
	mysql_query($sql, $link);
}

$time["it_dev"] = 0;
$time["it_test"] = 0;
$sql = "select * from Stats order by time desc";
$stats_result = mysql_query($sql, $link);
if(mysql_num_rows($stats_result) > 0){
	while($stat = mysql_fetch_assoc($stats_result)){
		if(strpos($stat["path"], "it_test") === false){
			$stats["it_dev"][] = $stat;
			$time["it_dev"] = bcadd($time["it_dev"], $stat["time"], 10);
		}
		else
		{		$stats["it_test"][] = $stat;
			$time["it_test"] = bcadd($time["it_test"], $stat["time"], 10);
		}
	}	

	echo "<h2>it_dev benchmark total: " . $time["it_dev"] . "</h2><p>";
	echo "<h2>it_orig benchmark total: " . $time["it_test"] . "</h2><p>";
	?>
	<table style="display:inline-block;float:left;width:550px;">
	<tr>
	<td> dev time</td>
	<td> dev path</td>
	<tr>
	<td>
	<?
	foreach($stats["it_dev"] as $key => $value){
		echo $value["time"] . "<br>";
	}
	?>
	</td>
	<td>
	<?
	foreach($stats["it_dev"] as $key => $value){
		echo $value["path"] . "<br>";
	}
	?>
	</td>
	</tr>
	</table>

	<table style="display:inline-block;float:left;width:550px;">
	<tr>
	<td> orig time</td>
	<td> orig path</td>
	<tr>
	<td>
	<?
	foreach($stats["it_test"] as $key => $value){
		echo $value["time"] . "<br>";
	}
	?>
	</td>
	<td>
	<?
	foreach($stats["it_test"] as $key => $value){
		echo $value["path"] . "<br>";
	}
	?>
	</td>
	</tr>
	</table>
<? }else{ 

echo "no data";
}
?>