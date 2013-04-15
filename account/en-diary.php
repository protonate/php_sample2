<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchstart.php"); ?>
<?php  
error_reporting(E_ALL);
ini_set("display_errors", "1");
session_start();

header("Cache-Control: no-cache");
header("Content-type: text/html; charset=utf-8");
//mb_language('uni');
//mb_internal_encoding('UTF-8');

include_once("../db.php");
include("../theme.php");

if( !strpos($_SERVER["SCRIPT_URL"], $prefix) ){
  header("Location: " . $prefix . "diary.php"); 
  exit;
}

if($locking == "on" && $_SERVER["REMOTE_ADDR"] != decrypt($_SESSION["ip"])){
  header("Location: " . $prefix . "index.php?t=1");
  exit();
} 

$diaristID = $diarist_id = $_SESSION["ID"];
$data_day = $_SESSION["data_day"];
$timezone = $_SESSION["timezone"];
$complete = $_SESSION["complete"];

$current_time = date("g:i a", time() + (60*60*5) + (60*60*$timezone));

$shutoff = ($data_day > 38) ? 1 : 0;
$data_day = ($data_day > 7) ? 7 : $data_day;

$status = "";
$summary="";

  function sanitize($input){
   return stripslashes(str_replace("\\n","<br>&nbsp;", $input)); 
  }
  
  
/* ======================  SETTINGS ============================== */
$enable_form = 1;
$show_welcome = 0;
$show_settings = 0;
$show_sample = 0;
$updates = 0;
$disabled = "";
/* ======================  SETTINGS ============================== */


/* ======================  SET TABS ============================== */
for($i=1;$i<=7;$i++){
  if($i<=$data_day && $shutoff === 0){ //only day tabs before dataday available and only if its been less than shutoff point
    $class = ($i == $data_day) ? "class=\"tabimg currenttab\" " : "class=\"tabimg\" ";
    $day_tab[$i] =  "<a class=\"daylink\" data-day=\""
        .$i."\" href=\"#\"><img "
        .$class
        ."src=\"images/"
        .$style_prefix."day"
        .$i."-tab.jpg\" data-mouseover=\"images/"
        .$style_prefix."day"
        .$i."-tab-over.jpg\" data-mouseout=\"images/"
        .$style_prefix."day"
        .$i."-tab.jpg\" /></a>";
  }else{
    $day_tab[$i] = "<img src=\"images/".$style_prefix."day".$i."-tab.jpg\" />";
  }

  /* SLIPPING a 7day ITERATION IN HERE */
  $day_notes[$i] = "";
  $diarist_notes[$i] = "";
  /* SLIPPING a 7day ITERATION IN HERE */

}
  $day_notes[8] = "";
  $day_notes[9] = "";

