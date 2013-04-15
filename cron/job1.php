<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '0');
 
//mail("n8guisinger@gmail.com", "it cron ran","yes it did","From: " . $adminemail);
//mail("brandon.selway@gmail.com", "it cron ran","yes it did","From: " . $adminemail);

// active = 9 for admin level debug only
$active = 1;
$sms = 0;
$data_day_limit = 38; //number of days data day will increment up until
$dev="_dev"; //suffix for development directory 

include('db.php');
require("googlevoice.php");
define('GV_USER', 'sexdiariesproject@gmail.com');
define('GV_PASS', 'diary!app');

$gv = new GoogleVoice(GV_USER, GV_PASS);

// get server hour (server is on east coast time)
$time = localtime();
$server_hour = $time[2];
// $gmt_hour = $server_hour + 4;  // BST
$gmt_hour = $server_hour + 5;  // GMT
$gmt_hour = ($gmt_hour > 23) ? $gmt_hour - 24 : $gmt_hour;
$gmt_hour = ($gmt_hour < 0) ? $gmt_hour + 24 : $gmt_hour;
$am_pm = "";
$text="";

//		create array of messages to send to be references later
		$sql = "select * from messages";
		$messages_result = mysql_query($sql, $link);
		while($message = mysql_fetch_object($messages_result)){
			$messagetosend[$message->language][$message->day][$message->am_pm]['ID'] = $message->ID;
			$messagetosend[$message->language][$message->day][$message->am_pm]['subject'] = $message->subject;
			$messagetosend[$message->language][$message->day][$message->am_pm]['text'] = $message->text;
			$messagetosend[$message->language][$message->day][$message->am_pm]['textshort'] = $message->textshort;
		}

// get diarists that are active
$sql = "select * from diarists where active = $active";
$diarists_result = mysql_query($sql, $link);
while($diarists = mysql_fetch_object($diarists_result)){
	
	$missingdiarist = false;
	
	// for each diarist get ID and diarist_hour
	$diarist_id = $diarists->ID;
	$timezone = $diarists->timezone;
	$diarist_hour = $gmt_hour + $timezone;
	$diarist_hour = ($diarist_hour > 23) ? $diarist_hour - 24 : $diarist_hour;
	$diarist_hour = ($diarist_hour < 0) ? $diarist_hour + 24 : $diarist_hour;
	$data_day = $diarists->data_day;
	$email = decrypt($diarists->email);
	$mobile_locale = $diarists->mobile_locale;
	$mobile = decrypt($diarists->mobile);
	$is_email = $diarists->isEmail;
	$is_sms = $diarists->isSMS;
	$language = $diarists->language;
	
	if($email == "xxx@xxx.net")$missingdiarist = true;
	
	$allowed_zones = array("-10.0","-9.0","-8.0","-7.0","-6.0","-5.0","-4.0");
	if(in_array($timezone, $allowed_zones) && $language == "en" && $is_sms == 1){ //if US number and can receive texts
		$sms = 1;
	}else{
		$sms = 0;
	}
		
	// if diarist_hour = midnight, increment diarist data day
	if($diarist_hour == 0 && !$missingdiarist){
		$data_day++;
		$sql = "update diarists set data_day = $data_day";
		if($data_day > $data_day_limit && $diarist_id != 0) {
			$sql .= ", active = 2";
		}		
		$sql.=" where ID = $diarist_id";
		mysql_query($sql, $link);		
	}
	
	if($data_day !=0 && $data_day < 10 && !$missingdiarist) {
	
// if diarist hour is send hour (0600 and 1900)	
	if($data_day !=0 && ($diarist_hour == 6 || $diarist_hour == 18) && $data_day < 10) 	{
		$summary = ""; // used if pm email		
		if($diarist_hour == 6){
			$am_pm = 1;
		}
		if($diarist_hour == 18){
			$am_pm = 2;
			
				if($data_day < 8){
			
					//language based summary
					include_once( $language . "-" . "job1_trans.php" );
					
					$summary = "\r\n\r\n\r\n";
					$summary .= $diary_balance[$language];			
					$summary .= "\r\n\r\n";

					$sql = "select SQL_NO_CACHE day from entries where diarist_id = $diarist_id ";
					for($d = 1; $d <= $data_day; $d++){
						$sql .= ($d === 1) ? "and (day = $d" : " or day = $d";
						$entries_cnt[$d] = 0;
					}
					$sql.= ")";
					
					$entries_result = mysql_query($sql, $link);
					while($entries_row = mysql_fetch_object($entries_result)){
						$entries_cnt[$entries_row->day]++;
					}
					
					for($d = 1; $d <= $data_day; $d++){
						$day_ordinal = $day_ordinals[$language][$d-1];
						if($entries_cnt[$d] > 0) {

							$summary .= $day_ordinal . ": ";
							$summary .= $yousent[$language] . " ";
							$summary .= $entries_cnt[$d] . " ";
							$summary .= $contributions[$language];
							$summary .= "." . "\r\n";
						}
						else {
							$summary .= $day_ordinal . ": ";
							$summary .= $yousent[$language] . " ";
							$summary .= "0 ";
							$summary .= $contributions[$language];
							$summary .= "." . "\r\n";
						}					
					}
				}
			}
			
		if(isset($messagetosend[$language][$data_day][$am_pm]['text'])){
		
			$thissubject = $messagetosend[$language][$data_day][$am_pm]['subject'];

			$thistext = $messagetosend[$language][$data_day][$am_pm]['text'];
			
			$thistextshort = $messagetosend[$language][$data_day][$am_pm]['textshort'];
		
		}
		
		if($am_pm == 2 && $data_day < 8){
			$thistext .= $summary;
		}

		
		if(isset($messagetosend[$language][$data_day][$am_pm]['text'])){
			// if email, send email
			$headers = "From: diaryhelper@thediaryproject.net";
			if($data_day == 9){
				$headers .= "\r\nContent-type: text/html; charset=ISO-8859-1\r\n";
			}
			if($diarists->isEmail == 1){
				mail($email, $thissubject, $thistext, $headers);
			}

			// if sms, send sms
			if($sms == 1) {
		//		$gv->sms($mobile_locale . $mobile, $textshort);
				$gv->sms($mobile, $thistextshort);
			}
				
			// log message id
			$lastMessageID = $messagetosend[$language][$data_day][$am_pm]['ID'];
			$sql = "update diarists set lastMessageID = $lastMessageID where ID = $diarist_id";
			mysql_query($sql, $link);
			$sql = "insert into log_table (type, message, message_id, diarist_id) values ('sent message', 'sent message id $lastMessageID to diarist ID $diarist_id', $lastMessageID, $diarist_id)";
			mysql_query($sql, $link);	
		}
	}	
}

}

?>