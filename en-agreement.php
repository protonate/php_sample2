<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchstart.php"); ?>
<?php  
error_reporting(E_ALL);
ini_set("display_errors", "1");

session_start();

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
<title>Sex Diaries Project - Agreement</title>
<link href="account/css/<?php echo $style_prefix;?>account2.css" rel="stylesheet" type="text/css" />
<?php echo $extra_stylesheet;?>
<script language="javascript" type="text/javascript" src="js/jquery.min.js"></script>

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
      <div class="top" id="top_agreement" data-current="y">
        <div class="page-header">Our Agreement</div>
      </div>

  <div class="entry" id="agreement-page" data-current="y">
<a href="javascript:window.print()">Print This Page</a>
<div id="agreement">
<p>I, <?php echo decrypt($_SESSION['person']); ?>, consent to participate in The Sex Diaries Project, and I understand and agree to the following:</p>
<p>I will participate in this Project by writing Diary entries that
  share daily my thoughts, feelings, stories, ideas and experiences relating to my
  relationship, sexual and emotional life. I represent and warrant that all aspects
  of my Diary will be truthful and accurate.</p>

  <p>Arianne Cohen and The Sex Diaries Project has my permission to edit my anonymous Diary and anonymously use it or the information in it in any media now
  known or later developed, and I hereby assign all right, title, and
  interest to Arianne Cohen and The Sex Diaries Project. I will at no
  time receive any payment for participating in this Project.</p>
<p>I am giving my consent voluntarily, and I release Arianne Cohen (and any
  third party working with her, such as a publisher) from
  any legal claims, demands, or damages relating to the use now or in the
  future of all or any part of the Diary. If at any point I have any
  concerns about this consent or about The Sex Diaries Project, I am free
  to contact editor@thediaryproject.net.</p>
  <form id="theForm" method="post" action="./php/process-agreement.php?account">
  <input type="checkbox" name="agree1" id="agree1" value="1" /> <span id="accept1">I accept.</span> <br />
  
  <p>I understand that Arianne Cohen will never publish my name with my Diary, and
  may alter the names of people I refer to in my diary to mask their
  identities, as well as delete any identifying characteristics. I understand that there can never be any absolute assurance that no one will identify me (or others) based on what I write. I understand  that  Arianne Cohen and The Sex Diaries Project will follow  stringent  anonymity protocol, and will make all good faith efforts to  ensure  confidentiality. </p>
    
  <input type="checkbox" name="agree2" id="agree2" value="1" /> <span id="accept2">I accept.</span> <br />
    
  <input type="hidden" id="diaristID" name="diaristID" value="<?=$_SESSION['diaristID'];?>">
  <button id="submit" type="submit" value="I UNDERSTAND AND AGREE TO PARTICIPATE IN THE PROJECT ACCORDING TO THE TERMS ABOVE">I UNDERSTAND AND AGREE TO THE TERMS ABOVE</button>
</form>
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
    
    jQuery("#theForm").submit(function(){
    if(jQuery("#agree1").is(":checked") && jQuery("#agree2").is(":checked")){
      return true;
    }else{
      if(jQuery("#agree1").is(":checked")){
        jQuery("#accept1").css("font-weight","normal");
        jQuery("#accept1").css("background-color","transparent");    
      }else{
        jQuery("#accept1").css("font-weight","bold");    
        jQuery("#accept1").css("background-color","yellow");    
      }
      if(jQuery("#agree2").is(":checked")){
        jQuery("#accept2").css("font-weight","normal");
        jQuery("#accept2").css("background-color","transparent");    
      }else{
        jQuery("#accept2").css("font-weight","bold");    
        jQuery("#accept2").css("background-color","yellow");    
      }
      return false;
    }
});
    
  </script>

</body>
</html>
<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchend.php"); ?>