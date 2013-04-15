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
<title>Sex Diaries Project - Welcome!</title>
<link href="account/css/<?php echo $style_prefix;?>account2.css" rel="stylesheet" type="text/css" />
<?php echo $extra_stylesheet;?>
<script language="javascript" type="text/javascript" src="js/jquery.min.js?account"></script>

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
      <div class="top" id="top_welcome" data-current="y">
        <div class="page-header">Welcome, Diarist!</div>
      </div>

      <div class="entry" id="welcome-page" data-current="y">

    <p>You are now registered. Please check your email inbox for instructions to login to your Diary Book. </p>
    <p>If you don't receive an email message in 1-2 minutes, please look for it in your spam folder, and set your spam settings to accept emails from <a href="mailto:<?php echo $diaryhelper;?>"><?=$diaryhelper;?></a>.</p>
<p>Happy Diarying!</p>
<p>&nbsp;</p>
<p>Problems? Contact <a href="mailto:<?php echo $adminemail;?>">a developer</a>.</p>
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
