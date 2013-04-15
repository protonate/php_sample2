<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchstart.php"); ?>
<?php  
error_reporting(E_ALL);
ini_set("display_errors", "1");

include_once("db.php");
include("theme.php");

if( !strpos($_SERVER["SCRIPT_URL"], $prefix) ){
  header("Location: " . $prefix . "user-profile.php"); 
  exit;
}

header("Content-type: text/html; charset=utf-8");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sex Diaries Project - Register</title>
<link href="account/css/<?php echo $style_prefix;?>account2.css" rel="stylesheet" type="text/css" />
<?php echo $extra_stylesheet;?>
<script language="javascript" type="text/javascript" src="js/jquery.min.js?account"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js?account"></script>
<script language="javascript" type="text/javascript" src="js/<?php echo $prefix;?>validate.js?account"></script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-21045433-1']);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
<?php echo $extra_header;?>
</head>

<body>
<div id="container"> 
  <div id="header-sdp"> 
<a href="<?=$root;?>"><img src="account/images/<?php echo $style_prefix;?>header-sdp.jpg" border="0" /></a>
 
  </div> 
    <div id="left"></div> 
    <div id="center"> 
      <div class="top" id="top_registration" data-current="y">
        <div class="page-header">Registration</div>
      </div>

      <div class="entry" id="registration-page" data-current="y">

<form id="regForm" action="./php/register.php?account" method="post">
<fieldset class="fieldset"><legend>personal information</legend>
<label for="firstname">first name </label><span class="regright"><input id="firstname" name="firstname" tabindex="1" type="text" title="enter first name"></span><br>
<label for="lastname">last name </label><span class="regright"><input id="lastname" name="lastname" tabindex="2" type="text" title="enter last name"></span><br>
<label for="age">age </label><span class="regright"><input id="age" name="age" tabindex="3" type="text" title="enter age" size="4" maxlength="2"></span><br>
<label for="job">job </label><span class="regright"><input id="job" name="job" tabindex="4" type="text" title="enter job"></span><br>
<small>(example: student, surgical nurse, <br>telemarketer, financial analyst, etc)</small><br>
<label for="relationship_id">relationship status </label><span class="regright"><select id="relationship_id" name="relationship_id" tabindex="5" title="select relationship status">
    <?php 
  $sql = "select * from relationships where language = '$lang'";
  $result = mysql_query($sql, $link);
  while($row = mysql_fetch_assoc($result)) {
    echo("<option value='" . $row["ID"] . "'>" . $row["relationship"] . "</option>");
  }
  ?>
  </select></span><br>

  <label for="orientation_id">orientation </label><span class="regright"><select id="orientation_id" name="orientation_id" tabindex="6" title="select orientation">
    <?php 
  $sql = "select * from orientations where language = '$lang'";
  $result = mysql_query($sql, $link);
  while($row = mysql_fetch_assoc($result)) {
    echo("<option value='" . $row["ID"] . "'>" . $row["orientation"] . "</option>");
  }
  ?>
  </select></span><br>
<label for="kids">kids </label><span class="regright"><select id="kids" name="kids" tabindex="7" title="kids">
  <option value="">none</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5(+)">5(+)</option>