$settings_link = 'My Settings';
if($complete != 1){

  $register_tab = "<img class=\"tabimg\" src=\"images/" . $style_prefix . "register-tab.jpg\" />";
  $welcome_tab = "<a class=\"settingslink welcome-page-link\" href=\"#\"><img class=\"tabimg\" src=\"images/" . $style_prefix . "welcome-tab.jpg\" data-mouseover=\"images/" . $style_prefix . "welcome-tab-over.jpg\" data-mouseout=\"images/" . $style_prefix . "welcome-tab.jpg\" /></a>";
  $settings_link = "<a class=\"settingslink settings-page-link\" href=\"#\">" . $settings_link . "</a>";
  $sample1_tab = "<a class=\"sampleslink sample1-page-link\" href=\"#\"><img class=\"tabimg\" src=\"images/" . $style_prefix . "sample1-tab.jpg\" data-mouseover=\"images/" . $style_prefix . "sample1-tab-over.jpg\" data-mouseout=\"images/" . $style_prefix . "sample1-tab.jpg\" /></a>";
  $sample2_tab = "<a class=\"sampleslink sample2-page-link\" href=\"#\"><img class=\"tabimg\" src=\"images/" . $style_prefix . "sample2-tab.jpg\" data-mouseover=\"images/" . $style_prefix . "sample2-tab-over.jpg\" data-mouseout=\"images/" . $style_prefix . "sample2-tab.jpg\" /></a>";
  $faq_tab = "<a class=\"sampleslink faq-page-link\" href=\"#\"><img class=\"tabimg\" src=\"images/" . $style_prefix . "faq-tab.jpg\" data-mouseover=\"images/" . $style_prefix . "faq-tab-over.jpg\" data-mouseout=\"images/" . $style_prefix . "faq-tab.jpg\" /></a>";

  if($data_day == 0){
    $welcome_tab = "<a class=\"settingslink welcome-page-link\" href=\"#\"><img class=\"tabimg currenttab\" src=\"images/" . $style_prefix . "welcome-tab.jpg\" data-mouseover=\"images/" . $style_prefix . "welcome-tab-over.jpg\" data-mouseout=\"images/" . $style_prefix . "welcome-tab.jpg\" /></a>";
  }
  
}else{
  $register_tab = "<a class=\"settingslink register-page-link\" href=\"$root/". $prefix . "user-profile.php\"><img class=\"tabimg\" src=\"images/" . $style_prefix . "register-tab.jpg\" data-mouseover=\"images/" . $style_prefix . "register-tab-over.jpg\" data-mouseout=\"images/" . $style_prefix . "register-tab.jpg\" /></a>";
  $welcome_tab = "<img class=\"tabimg\" src=\"images/" . $style_prefix . "welcome-tab.jpg\" />";
  $sample1_tab = "<img class=\"tabimg\" src=\"images/" . $style_prefix . "sample1-tab.jpg\" />";
  $sample2_tab = "<img class=\"tabimg\" src=\"images/" . $style_prefix . "sample2-tab.jpg\" />";      
  $faq_tab = "<img class=\"tabimg\" src=\"images/" . $style_prefix . "faq-tab.jpg\" />";
}
/* ======================  SET TABS ============================== */


/* ======================  SET PAGE HEADERS ============================== */

  $ordinal = array('None'
              ,'One'
              ,'Two'
              ,'Three'
              ,'Four'
              ,'Five'
              ,'Six'
              ,'Seven'
              ,'Eight');

if($shutoff === 0){
  for($theday = 1; $theday <= $data_day; $theday++){
  //  $day_tab[$theday] = "<img src=\"images/" . $style_prefix . "day" . $theday . "-tab-over.jpg\" />";
    $page_header[$theday] = 'My Day ' . $ordinal[$theday] . ' Entries';
  //  $data_day = 1;
  //  $updates = 1;
  //  $show_welcome = 0;
  }

  $page_header["welcome"] = 'Welcome!';
  $page_header["sample1"] = 'Sample Diary #1';
  $page_header["sample2"] = 'Sample Diary #2';
  $page_header["faq"] = 'FAQ';
  $page_header["settings"] = 'My Settings';
  $page_header["thankyou"] = 'Thank you!!!';
/*
  if($complete == 1) { 
    $page_header[1] = 
    $page_header[2] = 
    $page_header[3] = 
    $page_header[4] = 
    $page_header[5] = 
    $page_header[6] = 
    $page_header[7] = 'Thank you!!!'; 
  } */
}
/* ======================  SET PAGE HEADERS ============================== */




/* ======================  PREP SETTINGS DATA ============================== */  
  if($complete != 1){
$sql = "select SQL_NO_CACHE d.*, r.*, o.* from diarists d inner join relationships r on (r.id = d.relationship_id and r.language = d.language) inner join orientations o on (o.id = d.orientation_id and o.language = d.language) where d.ID = $diarist_id";

                $result = mysql_query($sql, $link);
                $row = mysql_fetch_assoc($result);
              //  $firstname = decrypt($row["firstname"]);
               // $lastname = decrypt($row["lastname"]);
                $age = $row["age"];
                $city = decrypt($row["city"]);
               $state_id = $row["state_id"];
                $timezone = $row["timezone"];
                $job = decrypt($row["job"]);
                $relationship = $row["relationship"];
                $orientation = $row["orientation"];
                $kids = $row["kids"];
                $kids_ages = $row["kids_ages"];
                $summary = sanitize(decrypt($row["summary"]));
                $diarist_email = $email = decrypt($row["email"]);
                $mobile = decrypt($row["mobile"]);
                $mobile_locale = ($row["mobile_locale"] == "+1") ? $row["mobile_locale"] : $row["mobile_locale"] . "(0)" ;
                $isEmail = ($row["isEmail"]) == 1 ? "yes" : "no" ;
                $isSMS = ($row["isSMS"] == 1) ? "yes" : "no" ;
                $email_checked = ($row["isEmail"] == 1) ? "checked='checked'" : "";
                $sms_checked = ($row["isSMS"] == 1) ? "checked='checked'" : "";  
        $language = $row["language"];
  }
