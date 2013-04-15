<?php 
if ($_GET["ajax"] == "open"){
	if (is_writable($_POST["the_file"])) {
	
		$file2open = fopen($_POST["the_file"], "r");
		$current_data = @fread($file2open, filesize($_POST["the_file"]));
		//Echo the data from the file 
		echo rmBOM($current_data);
		//Close the file 
		fclose($file2open);
	}else{
		//If file can't be opened complain 
		echo "Could not open file!! Permissions Problem??";
	}
}

function rmBOM($string) {
    if(substr($string, 0,3) == pack("CCC",0xef,0xbb,0xbf)) { 
        $string=substr($string, 3); 
    } 
    return $string; 
}

?>