</select></span><br>
<label for="kids_ages">ages </label><span><input id="kids_ages" name="kids_ages" tabindex="7" title="kids ages" type="text"></span><br>
<label for="city">city </label><span class="regright"><input id="city" name="city" tabindex="7" type="text" title="enter city"></span><br>
<label for="state_id">state/county </label><span class="regright"><select id="state_id" name="state_id" tabindex="8" title="select state">
  <option value="">--select--</option>
  <optgroup label="other country">
    <option>other</option>
  </optgroup>
  <optgroup label="United States">
    <option value="AL">Alabama</option>
    <option value="AK">Alaska</option>
    <option value="AZ">Arizona</option>
    <option value="AR">Arkansas</option>
    <option value="CA">California</option>
    <option value="CO">Colorado</option>
    <option value="CT">Connecticut</option>
    <option value="DE">Delaware</option>
    <option value="DC">District of Columbia</option>
    <option value="FL">Florida</option>
    <option value="GA">Georgia</option>
    <option value="HI">Hawaii</option>
    <option value="ID">Idaho</option>
    <option value="IL">Illinois</option>
    <option value="IN">Indiana</option>
    <option value="IA">Iowa</option>
    <option value="KS">Kansas</option>
    <option value="KY">Kentucky</option>
    <option value="LA">Louisiana</option>
    <option value="ME">Maine</option>
    <option value="MD">Maryland</option>
    <option value="MA">Massachusetts</option>
    <option value="MI">Michigan</option>
    <option value="MN">Minnesota</option>
    <option value="MS">Mississippi</option>
    <option value="MO">Missouri</option>
    <option value="MT">Montana</option>
    <option value="NE">Nebraska</option>
    <option value="NV">Nevada</option>
    <option value="NH">New Hampshire</option>
    <option value="NJ">New Jersey</option>
    <option value="NM">New Mexico</option>
    <option value="NY">New York</option>
    <option value="NC">North Carolina</option>
    <option value="ND">North Dakota</option>
    <option value="OH">Ohio</option>
    <option value="OK">Oklahoma</option>
    <option value="OR">Oregon</option>
    <option value="PA">Pennsylvania</option>
    <option value="RI">Rhode Island</option>
    <option value="SC">South Carolina</option>
    <option value="SD">South Dakota</option>
    <option value="TN">Tennessee</option>
    <option value="TX">Texas</option>
    <option value="UT">Utah</option>
    <option value="VT">Vermont</option>
    <option value="VA">Virginia</option>
    <option value="WA">Washington</option>
    <option value="WV">West Virginia</option>
    <option value="WI">Wisconsin</option>
    <option value="WY">Wyoming</option>
  </optgroup>
  <optgroup label="England">
    <option>Bedfordshire</option>
    <option>Berkshire</option>
    <option>Bristol</option>
    <option>Buckinghamshire</option>
    <option>Cambridgeshire</option>
    <option>Cheshire</option>
    <option>City of London</option>
    <option>Cornwall</option>
    <option>Cumbria</option>
    <option>Derbyshire</option>
    <option>Devon</option>
    <option>Dorset</option>
    <option>Durham</option>
    <option>East Riding of Yorkshire</option>
    <option>East Sussex</option>
    <option>Essex</option>
    <option>Gloucestershire</option>
    <option>Greater London</option>
    <option>Greater Manchester</option>
    <option>Hampshire</option>
    <option>Herefordshire</option>
    <option>Hertfordshire</option>
    <option>Isle of Wight</option>
    <option>Kent</option>
    <option>Lancashire</option>
    <option>Leicestershire</option>
    <option>Lincolnshire</option>
    <option>Merseyside</option>
    <option>Norfolk</option>
    <option>North Yorkshire</option>
    <option>Northamptonshire</option>
    <option>Northumberland</option>
    <option>Nottinghamshire</option>
    <option>Oxfordshire</option>
    <option>Rutland</option>
    <option>Shropshire</option>
    <option>Somerset</option>
    <option>South Yorkshire</option>
    <option>Staffordshire</option>
    <option>Suffolk</option>
    <option>Surrey</option>
    <option>Tyne and Wear</option>
    <option>Warwickshire</option>
    <option>West Midlands</option>
    <option>West Sussex</option>
    <option>West Yorkshire</option>
    <option>Wiltshire</option>
    <option>Worcestershire</option>
  </optgroup>
  <optgroup label="Wales">
    <option>Anglesey</option>
    <option>Brecknockshire</option>
    <option>Caernarfonshire</option>
    <option>Carmarthenshire</option>
    <option>Cardiganshire</option>
    <option>Denbighshire</option>
    <option>Flintshire</option>
    <option>Glamorgan</option>
    <option>Merioneth</option>
    <option>Monmouthshire</option>
    <option>Montgomeryshire</option>
    <option>Pembrokeshire</option>
    <option>Radnorshire</option>
  </optgroup>
  <optgroup label="Scotland">
    <option>Aberdeenshire</option>
    <option>Angus</option>
    <option>Argyllshire</option>
    <option>Ayrshire</option>
    <option>Banffshire</option>
    <option>Berwickshire</option>
    <option>Buteshire</option>
    <option>Cromartyshire</option>
    <option>Caithness</option>
    <option>Clackmannanshire</option>
    <option>Dumfriesshire</option>
    <option>Dunbartonshire</option>
    <option>East Lothian</option>
    <option>Fife</option>
    <option>Inverness-shire</option>
    <option>Kincardineshire</option>
    <option>Kinross</option>
    <option>Kirkcudbrightshire</option>
    <option>Lanarkshire</option>
    <option>Midlothian</option>
    <option>Morayshire</option>
    <option>Nairnshire</option>
    <option>Orkney</option>
    <option>Peeblesshire</option>
    <option>Perthshire</option>
    <option>Renfrewshire</option>
    <option>Ross-shire</option>
    <option>Roxburghshire</option>
    <option>Selkirkshire</option>
    <option>Shetland</option>
    <option>Stirlingshire</option>
    <option>Sutherland</option>
    <option>West Lothian</option>
    <option>Wigtownshire</option>
  </optgroup>
  <optgroup label="Northern Ireland">
    <option>Antrim</option>
    <option>Armagh</option>
    <option>Down</option>
    <option>Fermanagh</option>
    <option>Londonderry</option>
    <option>Tyrone</option>
  </optgroup>  
