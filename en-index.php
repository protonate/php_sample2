<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchstart.php"); ?>
<?php  
error_reporting(E_ALL);
ini_set("display_errors", "1");

include("theme.php");

if( !strpos($_SERVER["SCRIPT_URL"], $prefix) ){
  header("Location: " . $prefix . "index.php"); 
  exit;
}

header("Content-type: text/html; charset=utf-8");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sex Diaries Project</title>
<link href="<?php echo $style_prefix;?>intro.css?v=4" rel="stylesheet" type="text/css" />
<?php echo $extra_stylesheet;?>

  <script language="javascript" type="text/javascript" src="js/jquery.min.js"></script>
  <script language="javascript" type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
  <script language="javascript" type="text/javascript" src="js/touchable.js"></script>
  <script language="javascript" type="text/javascript" src="js/intro2.js?v=2"></script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-21045433-1']);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
</head>

<body>

<div id="container">
    <img id="title" src="images/<?=$style_prefix;?>intro-title.jpg" border="0" /> 
    <img id="leftparan" src="images/right-paran.png" border="0" />
    <img id="cursor" src="images/cursor.gif" border="0" />
    <img id="rightparan" src="images/left-paran.png" border="0" />
    <!-- <img id="slipbetween" src="images/<?=$style_prefix;?>intro-slipbetween.jpg" border="0" /> -->
    <div id="page2">
      <!-- <img id="addemail-img" src="images/<?=$style_prefix;?>intro-addemail.png" border="0" /> -->
      <!-- <div id="allure-text">A present! For you. Free. In your inbox, semi-daily. Yes, you really want this.</div> -->
      
      <!-- Ari, Below is the text to edit for the front page!  change the href="http://...." to match whatever link you want, and change the highlighted yellow text to change the display text.  dont change anything else though!! delete this comment when youre done! -->      
      
      <a class="paranblock" target="_blank" id="newsflash" href="http://www.amazon.com/Sex-Diaries-Project-Saying-about/dp/1118157257"><b> NEWSFLASH</b> Click here to order the new book! </a>
          
<!--      <a class="paranblock" target="_blank" id="preorder" href="http://www.barnesandnoble.com/w/sex-diaries-project-arianne-cohen/1100642951?ean=9781118157251&itm=1&usri=the%2bsex%2bdiaries%2bproject">Pre-order the Book</a>
      
      <a class="paranblock" id="getstarted" href="http://sexdiariesproject.com/account/en-index.php">Get Started: Keep a Diary</a> -->
  <?php 
  function get_data($url)
{
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_PORT,80);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
  echo get_data("http://sexdiariesproject.com/about/frontpage_header/");
  //echo get_data("https://sexdiariesproject.com/about/frontpage_header/");
?>

      <div id="quick">
        <div id="twitter-node"><a href="https://twitter.com/sexdiariesprjct" class="twitter-follow-button" data-show-count="false">Follow @sexdiariesprjct</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
        
        
      <div id="join-text">Join The Quickie:</div>
      
      <form action="https://madmimi.com/signups/subscribe/44426" method="POST" id="form"><input id="gatheremail" type="text" name="signup[email]" placeholder="your email">
      <input type="image" id="arrow" src="images/right-arrow.png" border="0">
      <input type="hidden" name="commit" value="Sign Up"></form>

      <img id="qmark" class="off" src="images/qmark.png" border="0" /> 
      <div id="tooltip">
        <span id="tooltitle">WHAT'S THE QUICKIE?</span>
        <span id="tooltext">A present! Just for you. Free. The Quickie lives in your inbox: a new weekly Diary, quote or awesome idea, semi-daily. You can unsubscribe anytime. And we won't sell your email. Because we don't know how. Promise.</span>
      </div>
      </div>
  
  
    </div>
</div>
  <div id="bookbar">
    <a href="http://www.barnesandnoble.com/w/sex-diaries-project-arianne-cohen/1100642951" border="0" target="_blank" title="The U.S. Book"><img alt="The U.S. Book" src="images/Cover-US-small.jpg" /></a>
    <a href="http://www.amazon.co.uk/diaries-project-Italia-confessioni-italiane/dp/8817048232" border="0" target="_blank" title="The Italian Book"><img alt="The Italian Book" src="images/Cover-IT-small.jpg" /></a>
    <a href="http://www.amazon.co.uk/Sex-Diaries-Project-Arianne-Cohen/dp/0091939356" border="0" target="_blank" title="The U.K. Book"><img alt="The U.K. Book" src="images/Cover-UK-small.jpg" /></a>
  </div>
  
</body>
</html>
<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchend.php"); 




?>