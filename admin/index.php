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
	<title>sex diaries project - administration</title>
	<link href="../main.css" rel="stylesheet" type="text/css" />
    <link href="admin.css" rel="stylesheet" type="text/css" />
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/black-tie/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-21045433-1']);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
</head>

<body>
<?php  
require_once("auth.php");
if(isset($admin_level))
{
	$sql_base = "select d.*, 
	(select orientation from orientations o where d.orientation_id = o.ID and language = '$lang') as orientation, 
	(select count(ID) from entries e where d.ID = e.diarist_id) as total_entries, 
	(select count(ID) from entries e where d.ID = e.diarist_id and time_stamp between d.timestamp and addtime(d.timestamp, '1 0:0:0')) as day0_entries,
	(select count(ID) from entries e where d.ID = e.diarist_id and time_stamp between addtime(d.timestamp, '1 0:0:0') and addtime(d.timestamp, '2 0:0:0')) as day1_entries,
	(select count(ID) from entries e where d.ID = e.diarist_id and time_stamp between addtime(d.timestamp, '2 0:0:0') and addtime(d.timestamp, '3 0:0:0')) as day2_entries,
	(select count(ID) from entries e where d.ID = e.diarist_id and time_stamp between addtime(d.timestamp, '3 0:0:0') and addtime(d.timestamp, '4 0:0:0')) as day3_entries,
	(select count(ID) from entries e where d.ID = e.diarist_id and time_stamp between addtime(d.timestamp, '4 0:0:0') and addtime(d.timestamp, '5 0:0:0')) as day4_entries,
	(select count(ID) from entries e where d.ID = e.diarist_id and time_stamp between addtime(d.timestamp, '5 0:0:0') and addtime(d.timestamp, '6 0:0:0')) as day5_entries,
	(select count(ID) from entries e where d.ID = e.diarist_id and time_stamp between addtime(d.timestamp, '6 0:0:0') and addtime(d.timestamp, '7 0:0:0')) as day6_entries,
	(select count(ID) from entries e where d.ID = e.diarist_id and time_stamp between addtime(d.timestamp, '7 0:0:0') and addtime(d.timestamp, '8 0:0:0')) as day7_entries
	from diarists d";
	                           
    if(isset($_REQUEST['domain']))$wheres[] = "(d.domain = '{$_REQUEST['domain']}')";
    
	if($admin_level == 2){
		$wheres[] =  "((d.timezone < -8 or d.timezone > -5) and d.timezone != '')";
	}
	?>
    <style>
        td{
            max-width: 180px;
        }
    </style>
		<div id="header">
			<div id="logo" align="right"><img src="../account/images/<?=$style_prefix;?>header.png" /></div>
		</div>
		<a href="fileed.php">Translation Tool</a><hr />
        <form action="gencsv.php" method="POST">
                         CSV of "first name, last name, email" for:<br />
            <input type="checkbox" name="diarists" value="diarists" checked="checked">new diarists and/or 
            <input type="checkbox" name="original" value="original" checked="checked">original diarists and/or 
            <input type="checkbox" name="italian" value="italian" checked="checked">italian diarists and/or 
            <input type="checkbox" name="wordpress" value="wordpress" checked="checked">wordpress commenters since:            
            <input id="date" style="cursor:pointer;">

            <input type="hidden" id="csv_date" name="date">
            <input type="submit" value="Generate">
        </form>
        <hr />
		<script>
            jQuery(document).ready(function(){
                        jQuery("#date").datepicker({altField: '#csv_date', altFormat: '@'});                
            })
        </script>
        
        <form action="diaristinfo.php" method="POST">
            <input type="text" name="ident" value="ID or EMAIL">
            <input type="submit" value="view hidden details">
        </form>
        
        <form action="searchentries.php" method="POST">
            <input type="text" name="q" value="text to search for">
            <input type="submit" value="search">
        </form>
        
		<form action="searchphone.php" method="POST">
			<input type="text" name="q" value="phone to search for (nospaces)">
			<input type="submit" value="search">
		</form>
		
		<h1>administration page</h1>	
		<h3>active diarists</h3>
		<?php 
            $wheres['active'] = "(d.active = 1)";
            $orderby = " order by d.ID";
             
//			if($admin_level == 2){
				//$sql = $sql_base . " and d.active = 1 order by d.ID"; 
//			}
//			else {
//				$wheres[] = 
                //$sql = $sql_base . " where d.active = 1 order by d.ID";
//			}
            $sql = $sql_base . " WHERE " . implode(" AND ", $wheres) . $orderby;
            //mail("brandon.selway@gmail.com", "wheres", $sql, "From: iloveyou@love.com");
			$result = mysql_query($sql,$link);
            unset($wheres['active']);			
		?>
		<table>
			<thead>
				<tr>
					<td>ID</td>
                    <td>domain</td>
					<td></td>
					<td>day</td>
					<td>notes</td>                    
					<td>city</td>
					<td>username</td>
					<td>email</td>
                    <td>orientation</td>
                    <td>age</td>
					<td>total entries</td>
					<td>day 0 entries</td>
					<td>day 1 entries</td>
					<td>day 2 entries</td>
					<td>day 3 entries</td>
					<td>day 4 entries</td>
					<td>day 5 entries</td>
					<td>day 6 entries</td>
					<td>day 7 entries</td>
				</tr>
			</thead>
			<tbody>
			<?php  while($row = mysql_fetch_object($result)) {
				$diarist_id = $row->ID;
				$ed_notes = getNotesForm($diarist_id, $link);
					?>
				<tr>
                    <td><a name="<?php echo $row->ID;?>"><?php echo $row->ID;?></a></td>
					<td><a href="?domain=<?php echo $row->domain;?>"><?php echo $row->domain;?></a></td>
					<td><?php  echo "<a href='entries2.php?d=$diarist_id'>view</a>";?></td>
					<td><?php echo $row->data_day;?></td>
					<td><?php echo $ed_notes;?></td>
					<td><?php echo decrypt($row->city);?></td>
					<td><?php echo decrypt($row->alias);?></td>				
					<td><?php echo decrypt($row->email);?></td>
					<td><?php echo $row->orientation;?></td>
					<td><?php echo $row->age;?></td>
					<td><?php echo $row->total_entries;?></td>
					<td><?php echo $row->day0_entries;?></td>
					<td><?php echo $row->day1_entries;?></td>
					<td><?php echo $row->day2_entries;?></td>
					<td><?php echo $row->day3_entries;?></td>
					<td><?php echo $row->day4_entries;?></td>
					<td><?php echo $row->day5_entries;?></td>
					<td><?php echo $row->day6_entries;?></td>
					<td><?php echo $row->day7_entries;?></td>
				</tr>
			<?php  } ?>	
			</tbody>
		</table>
		<h3>completed diarists</h3>
		<?php 

            $wheres['activepublished'] = "(d.active = 2 and d.published = 0)";
            $orderby = " order by d.ID"; 
//			if($admin_level == 2){
//				$sql = $sql_base . " and d.active = 2 and d.published = 0 order by d.ID"; 
//			}
//			else {
//				$sql = $sql_base . " where d.active = 2 and d.published = 0 order by d.ID";
//			}
            $sql = $sql_base . " WHERE " . implode(" AND ", $wheres) . $orderby;
			$result = mysql_query($sql,$link);
            unset($wheres['activepublished']);
            unset($orderby);
		?>
		<table>
			<thead>
				<tr>
                    <td>ID</td>
					<td>domain</td>
					<td>view</td>
					<td>day</td>
					<td>status</td>
					<td>notes</td>                    
					<td>city</td>
					<td>username</td>
					<td>email</td>
                    <td>orientation</td>
                    <td>age</td>
					<td>total entries</td>
					<td>day 0 entries</td>
					<td>day 1 entries</td>
					<td>day 2 entries</td>
					<td>day 3 entries</td>
					<td>day 4 entries</td>
					<td>day 5 entries</td>
					<td>day 6 entries</td>
					<td>day 7 entries</td>
				</tr>
			</thead>
			<tbody>
			<?php  while($row = mysql_fetch_object($result)) {
				$diarist_id = $row->ID;
				$ed_notes = getNotesForm($diarist_id, $link);
					?>
				<tr>
                    <td><a name="<?php echo $row->ID;?>"><?php echo $row->ID;?></a></td>
					<td><a href="?domain=<?php echo $row->domain;?>"><?php echo $row->domain;?></a></td>
					<td><?php  echo "<a href='edit-diary.php?d=$diarist_id'>edit</a>";?></td>
					<td><?php echo $row->data_day;?></td>
					<td><?php echo $ed_notes;?></td>
					<td><?php echo decrypt($row->city);?></td>
					<td><?php echo decrypt($row->alias);?></td>				
					<td><?php echo decrypt($row->email);?></td>
					<td><?php echo $row->orientation;?></td>
					<td><?php echo $row->age;?></td>
					<td><?php echo $row->total_entries;?></td>
					<td><?php echo $row->day0_entries;?></td>
					<td><?php echo $row->day1_entries;?></td>
					<td><?php echo $row->day2_entries;?></td>
					<td><?php echo $row->day3_entries;?></td>
					<td><?php echo $row->day4_entries;?></td>
					<td><?php echo $row->day5_entries;?></td>
					<td><?php echo $row->day6_entries;?></td>
					<td><?php echo $row->day7_entries;?></td>
				</tr>
			<?php  } ?>	
			</tbody>
		</table>        
		<h3>published diarists</h3>
<?php 
/*		if($admin_level == 2){
				$sql = $sql_base . " and d.active = 2 and d.published = 1 order by d.ID"; 
			}
			else {
				$sql = $sql_base . " where d.active = 2 and d.published = 1 order by d.ID";
			}
*/
            $wheres['active'] = "(d.active = 2 and d.published = 1)";
            $orderby = " order by d.ID";
            $sql = $sql_base . " WHERE " . implode(" AND ", $wheres) . $orderby;
			$result = mysql_query($sql,$link);
		?>
		<table>
			<thead>
				<tr>
                    <td>ID</td>
					<td>domain</td>
					<td>view</td>
					<td>day</td>
					<td>status</td>
					<td>notes</td>                    
					<td>city</td>
					<td>username</td>
					<td>email</td>
                    <td>orientation</td>
                    <td>age</td>
					<td>total entries</td>
					<td>day 0 entries</td>
					<td>day 1 entries</td>
					<td>day 2 entries</td>
					<td>day 3 entries</td>
					<td>day 4 entries</td>
					<td>day 5 entries</td>
					<td>day 6 entries</td>
					<td>day 7 entries</td>
				</tr>
			</thead>
			<tbody>
			<?php  while($row = mysql_fetch_object($result)) {
				$diarist_id = $row->ID;
				$ed_notes = getNotesForm($diarist_id, $link);
					?>
				<tr>
                    <td><a name="<?php echo $row->ID;?>"><?php echo $row->ID;?></a></td>
					<td><a href="?domain=<?php echo $row->domain;?>"><?php echo $row->domain;?></a></td>
					<td><?php  echo "<a href='entries2.php?d=$diarist_id'>view</a>";?></td>
					<td><?php echo $row->data_day;?></td>
					<td><?php echo $ed_notes;?></td>
					<td><?php echo decrypt($row->city);?></td>
					<td><?php echo decrypt($row->alias);?></td>				
					<td><?php echo decrypt($row->email);?></td>
					<td><?php echo $row->orientation;?></td>
					<td><?php echo $row->age;?></td>
					<td><?php echo $row->total_entries;?></td>
					<td><?php echo $row->day0_entries;?></td>
					<td><?php echo $row->day1_entries;?></td>
					<td><?php echo $row->day2_entries;?></td>
					<td><?php echo $row->day3_entries;?></td>
					<td><?php echo $row->day4_entries;?></td>
					<td><?php echo $row->day5_entries;?></td>
					<td><?php echo $row->day6_entries;?></td>
					<td><?php echo $row->day7_entries;?></td>
				</tr>
			<?php  } ?>	
			</tbody>
		</table>        
<?php  }

function getNotesForm($diarist_id, $link) {
	
	$sql = "select * from editor_notes where diarist_id = $diarist_id";
	$e_notes_result = mysql_query($sql, $link);
	$e_notes_row = mysql_fetch_object($e_notes_result);
	$e_note = ($e_notes_row) ? $e_notes_row->note : NULL;	
	$form_str = "<form id='notesForm" . $diarist_id . "' name='notesForm" . $diarist_id . "' action='process-notes.php' method='post'>";	
	$form_str .=  '<textarea id="editor-note" name="editor-note">' . $e_note . '</textarea>';
	$form_str .= '	<input id="diarist-id" name="diarist-id" type="hidden" value="' . $diarist_id . '" />';
	$form_str .= '	<input id="return-url" name="return-url" type="hidden" value="' . $_SERVER["PHP_SELF"] . '?#d=' . $diarist_id . '" />';
	$form_str .= '	<input id="form-type" name="form-type" type="hidden" value="editor" />';
	$form_str .= '	<input type="submit" value="submit" id="submit-e-note" name="submit-e-note" />';	
	$form_str .= '</form>';
	return $form_str;

}


?>
	
</body>
</html>
