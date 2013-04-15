<?php //include("/home/sexdiari/sexdiariesproject.com/html/it_dev/benchstart.php"); ?>
<?php  

error_reporting(E_ALL);
ini_set("display_errors", "1");
session_start();

include_once("../db.php");
include("../theme.php");

if( !strpos($_SERVER["SCRIPT_URL"], $prefix) ){
  header("Location: " . $prefix . "index.php"); 
  exit;
}

$page_state = (isset($_POST["page_state"]) && !empty($_POST['alias'])) ? $_POST["page_state"] : "start";
$page_state = (isset($_GET["page_state"]) && $_GET["page_state"] == "invalid") ? $_GET["page_state"] : $page_state;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="../favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sex Diaries Project - Account</title>
<link href="css/<?php echo $style_prefix;?>account2.css" rel="stylesheet" type="text/css" />
<?php echo $extra_stylesheet;?>
<script language="javascript" type="text/javascript" src="js/jquery.min.js"></script>

<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
<script language="javascript" type="text/javascript" src="js/<?php echo $prefix;?>validate.js"></script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-21045433-1']);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
<?php echo $extra_header;?>
</head>

<body>

<div id="container"> 
  <div id="header-sdp"> 
  <a href="<?=$root;?>"><img src="images/<?php echo $style_prefix;?>header-sdp.jpg" border="0" /></a>

  </div> 
    <div id="left"></div> 
    <div id="center"> 
      <noscript>If you are seeing this message, it means that your browser has javascript disabled. Please enable javascript, or try opening to this same website in another browser or computer.</noscript> 

<?php  

// echo $page_state;

switch ($page_state){
  case "invalid":
    $notice = '<b>login or password invalid</b><p>Forgot your username or password? Click here for a <a href="' . $prefix . 'forgot.php">reminder</a>.</p>
  <p>&nbsp;</p>
  <p>Tech problems? <a href="mailto:' . $adminemail . '">Email a developer</a></p>';
    include( "./include/" . $prefix . "show_login.php" );
    break;
  case "start":
    include( "./include/" . $prefix . "show_login.php" );
    break;
  case "login":
    include( "./include/" . $prefix . "login.php" );
    break;
  default:
    show_error();
    break;
}

?>
  
  
  </div>
  
  <script>
    jQuery(function($) {
    $(document).ready(function(){

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
    });
  </script>
  
  </body>
  </html>
