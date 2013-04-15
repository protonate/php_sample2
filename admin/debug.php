<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

include_once('../db.php');
include_once('../theme.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="icon" href="../favicon.ico" type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>sex diaries project - entries by time stamp</title>
	<link href="../main.css" rel="stylesheet" type="text/css" />
    <link href="admin.css" rel="stylesheet" type="text/css" />
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/black-tie/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-21045433-1']);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
</head>

<body>
<h1>debug head</h1>
<?php  
require_once("auth.php");
if(isset($admin_level))
{
?>
<h2>admin level set</h2>
<?php echo $admin_level;
} ?>
    <style>
        td{
           max-width: 480px; 
        }
    </style>
		<div id="header">
			<div id="logo" align="right"><img src="../account/images/en-header-sdp.jpg" /></div>
		</div>
        <hr />
		<h1>administration page</h1>
		<h3>entries by timestamp </h3>
		<?php
            $sql = "SELECT d.ID, d.age, d.job, e.time_stamp, e.entryTime, e.body from entries e INNER JOIN diarists d ON e.diarist_id = d.ID ORDER BY time_stamp";
			$result = mysql_query($sql,$link);
            echo $result;
		?>
		<table>
			<thead>
				<tr>
                    <td>date</td>
                    <td>time</td>
                    <td>entry time</td>
                    <td>body</td>
                    <td>age</td>
					<td>ID</td>
				</tr>
			</thead>
			<tbody>
			<?php  while($row = mysql_fetch_object($result)) {
					?>
                <tr>
					<td><?php echo date('F/j/Y', strtotime($row->time_stamp));?></td>
                    <td><?php echo date('g:i:s a', strtotime($row->time_stamp));?></td>
					<td><?php echo $row->entryTime;?></td>
					<td><?php echo decrypt($row->body);?></td>
					<td><?php echo $row->age;?></td>
					<td><?php echo $row->ID;?></td>
				</tr>
			<?php  } ?>
			</tbody>
        </table>


</body>
</html>