/* ======================  PREP SETTINGS DATA ============================== */  


  
if($data_day != 0 && $shutoff === 0) {  // get day entries


/* ======================  PREP STATUS BLOCK ============================== */
$entries = array();
for($i=0;$i<=$data_day;$i++){
$answer_count[] = 0;
$question_count[] = 0;
$pm_answer[] = "";
$am_answer[] = "";
$pm_question_id[] = 0;
$pm_question[] = "";
$am_question_id[] = 0;
$am_question[] = "";
$total_entries_count[] = 0;
//$am_entries_count[] = 0;
$entries[$i] = array();
}
/* ======================  PREP STATUS BLOCK ============================== */
    
  
/* ======================  PREP ENTRIES DATA ============================== */  
    
  $sql = "select SQL_NO_CACHE * from entries where diarist_id = $diarist_id order by time_stamp";
  $result = mysql_query($sql, $link);
  if(mysql_num_rows($result) > 0) {
    while($row = mysql_fetch_object($result)) {
      $source = $row->source;
      $entry_day = $row->day;
      $entry_time = $row->entryTime;
      $entry_subject = sanitize(decrypt($row->subject));
      $entry_body = sanitize(decrypt($row->body));
      $entry_message_id = $row->message_id;
      $entry_reference_info = $row->reference_info;

      if(isset($total_entries_count[$entry_day])){
        $total_entries_count[$entry_day]++;
      }else{
        $total_entries_count[$entry_day]=1;        
      }
      
      $entry = "";
      $entry .= "<strong>$entry_time</strong> $entry_body";
      $entry .= ($source != "sms" && $entry_subject != "") ? " - <strong>$entry_subject</strong>" : "";
      $entries[$entry_day][] = $entry;
      
    }  
  }
/* ======================  PREP ENTRIES DATA ============================== */  

/* ======================  PREP QUESTIONS DATA ============================== */    
  $sql = "select * from questions2 where day <= $data_day and language = '$lang'";
  $result = mysql_query($sql, $link);
  while($row = mysql_fetch_object($result)){
    if($row->am_pm == 1){
      $am_question[$row->day] = mb_convert_encoding($row->question,"UTF-8", "UTF-8");
      $am_question_id[$row->day] = $row->ID;  
    }elseif($row->am_pm == 2){
      $pm_question[$row->day] = mb_convert_encoding($row->question,"UTF-8", "UTF-8");
      $pm_question_id[$row->day] = $row->ID;
    }
    if(isset($question_count[$row->day])){
      $question_count[$row->day]++;
    }else{
      $question_count[$row->day]=1;
    }
  }
/* ======================  PREP QUESTIONS DATA ============================== */    


/* ======================  PREP ANSWERS DATA ============================== */    
  $sql = "select SQL_NO_CACHE * from answers where diarist_id = $diarist_id";
  $result = mysql_query($sql, $link);
  while($row = mysql_fetch_object($result)){
    $answer = sanitize(decrypt($row->answer));
    if(in_array($row->question_id,$am_question_id)){
      $am_answer[$row->day] = $answer;
    }elseif(in_array($row->question_id,$pm_question_id)){
      $pm_answer[$row->day] = $answer;
    }
    if(isset($answer_count[$row->day])){
      $answer_count[$row->day]++;
    }else{
      $answer_count[$row->day]=1;
    }
  }    
}
/* ======================  PREP ANSWERS DATA ============================== */    


/* ======================  PREP NOTES DATA ============================== */    
$sql = "select * from diarist_notes where diarist_id = $diarist_id";
$result = mysql_query($sql, $link);
while($row = mysql_fetch_object($result)){
  $diarist_notes .= "<div class='note'><p>" . $row->note . "</p></div>";
}