</select></span><br>
<small>* if you live outside of the U.S.<br>or U.K., please select "other"</small> <br>
<label for="timezone">timezone</label> <select id="timezone" name="timezone" title="select a timezone" tabindex="8"> 
                <option value="" selected="selected">Select Time Zone Below</option> 
                <option value="-5.0">U.S. Eastern</option> 
                <option value="-6.0">U.S. Central</option> 
                <option value="-7.0">U.S. Mountain</option> 
                <option value="-8.0">U.S. Pacific</option> 
                <option value="-9.0">U.S. Alaska</option> 
                <option value="-10.0">U.S. Hawaii</option> 
                <option value="">----------------</option> 
                <option value="0.0">GMT +00:00 Britain, Ireland, Portugal, Western 
                Africa </option> 
                <option value="1.0">GMT +00:30 </option> 
                <option value="1.0">GMT +01:00 Western Europe, Central Africa</option> 
                <option value="1.5">GMT +01:30 </option> 
                <option value="2.0">GMT +02:00 Eastern Europe, Eastern Africa</option> 
                <option value="2.0">GMT +02:30 </option> 
                <option value="3.0">GMT +03:00 Russia, Saudi Arabia</option> 
                <option value="3.0">GMT +03:30 </option> 
                <option value="4.0">GMT +04:00 Arabian</option> 
                <option value="4.0">GMT +04:30 </option> 
                <option value="5.0">GMT +05:00 West Asia, Pakistan</option> 
                <option value="5.0">GMT +05:30 India</option> 
                <option value="6.0">GMT +06:00 Central Asia</option> 
                <option value="6.0">GMT +06:30 </option> 
                <option value="7.0">GMT +07:00 Bangkok, Hanoi, Jakarta</option> 
                <option value="7.0">GMT +07:30 </option> 
                <option value="8.0">GMT +08:00 China, Singapore, Taiwan</option> 
                <option value="8.0">GMT +08:30 </option> 
                <option value="9.0">GMT +09:00 Korea, Japan</option> 
                <option value="9.0">GMT +09:30 Central Australia</option> 
                <option value="10.0">GMT +10:00 Eastern Australia</option> 
                <option value="10.0">GMT +10:30 </option> 
                <option value="11.0">GMT +11:00 Central Pacific</option> 
                <option value="11.0">GMT +11:30 </option> 
                <option value="12.0">GMT +12:00 Fiji, New Zealand</option> 
                <option value="-12.0">GMT -12:00 Dateline </option> 
                <option value="-11.0">GMT -11:30 </option> 
                <option value="-11.0">GMT -11:00 Samoa</option> 
                <option value="-10.0">GMT -10:30 </option> 
                <option value="-10.0">GMT -10:00 Hawaiian</option> 
                <option value="-9.0">GMT -09:30 </option> 
                <option value="-9.0">GMT -09:00 Alaska/Pitcairn Islands</option> 
                <option value="-8.0">GMT -08:30 </option> 
                <option value="-8.0">GMT -08:00 US/Canada/Pacific</option> 
                <option value="-7.0">GMT -07:30 </option> 
                <option value="-7.0">GMT -07:00 US/Canada/Mountain</option> 
                <option value="-6.0">GMT -06:30 </option> 
                <option value="-6.0">GMT -06:00 US/Canada/Central</option> 
                <option value="-5.0">GMT -05:30 </option> 
                <option value="-5.0">GMT -05:00 US/Canada/Eastern, Colombia, Peru</option> 
                <option value="-4.0">GMT -04:30 </option> 
                <option value="-4.0">GMT -04:00 Bolivia, Western Brazil, Chile, 
                Atlantic</option> 
                <option value="-3.0">GMT -03:30 Newfoundland</option> 
                <option value="-3.0">GMT -03:00 Argentina, Eastern Brazil, Greenland</option> 
                <option value="-2.0">GMT -02:30 </option> 
                <option value="-2.0">GMT -02:00 Mid-Atlantic</option> 
                <option value="-1.0">GMT -01:30 </option> 
                <option value="-1.0">GMT -01:00 Azores/Eastern Atlantic</option> 
                <option value="0.0">GMT -00:30 </option> 
