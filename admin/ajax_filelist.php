


<?php  if($_GET["ajax"] == "filelist"){

include("../theme.php");

$filedir = "/home/sexdiari/sexdiariesproject.com/html";
	$source_prefix = $_GET["lang"] . "-";
	$filelist = directoryToArray($filedir, true);

$valid_ext[0] = "TXT";
$valid_ext[1] = "txt";
$valid_ext[2] = "htm";
$valid_ext[3] = "HTM";
$valid_ext[4] = "html";
$valid_ext[5] = "HTML";
$valid_ext[6] = "shtm";
$valid_ext[7] = "SHTM";
$valid_ext[8] = "shtml";
$valid_ext[9] = "SHTML";
$valid_ext[10] = "pl";
$valid_ext[11] = "PL";
$valid_ext[12] = "cgi";
$valid_ext[13] = "CGI";
$valid_ext[14] = "CSS";
$valid_ext[15] = "css";
$valid_ext[16] = "conf";
$valid_ext[17] = "CONF";
$valid_ext[18] = "ASP";
$valid_ext[19] = "asp";
$valid_ext[20] = "JSP";
$valid_ext[21] = "jsp";
$valid_ext[22] = "js";
$valid_ext[23] = "JS";
$valid_ext[24] = "php";
$valid_ext[25] = "PHP";
$valid_ext[26] = "php3";
$valid_ext[27] = "PHP3";
$valid_ext[28] = "PHTML";
$valid_ext[29] = "phtml";
$valid_ext[30] = "ini";
$valid_ext[31] = "INI";
$valid_ext[32] = "cfm";
$valid_ext[33] = "CFM";
$valid_ext[34] = "inc";
$valid_ext[35] = "INC";

	foreach ($filelist as $file){

		$ext = substr(strrchr($file, '.'), 1);
		$pre = substr(strrchr($file, '/'), 1, 3);
		$shortfile = str_replace($filedir . "/", "", $file);

		if (($pre == $source_prefix && in_array($ext,$valid_ext)) || $shortfile == "theme.php" && is_writable($file)) {
			//Add files to a select box.
			echo "<option value=\"$file\">" . $shortfile . "</option>";
		}
	}	
}

function directoryToArray($directory, $recursive) {
$me = basename($_SERVER["PHP_SELF"]);

$array_items = array();
        if ($handle = opendir($directory)) {
                while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != ".." && $file != $me && substr($file,0,1) != '.' && strpos($file, "bak") === false) {
						if (is_dir($directory. "/" . $file)) {
							if($recursive) {
									$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $recursive));
							}
		 
						} else {
							$file = $directory . "/" . $file;
							$array_items[] = preg_replace("/\/\//si", "/", $file);
						}
					}
                }
                closedir($handle);
        asort($array_items);
		}
        return $array_items;
}

?>