$sql = "select * from day_notes where language = '$lang' order by rank";
$result = mysql_query($sql, $link);
while($row = mysql_fetch_object($result)){
  $day_notes[$row->day] .= "<div class='note'>" . $row->note . "</div>";
}  
/* ======================  PREP NOTES DATA ============================== */    

?>
  <? 
        /* ======================  HEADER ============================== */ 
  
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="<?=$root;?>/favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>The Sex Diaries Project: Your Diary</title>

<link href="css/<?php echo $style_prefix;?>account2.css" rel="stylesheet" type="text/css" />
<?php echo $extra_stylesheet;?>

<script language="javascript" type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
<script language="javascript" type="text/javascript" src="js/<?php echo $prefix;?>validate.js" charset="utf-8"></script>
<script language="javascript" type="text/javascript" src="js/saveform.js"></script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-21045433-1']);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
<?php echo $extra_header;?>
</head>

<body>
<input id="timezone" type="hidden" value="<?php echo $timezone;?>">
<input id="sessiontimeout" type="hidden" value="<?php echo $sessiontimeout;?>">
<div id="container">
  <div id="header-sdp">
    <a href="<?=$root;?>"><img src="images/<?php echo $style_prefix;?>header-sdp.jpg" border="0" /></a>

    <div class="toplinks"><?=$settings_link;?> | <a href="<?php echo $prefix; ?>logout.php">Logout</a></div>              
  </div>
    <div id="left"></div>
    <div id="center">
  <? 
        /* ======================  HEADER ============================== */ 
  ?>




  
  <? 
        /* ======================  DISPLAY VARIOUS TOPS (.top) ============================== */ 
  ?>
  
  
        <?php  if($shutoff === 0) { //if dataday hasnt exceeded the amount of time user allowed to login           
         if($complete != 1){ //if not complete ?>
            
          <div class="top" id="top_welcome" <?php echo ($data_day == 0) ? "data-current=\"y\"" : ""; ?>>
            <div class="page-header"><?php echo $page_header["welcome"];?></div>      
          </div>
          <div class="top" id="top_settings">
            <div class="page-header"><?php echo $page_header["settings"];?></div>
          </div>
          <div class="top" id="top_sample1">
            <div class="page-header"><?php echo $page_header["sample1"];?></div>
          </div>
          <div class="top" id="top_sample2">
            <div class="page-header"><?php echo $page_header["sample2"];?></div>
          </div>
          <div class="top" id="top_faq">
            <div class="page-header"><?php echo $page_header["faq"];?></div>
          </div>

        <?php }        
        
        if($data_day == 7){ //thank you page header ?>
            <div class="top" id="top_thankyou">
              <div class="page-header"><?php echo $page_header["thankyou"]; ?></div>
            </div>
        <? }

        for($theday=1;$theday <= $data_day; $theday++) { //tops for every day up til dataday ?>
            <div class="top" id="top<?php echo $theday; ?>" <?php echo ($data_day == $theday) ? "data-current=\"y\"" : ""; ?>>
              <div class="page-header"><?php echo $page_header[$theday]; ?></div>          
             </div>
        <?php       }
            }
        /* ======================  DISPLAY VARIOUS TOPS ============================== */ 
  ?>


  <? 
        /* ======================  DISPLAY WELCOME PAGE (.entry) ============================== */ 
  ?>
  
            <?php if($complete != 1){ //if not complete ?>
       <div class="entry" id="welcome-page" <?php echo ($data_day == 0) ? "data-current=\"y\"" : ""; ?>>
      <? include("./include/" . $prefix . "welcome_content.php");  ?>
  </div>
      <? } ?>
  <? 
        /* ======================  DISPLAY WELCOME PAGE (.entry) ============================== */ 
  ?>


    <? 
        /* ======================  DISPLAY SETTINGS PAGE (.entry) ============================== */ 
    ?>          
            <?php if($complete != 1){ //if not complete ?>
    
            <div class="entry" id="settings-page">                  
                <p class="info"><strong>age:</strong> <?php echo $age;?></p>
                <p class="info"><strong>city:</strong> <?php echo $city;?></p> 
                <p class="info"><strong>state:</strong> <?php echo $state_id;?></p> 
                <p class="info"><strong>job:</strong> <?php echo $job;?></p>
                <p class="info"><strong>relationship:</strong> <?php echo $relationship;?></p>
                <p class="info"><strong>orientation:</strong> <?php echo $orientation;?></p>
                <p class="info"><strong>kids:</strong> <?php echo $kids;?></p>
                <p class="info"><strong>kids ages:</strong> <?php echo $kids_ages;?></p>
                  <p>&nbsp;</p>
                <form class="settings" id="update-form" name="update-form" method="post" action="updatesettings.php">
                  <fieldset><legend>update options</legend>
                      <label for="email">email</label> <input id="email" name="email" type="text" tabindex="12" value="<?php echo $email;?>" /> <br />
                      <input id="isEmail" name="isEmail" type="checkbox" <?php echo $email_checked;?> tabindex="13" title="receive email messages?" />                                  <label for="isEmail">receive email (recommended)</label>

            <? $allowed_zones = array("-10.0","-9.0","-8.0","-7.0","-6.0","-5.0","-4.0");
            if(in_array($timezone, $allowed_zones) && $language == "en"){ //if US number and can receive texts ?>
            
            <br />
                      <label for="mobile">mobile number</label> <input id="mobile" name="mobile" type="text" tabindex="14" value="<?php echo $mobile;?>" /> <br />
                      <input id="isSMS" name="isSMS" type="checkbox" <?php echo $sms_checked; ?> tabindex="15" title="receive SMS texts?" />                                  <label for="isSMS">receive SMS texts</label>
                    <br /> 
                      <small>Check this box to receive Diary text messages on your mobile phone. 
                        <br /><strong>Please note</strong> that your phone service provider may charge a fee for delivery of messages based on your current service plan. 
                      </small> 
            <? } //if can receive texts ?>
                    
                          <br />
                      <input id="page_state" name="page_state" type="hidden" value="update" />
                    <input id="orig-email" name="orig-email" type="hidden" value="<?php echo $email;?>" />
                    <br />
                    <button class="submit-button" name="submit-button" type="submit" value="submit">submit</button>
                  </fieldset>  
                </form>
            </div>
            <?php } ?>
    <? 
        /* ======================  DISPLAY SETTINGS PAGE (.entry) ============================== */ 

          
        /* ======================= SAMPLE1 (.entry) =================== */
