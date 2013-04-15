<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '0');
 
include('db.php');
require("googlevoice.php");
//define('GV_USER', 'sexdiariesproject@gmail.com');
define('GV_USER', 'sexdiariesproject@gmail.com');
define('GV_PASS', 'diary!app');

$gv = new GoogleVoice(GV_USER, GV_PASS);

mail("brandon.selway@gmail.com", "testdmd", $gv->sms("5038779861", "testtext"), "From: thediaryhe@thediaryproject.net");


?>