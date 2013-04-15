<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '0');

include('db.php');

$sql = "select SQL_NO_CACHE d.ID as ID, 
			d.firstname as firstname, 
			d.lastname as lastname, 
			d.age as age, 
			d.city as city, 
			d.state_id as state_id,
 			d.timezone as timezone, 
 			d.job as job, 
 			r.relationship as relationship, 
 			o.orientation as orientation, 
 			d.kids as kids,
			d.kids_ages as kids_ages, 
			d.summary as summary, 
			d.email as email, 
			d.mobile as mobile, 
			d.mobile_locale as mobile_locale,
			d.alias as alias, 
			d.timestamp as timestamp 
			from diarists d inner join relationships r on (r.id = d.relationship_id and r.language = d.language) inner join orientations o on (o.id = d.orientation_id and o.language = d.language) 
			where d.complete = 0 and d.data_day = 9";
$result = mysql_query($sql,$link);
	while($row = mysql_fetch_assoc($result)){
		$diarist_id = $row["ID"];		
		$age = $row["age"];
		$city = decrypt($row["city"]);
		$job = decrypt($row["job"]);
		$relationship = $row["relationship"];
		$orientation = $row["orientation"];
		$kids = $row["kids"];
		$kids_ages = $row["kids_ages"];
		$summary = decrypt($row["summary"]);
		$email = decrypt($row["email"]);
		$username = decrypt($row["alias"]);
		$reg_date = $row["timestamp"]; 

		$email_subject = "Unsubmitted Diarist #$diarist_id Diary";

		$email_body = "summary: $summary\r\n";
		$email_body .= "age: $age\r\n";
		$email_body .= "city: $city\r\n";
		$email_body .= "job: $job\r\n";
		$email_body .= "relationship: $relationship\r\n";
		$email_body .= "orientation: $orientation\r\n";
		$email_body .= "kids: $kids\r\n";
		$email_body .= "kids ages: $kids_ages\r\n";
		$email_body .= "email: $email\r\n";
		$email_body .= "username: $username\r\n";
		$email_body .= "registration date: $reg_date\r\n";

		$email_body .= "\r\n:::  ENTRIES  :::\r\n\r\n";

		$sql2 = "select * from entries where diarist_id = $diarist_id order by day, ID";
		$result2 = mysql_query($sql2, $link);
		$day_loop = "";

		while($row2 = mysql_fetch_assoc($result2)){
			$source = $row2["source"];
			$timestamp = $row2["time_stamp"];
			$entry_time = $row2["entryTime"];
			$subject = decrypt($row2["subject"]);
			$body = decrypt($row2["body"]);
			$message_id = $row2["message_id"];
			$reference_info = $row2["reference_info"];
			$day = $row2["day"];
			if($day != $day_loop){
				$email_body .= "\r\n\r\nDay $day\r\n";
			}
			$email_body .= "$entry_time $subject (via $source) $body\r\n";
			$day_loop = $day;	
		}

		$email_body .= "\r\n:::  QUESTION ANSWERS  :::\r\n\r\n";

		$sql3 = "select 
					a.answer as answer, 
					a.question_id as question_id, 
					q.ID as ID,
					q.question as question 
				from answers a 
					inner join questions2 q on a.question_id = q.id 
				where a.diarist_id = $diarist_id";

		$result3 = mysql_query($sql3, $link);

		while($row3 = mysql_fetch_assoc($result3)){
			$question = $row3["question"];
			$answer = decrypt($row3["answer"]);
			// $email_body .= "question: $question\r\n";
			$email_body .= "answer: $answer\r\n\r\n";
		}
		mail("developer@thediaryproject.net", $email_subject, $email_body, "From: diaryhelper@thediaryproject.net");
}

?>