?>
          <?php if ($complete != 1) { ?>
      <div class="entry" id="sample1-page">
       <? include("./include/" . $prefix . "sample1_content.php"); ?>
      </div>
      <?
          }
        /* ======================= SAMPLE1 (.entry) =================== */
        
        /* ======================= SAMPLE2 (.entry) =================== */
?>
          <?php if ($complete != 1) { ?>
      <div class="entry" id="sample2-page">
       <? include("./include/" . $prefix . "sample2_content.php"); ?>
      </div>
      <?
           }
        /* ======================= SAMPLE2 (.entry) =================== */
            
        /* ====================== FAQ (.entry) ========================= */
?>
          <?php if ($complete != 1) { ?>
      <div class="entry" id="faq-page">
        <? include("./include/" . $prefix . "faq_content.php"); ?>
      </div>
        <?
          }
        /* ======================= FAQ (.entry) =================== */
  

  
        /* ======================  ITERATE THROUGH DATADAY PAGES (.entry) ============================== */ 
        
        if($shutoff === 0) { //if dataday hasnt exceeded the amount of time user allowed to login                     
          for($theday=1;$theday <= $data_day; $theday++) { //entry pages up til dataday 
        ?>
            <div class="entry" id="entry<?php echo $theday; ?>" <? echo ($data_day == $theday) ? "data-current=\"y\"" : ""; ?>>
              <div class="list-parantheses">&nbsp;</div>
              <div class="list-entries">
                <?php  
                $entrycount = count($entries[$theday]);
                if($entrycount == 0 && $complete != 1) {
                  ?> <div class='teaser'>Your entries appear here.</div>
<?php                
                }
                for($i=0;$i < $entrycount; $i++) {
                  echo "<div class='entry-item'>" . $entries[$theday][$i] . "</div>";
                }            
                ?>
              </div>
              <div class="entry-area">
                <?php  if ($complete != 1) { //if they havent compelted their diary let them add new ones ?>
                <h2>add an entry:</h2>

                <form class="entry-form" name="entry-form" method="post" action="submitentry.php">
                  <input id="entry-time<?php echo $theday; ?>" class="entry-time" name="entry-time" type="text" value="<?php echo $current_time;?>" />
                  <textarea <?php echo $disabled; ?> class="theentry entries expand" name="entry"></textarea>
                  <input id="timezone" name="timezone" type="hidden" value="<?php echo $timezone;?>" />
                  <input id="language" name="language" type="hidden" value="<?php echo $lang;?>" />
                  <input id="data_day" class="data_day" name="data_day" type ="hidden" value="<?php echo $theday;?>" />
                  <button class="submit-button" id="submit-button" name="submit-button" type="submit" value="submit">submit</button>
                </form>

                <?php  } ?>
              </div>
              <div class="question-area">
                <h2>morning question:</h2>
                <?php  
                echo "<div class='question'>$am_question[$theday]</div>";
                if(!empty($am_answer[$theday])){
                  echo "<div class='answer'>$am_answer[$theday]</div>";
                }
                else {
                ?>

                <?php  if ($complete != 1) { ?>

                <form id="am-answer-form" class="answer-form" name="am-answer-form" method="post" action="submitanswer.php">
                  <input id="language" name="language" type="hidden" value="<?php echo $lang;?>" />
                  <textarea class="answers expand" id="am-answer" name="answer"></textarea>
                  <input id="timezone" name="timezone" type="hidden" value="<?php echo $timezone;?>" />
                  <input id="data_day" name="data_day" class="data_day" type ="hidden" value="<?php echo $theday;?>" />
                  <input id="question-id" name="question-id" type="hidden" value="<?php echo $am_question_id[$theday];?>" />
                  <button class="submit-button" id="submit-button" name="submit-button" type="submit" value="submit">submit</button>
                </form>
                
              <?php  
                  }
                } ?>
              </div>
              <div class="question-area">
                <h2>evening question:</h2>
              
                <?php  
                echo "<div class='question'>$pm_question[$theday]</div>";
                if(!empty($pm_answer[$theday])){
                  echo "<div class='answer'>$pm_answer[$theday]</div>";
                } else {
                  if ($complete != 1) { ?>
                <form id="pm-answer-form" class="answer-form" name="pm-answer-form" method="post" action="submitanswer.php">
                  <input id="language" name="language" type="hidden" value="<?php echo $lang;?>" />
                  <textarea class="answers expand" id="pm-answer" name="answer"></textarea>                
                  <input id="timezone" name="timezone" type="hidden" value="<?php echo $timezone;?>" />
                  <input id="data_day" name="data_day" type ="hidden" value="<?php echo $theday;?>" />
                  <input id="question-id" name="question-id" type="hidden" value="<?php echo $pm_question_id[$theday];?>" />
                  <button class="submit-button" id="submit-button" name="submit-button" type="submit" value="submit">submit</button>
                </form>
                <?php  
                  } 
                }
                  ?>
                  
                  
            <?php  if( $theday >= 7 && $complete != 1 ) { ?>
              <form id="submit-diary" name="submit-diary" action="submit-diary.php" method="post">
                <p>I am completely finished with my Diary.</p>
                <p>I would like to 
                <input type="hidden" name="userID" value="<?php echo $_SESSION["ID"]; ?>">
                <a href="#" id="submit-diary-button" class="submit-button"><img src="./images/<?=$style_prefix;?>submit-diary-button.png" /></a>
                </p>
              </form>
            <?php  } ?>
                  
                  
              </div>
            </div>  
              
              <?    } //end loop
              }//if not shutoff
                          ?>

          <?php  
        /* ======================  ITERATE THROUGH DATADAY PAGES (.entry) ============================== */ 

        
        

        /* ====================== THANK YOU PAGE (.entry) ========================= */
