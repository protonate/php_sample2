<?php 
 error_reporting(E_ALL);
 ini_set('display_errors', '0');

 
 //mail("n8guisinger@gmail.com", "it cron ran","yes it did","From: diaryhelper-it@sexdiariesproject.com");
//mail("brandon.selway@gmail.com", "i2t cron ran","yes it did","From: diaryhelper-it@sexdiariesproject.com");

$active=1;
$language = "en";
$server = "{thediaryproject.net/imap}INBOX";
$user = "REDACTED";
$pass = "REDACTED";
$conn = imap_open("{localhost/ssl/novalidate-cert}INBOX", $user, $pass)
or die(mail("developer@thediaryproject.net","imap server error","job1.php not able to connect to imap server","From: admin@sexdiariesproject.com"));
$headers = @imap_headers($conn);
if(is_array($headers)){

include('db.php');	

	$numEmails = count($headers);

	$sql = "select ID, email, origemail, mobile, origmobile, timestamp, timezone, data_day, language from diarists order by ID DESC";
	$result = mysql_query($sql,$link);
	while($d = mysql_fetch_assoc($result)){
		$diarists[] = $d;
	}

	for($i = 1; $i <= $numEmails; $i++) {
		$mailHeader = imap_headerinfo($conn, $i);
		$num = $mailHeader->Msgno;
		$st = imap_fetchstructure($conn, $num);
		if (!empty($st->parts)) {
		    for ($k = 0, $j = count($st->parts); $k < $j; $k++) {
		        $part = $st->parts[$k];
		        if ($part->subtype == 'PLAIN') {
		             $body = imap_qprint( imap_fetchbody($conn, $num, $k+1));		        		
		        }
		     }
		} else {
			if($st->encoding == 4){
		    $body = imap_qprint( imap_body($conn, $num) );
//					mail("n8guisinger@gmail.com","parts","check entries table for issues with $body","From: admin@sexdiariesproject.com");
			}else{
		    $body = imap_body($conn, $num);
//					mail("n8guisinger@gmail.com","noparts","check entries table for issues with $body","From: admin@sexdiariesproject.com");
			}
		}

		$from = $mailHeader->fromaddress;
		$lt = strpos($from,"<");
		$lt++;
		$gt = strpos($from, ">");
		if(isset($lt) && isset($gt)){
			$email = substr($from,$lt, $gt-$lt);
		}
		else {
			$email = $from;
		}
		$subject = (isset($mailHeader->subject)) ? $mailHeader->subject : "";
		$date = $mailHeader->date;
		$message_id = $mailHeader->message_id;
		$reference_info = (isset($mailHeader->references)) ? $mailHeader->references : "";
				
		unset($row);
		$row = array();

		foreach($diarists as $key => $diarist){
			if($email == decrypt($diarist["origemail"]) || $email == decrypt($diarist["email"])){
				$row = $diarist;
				break;
			}
		}
		
		$diaristID = 0;
		$source = "";
		$reg_time = "";
		$timezone = 0;
		$day = 0;
		
		if(count($row) > 0){

			$diaristID = $row["ID"];
			$source = "email";
			$reg_time = strtotime($row["timestamp"]);
			$timezone = $row["timezone"];
			$language = $row["language"];
			if($row["data_day"] > 8){
				$folder = "INBOX.archive";
				$move = imap_mail_move($conn,$i,$folder);
				continue;
			}
			
			}else{
			$from = $mailHeader->fromaddress;
			$needles = array("(",")","-", " ", "\"");
			$mobile = substr(str_replace($needles,"",$from),0,10);
			
			foreach($diarists as $key => $diarist){
				if($mobile == decrypt($diarist["mobile"]) || $mobile == decrypt($diarist["origmobile"])){
					$row = $diarist;
					break;
				}
			}

			if(count($row) > 0){
				$diaristID= $row["ID"];
				$source = "sms";
				$reg_time = strtotime($row["timestamp"]);
				$timezone = $row["timezone"];
				$language = $row["language"];
				if($row["data_day"] > 8){
					$folder = "INBOX.archive";
					$move = imap_mail_move($conn,$i,$folder);
					continue;
				}
			}
			else{
				$from = $mailHeader->fromaddress;
				$needles = array("(",")","-", " ", "\"");
				$mobile = substr($subject,strpos($subject, "("), 14);
				$mobile = str_replace($needles, "", $mobile);

				foreach($diarists as $key => $diarist){
					if($mobile == decrypt($diarist["mobile"]) || $mobile == decrypt($diarist["origmobile"])){
						$row = $diarist;
						break;
					}
				}
			
				if(count($row) > 0){
					$diaristID= $row["ID"];
					$source = "voice";
					$reg_time = strtotime($row["timestamp"]);
					$timezone = $row["timezone"];
					$language = $row["language"];
					if($row["data_day"] > 8){
						$folder = "INBOX.archive";
						$move = imap_mail_move($conn,$i,$folder);
						continue;
					}
				}
				else {
					mail("developer@thediaryproject.net","missing diarist","check entries table for issues with " . $from,"From: admin@sexdiariesproject.com");
					mail($email
						, "Error: Your Diary Entry Was Not Submitted!"
						,"The diary entry that you just submitted came from an unknown email address. Please resend it from the email address that you used to register.\n\nCheers,\n-DiaryHelper"
						,"From: " . $user
					);
				}
			}
		}

		$timestamp = date("Y-m-d H:i:s", strtotime($mailHeader->date));
		$message_time = strtotime($timestamp) + (60*60*5) + (60*60*$timezone);
		$reg_date = $reg_time + (60*60*5) + (60*60*$timezone);
		$entryTime = date("g:i a", $message_time);
		$am_pm_str = date("a", $message_time);
		$am_pm = ($am_pm_str == "am") ? 1 : 2;		
		$year = date("Y", $reg_date);
		$day = date("d", $reg_date);
		$month = date("m", $reg_date);
		$day++;
		$reg_midnight = mktime(0,0,0,$month,$day,$year);			
		$elapsed_seconds = $message_time - $reg_midnight;
		$day = ceil($elapsed_seconds / (60*60*24));
		if($day < 1){
			$day = 1;
			$entryTime = "day 0 " . $entryTime;
		}			

		//BODY NEEDS EDITING TO REMOVE EXTRANEOUS reply stuff
		$replypattern = '%([\n\r].*)?' . $user . '.*$%s';		
		$body2 = preg_replace($replypattern, "", $body);
			
		//remove extra line breaks
		$replypattern2 = '%[\r\n]+%';
		$body3 = preg_replace($replypattern2, "\n", $body2);
		
		if(trim($body3) !== '')$body = trim($body3);
			
		$sql = "insert into entries (diarist_id, time_stamp, entryTime, day, am_pm, fromaddress, source, subject, body, message_id, reference_info, language) values (";
		$sql .= "'" . mysql_real_escape_string($diaristID) . "', ";
		$sql .= "'" . mysql_real_escape_string($timestamp) . "', ";
		$sql .= "'" . mysql_real_escape_string($entryTime) . "', ";
		$sql .= "'" . mysql_real_escape_string($day) . "', ";
		$sql .= "'" . mysql_real_escape_string($am_pm) . "', ";
		$sql .= "'" . mysql_real_escape_string(encrypt($email)) . "', ";
		$sql .= "'" . mysql_real_escape_string($source) . "', ";
		$sql .= "'" . mysql_real_escape_string(encrypt($subject)) . "', ";
		$sql .= "'" . mysql_real_escape_string(encrypt($body)) . "', ";
		$sql .= "'" . mysql_real_escape_string($message_id) . "', ";
		$sql .= "'" . mysql_real_escape_string($reference_info) . "', ";
		$sql .= "'" . mysql_real_escape_string($language) . "')";
			
		$result = mysql_query($sql,$link);			
		
		mysql_query("insert into log_table (type, message) values ('sql', '$sql')", $link);
		mysql_query("insert into log_table (type, message) values ('mysql error', '" . mysql_errno() . ": " . mysql_error() . "'", $link);
		$folder = "INBOX.archive";
		$move = imap_mail_move($conn,$i,$folder);
	}
	imap_expunge($conn);		
}

?>
