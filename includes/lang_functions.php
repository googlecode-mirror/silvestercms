<?php
//include_once("../config.php");

/**	if ($handle = opendir("/".$conf[System][path]."/includes/lang")) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != ".svn") {
				include("$file/lang.$file.php");
			}
		}
		closedir($handle);
	}**/

// Setting language through navbar
if(isset($_GET["change_lang"])) {
	session_start();
	$_SESSION["lang"] = $_GET["change_lang"]; 
	header("Location: ../index.php");
}

// Wrapper to get english string if current language is incomplete
function get_lang($name) {
	global $conf;
	if(isset($_SESSION["lang"])) {
		$language = $_SESSION["lang"];
	} else {
		$language = $conf[Page][lang];
	}
	$incl_strg = "/".$conf[System][path]."/includes/lang/".$language."/lang.".$language.".php";
	include($incl_strg);
	if ($lang[$language][$name] != "")
		return $lang[$language][$name];
	else {
		$incl_strg = "/".$conf[System][path]."/includes/lang/en/lang.en.php";
		include($incl_strg);
		return $lang[en][$name];
	}
}

//echo get_lang("de","test");
//echo get_lang("de", "notimplement");
?>