</select> <br>
</fieldset>
<br>
<fieldset class="fieldset"><legend>diary account information</legend>
<label for="alias">username </label><span class="regright"><input id="alias" name="alias" type="text" tabindex="9" title="enter username"></span><br>
<label for="password">password </label><span class="regright"><input id="password" name="password" type="password" tabindex="10" title="enter password"></span><br>
<label for="confirm_password">confirm password </label><span class="regright"><input id="confirm_password" name="confirm_password" type="password" tabindex="11" title="enter password again"></span><br>
<label for="email">email address </label><span class="regright"><input id="email" name="email" type="text" tabindex="12" title="enter email"></span><br>
        <small>This is the address that you can use to send in Diary entries.<br>We suggest that you use a personal and private email address.</small><br>
                <label for="isEmail">receive email?</label>
        <span class="regright"><input id="isEmail" name="isEmail" type="checkbox" checked="checked" tabindex="13" title="receive email messages?"></span><br>
        <small>Check this box to receive two daily reminder emails from <br>DiaryHelper! (Suggested.) You can change this option later.</small>
<br>
  
<label for="mobile1">mobile phone</label> <input class="mobile"
  id="mobile1" name="mobile1" type="text" tabindex="14"
  title="enter area code" size="4" maxlength="3" /> -<input
  class="mobile" id="mobile2" name="mobile2" type="text" tabindex="15"
  title="enter phone number" size="5" maxlength="3" /> -<input
  class="mobile" id="mobile3" name="mobile3" type="text" tabindex="16"
  title="enter phone number" size="5" maxlength="4" />
              <br>
        <small>This is the phone number that you can use to send<br>in Diary entry text messages. (US only.)</small><br>
                <label for="isSMS">receive sms text?</label>
          <span class="regright"><input id="isSMS" name="isSMS" type="checkbox" checked="checked" tabindex="17" title="receive sms text?"></span><br>
        <small>Check this box to receive two daily text message<br> reminders from DiaryHelper.  (US only)<br>Consult your mobile service plan for any text message fees.
        </small>
</fieldset>
<br>
<div class="submit-center" align="center"><button id="register-submit" type="submit" value="Register to be a Diarist!" tabindex="18">Register to be a Diarist!</button></div>

</form>

<div class="submit-center">Why are we asking you for this information? All Diaries are anonymous.
However, on the next page you'll find a legal consent form, which requires that we have your real name and contact information. Also, your Diary communications can take place by email or phone. This information will only be used
for these purposes. We promise.
</div>

  </div>
</div>
<div id="right">   
  <div class="notes" id="notes_thankyou" data-current="y"><p>&nbsp;</p>
  </div>
  <div id="menu"> 
              <div class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>welcome-tab.jpg"></div> 
              <div class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>register-tab-over.jpg" /></div> 
            
              <div id="day1" class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>day1-tab.jpg"></div> 
              <div id="day2" class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>day2-tab.jpg"></div>
              <div id="day3" class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>day3-tab.jpg"></div>
              
              <div id="day4" class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>day4-tab.jpg"></div>
              <div id="day5" class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>day5-tab.jpg"></div>
              <div id="day6" class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>day6-tab.jpg"></div>
              <div id="day7" class="tab"><img class="tabimg" src="account/images/<?=$style_prefix;?>day7-tab.jpg"></div>
              
              <div id="help-tabs"> 
                <!--<div class="tab"><a href="./samples/<?=$prefix;?>sample1.php"><img class="tabimg" src="account/images/<?=$style_prefix;?>sample1-tab.jpg" data-mouseover="account/images/<?=$style_prefix;?>sample1-tab-over.jpg" data-mouseout="account/images/<?=$style_prefix;?>sample1-tab.jpg" /></a></div> 
                <div class="tab"><a href="./samples/<?=$prefix;?>sample2.php"><img class="tabimg" src="account/images/<?=$style_prefix;?>sample2-tab.jpg" data-mouseover="account/images/<?=$style_prefix;?>sample2-tab-over.jpg" data-mouseout="account/images/<?=$style_prefix;?>sample2-tab.jpg" /></a></div> 
                --><div class="tab"><a href="./faq/<?=$prefix;?>index.php"><img class="tabimg" src="account/images/<?=$style_prefix;?>faq-tab.jpg" data-mouseover="account/images/<?=$style_prefix;?>faq-tab-over.jpg" data-mouseout="account/images/<?=$style_prefix;?>faq-tab.jpg" /></a></div> 
              </div>
    </div>

</div>

</div>

  <script>
    jQuery(function($) {
      $('.entry[data-current*="y"], .top[data-current*="y"], .notes[data-current*="y"]').show();
      $('.currenttab').attr('src', $('.currenttab').attr('data-mouseover'));
    
      $(".tabimg").hover(function(){
        var thisel = $(this);
        //thisparent 
        if(!thisel.hasClass("currenttab")){
          thisel.attr('src', thisel.attr('data-mouseover'));
        }
      }, function(){
        var thisel = $(this);
        if(!thisel.hasClass("currenttab")){
          thisel.attr('src', thisel.attr('data-mouseout'));
        }
      });
    });
  </script>

</body>
</html>
<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchend.php"); ?>