?>
          <? if ($data_day == 7) { ?>
                      <div class="entry" id="thankyou-page">
                    <? include("./include/" . $prefix . "thankyou_content.php"); ?>
                    </div>
        <?   } 
                  
        /* ======================= THANK YOU PAGE (.entry) =================== */
            ?>
            
            
</div>
    <div id="right">

          <?
        /* ======================  NOTES (.notes) ============================== */ 
              ?>
        <? if($shutoff === 0){ ?>
          <? if($complete != 1){ ?>
      
        <div class="notes" id="notes_welcome" <? echo ($data_day == 0) ? "data-current=\"y\"" : ""; ?>>
                <h1>Editor's Notes:</h1>
              <h1>- Settings</h1><p>You can change your settings by clicking on <a class="settings-page-link" href="#">My Settings</a>.</p>
              <!-- <h1>- WHAT'S NEXT</h1><p>An admin will contact you to see how your Diary is going after your first day. She would love to hear any feedback on how to make DiaryHelper better.</p> -->
              <h1>- CONFIDENTIALITY REMINDER</h1>
              <p>Everything that you write in your Diary is 100% confidential, anonymous and secure. For details, please refer to the <a href="../faq/<?php echo $prefix;?>index.php">FAQ</a> page.</p>
        </div>

        <div class="notes" id="notes_settings">
          <h1>Editor's Notes:</h1>
            <p>You are welcome to change your settings any time.</p>
        </div>    
        
        <div class="notes" id="notes_sample1">
          <h1>Editor's Notes:</h1>
              
            <?php echo $day_notes[8]; ?>

                </div>
        <div class="notes" id="notes_sample2">
          <h1>Editor's Notes:</h1>
            <?php echo $day_notes[9]; ?>

                </div>

        <div class="notes" id="notes_faq">&nbsp;</div>
        
        <div class="notes" id="notes_thankyou">&nbsp;</div>
        
            <? } ?>
        <?  for($theday=1;$theday <= $data_day; $theday++) { //notes for every day up til dataday  ?>
        <div class="notes" id="notes<?php echo $theday; ?>" <? echo ($data_day == $theday) ? "data-current=\"y\"" : ""; ?>>
        
          <div class="status">entries today: <span id="total_entries_count<?php echo $theday; ?>"><?php echo ($total_entries_count[$theday] < 10) ? $total_entries_count[$theday] : " " . $total_entries_count[$theday]; ?></span><br />
                    questions: <span id="answer_count<?php echo $theday; ?>"><?php echo $answer_count[$theday]; ?></span> of <?php echo $question_count[$theday]; ?><br />
          </div>
          <span class="notebreak"> . . . . . . . . . . . </span>
          <h1>Editor's Notes:</h1>
        
            <?php echo $diarist_notes[$theday]; ?>
            <?php echo $day_notes[$theday]; 
            
            if( $theday < 7){ ?>
                <span class="notebreak"> . . . . . . . . . . . </span>
                <p>Tech questions?<br />
                <a href="mailto:<?php echo $adminemail;?>">Email a developer for assistance</a></p>
              <? } ?>
        </div>
        <? } ?>
        

        
        <? }else{ ?>        
          <div class="notes" id="notes_empty" data-current="y">&nbsp;</div>
        <? }
        /* ======================  NOTES (.notes) ============================== */ 



        /* ======================  DISPLAY TABBED MENU ============================== */ 
        ?>              
          <div id="menu">
            <div class="tab"><?php echo $welcome_tab;?></div>
            <div class="tab"><?php echo $register_tab;?></div>
          
            <div id="day1" class="tab"><?php echo $day_tab[1];?></div>
            <div id="day2" class="tab"><?php echo $day_tab[2];?></div>
            <div id="day3" class="tab"><?php echo $day_tab[3];?></div>
            <div id="day4" class="tab"><?php echo $day_tab[4];?></div>
            <div id="day5" class="tab"><?php echo $day_tab[5];?></div>
            <div id="day6" class="tab"><?php echo $day_tab[6];?></div>
            <div id="day7" class="tab"><?php echo $day_tab[7];?></div>
            <div id="help-tabs">
              <!-- <div class="tab"><?php echo $sample1_tab;?></div>
              <div class="tab"><?php echo $sample2_tab;?></div> -->
              <div class="tab"><?php echo $faq_tab;?></div>
            </div>
          </div>
        <?
        /* ======================  DISPLAY TABBED MENU ============================== */ 
                ?>
    </div> 
                    <div id="bottom">&nbsp;</div>   
    </div>

</body>
</html><?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchend.php"); ?>
