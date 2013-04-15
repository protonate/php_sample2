<form action="searchphone.php" method="POST">
    <input type="text" name="q" value="phone to search for(no spaces)">
    <input type="submit" value="search">
</form>
<?php
ini_set('display_errors', '0');
   
include_once('../db.php');

$sql = "select * from entries e JOIN diarists d ON e.diarist_id = d.ID order by d.id DESC";
$diarist_result = mysql_query($sql, $link);
    while($row = mysql_fetch_object($diarist_result)) {
        $mobile = decrypt($row->mobile);
        $origmobile = decrypt($row->origmobile);
        if(stripos($mobile, $_POST['q']) !== false || stripos($origmobile, $_POST['q']) !== false){
            $e[] = $row;
        }
    }

    echo "query: {$_POST['q']}<br/>";
    echo "results: ".count($e)."<br/>";
foreach($e as $row){
    $mobile = decrypt($row->mobile);
    $origmobile = decrypt($row->origmobile);
    $body = decrypt($row->body);            
    $fromaddress = decrypt($row->fromaddress);            
    $diarist_id = $row->diarist_id;
    $source = $row->source;
    $entrytime = $row->entryTime;
    $day = $row->day;    
    echo "<p>";
    echo "diarist id: $diarist_id<br/>";
    echo "diarist text: $body<br/>";
    echo "source: $source<br/>";
    echo "fromaddress: $fromaddress<br/>";
    echo "entrytime: $entrytime<br/>";
    echo "day: $day<br/>";
    echo "</p>";
}

?>

