<?
include_once("config.php");
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/header.php");

function check_email($email)
{        
    if(preg_match('/^[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)*\@[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)+$/i', $email)) return true;
    
    return false;
}  

// Test if Username exists in Database
$sql = "SELECT user FROM sil_user WHERE ( user = '".$_POST["user"]."' )";
$result = mysql_query ($sql, $connectionid);    
if(mysql_num_rows ($result) == 0)
	$userexists = false;
	// User dont exist
else 
	$userexists = true;
	// User already exist
	
	
// Test if Mail exists in Database
$sql = "SELECT user FROM sil_user WHERE ( mail = '".$_POST["mail"]."' )";
$result = mysql_query ($sql, $connectionid);    
if(mysql_num_rows ($result) == 0)
	$mailexists = false;
	// Mail dont exist
else 
	$mailexists = true;
	// Mail already exist

// Workaround: $options_captcha was old config format --- Wrapper so we mustn't change every $options_captcha
$options_captcha = $conf[System][options_captcha];
	
// Test if Captchas are activated in CFG
if( $options_captcha == true ) {
	// Test if input string matches captcha
	if( isset($_SESSION['captcha_spam']) AND $_POST["sicherheitscode"] == $_SESSION['captcha_spam'] ) {
		$captchatested = true;
		// it does
	} else {
		$captchatested = false;
		// it doesnt
	}
} else {
	$captchatested = true;
	// Captchas arent activated -> passing test
}

if(	($_POST["register"]) && // Test if User used register form
	($_POST["pass"] == $_POST["pass2"]) &&  // Test if passwords match
	($userexists == false) &&  // Test if Username already exists
	($mailexists == false) && // Test if Mail already exists
	(check_email($_POST["mail"])==true) && // Test if Mail input is a real mail adress
	($captchatested == true)) // Captcha Test
	{ 

		// SQL-Anweisung erstellen 
		$sql = "INSERT INTO ".
		"sil_user (user,pass,mail) ".
		"VALUES ('".$_POST["user"]."', '".
						   md5 ($_POST["pass"])."', '".$_POST["mail"]."')"; 
		mysql_query ($sql); 
		
		$n = "[".date("D M j G:i:s T Y")."] The user ".$_POST["user"]." was created.\n";
		$handle = fopen("silv.log", "a+");
		fputs($handle,$n);
		fclose($handle);

		if (mysql_affected_rows ($connectionid) > 0) 
		{ 
			echo get_lang("register_succ_created")."\n"; 
			$sql = "SELECT id, user, role FROM sil_user WHERE ( user = '".$_POST["user"]."' ) AND ( pass = '".md5 ($_POST["pass"])."' )"; 
			$result = mysql_query ($sql, $connectionid);   
			$data = mysql_fetch_array ($result); 
			$_SESSION["user_id"] = $data["id"]; 
			$_SESSION["user_name"] = $data["user"]; 
			$_SESSION["user_role"] = $data["role"]; 
			?>
			<script type="text/javascript">
			window.setTimeout ('redirect_to ("<?php echo $conf[System][url];?>/index.php")', 5000);

			function redirect_to (destination) {
			  window.location.href = destination;
			}
			</script>
			<?
		} 
		else 
		{ 
			echo get_lang("register_err_error")."<br>\n"; 
		} 
} else {
?>
<form action="register.php" method="post">
	<span style="font-size:25px;">Registrieren</span><br><br>
	<input type="hidden" name="register" value="1">
	<?php echo get_lang("general_name"); ?>: <input type="text" name="user" value="<? echo $_POST["user"]; ?>" size="20"><br>
	<? 
	if($_POST["user"]) {
		if($userexists == true) {
			echo "<span style=\"color:red\">".get_lang("register_err_userexists")."</span><br>\n"; 
		} 
	}
	?>
	<?php echo get_lang("register_mail"); ?>: <input type="text" name="mail" value="<? echo $_POST["mail"]; ?>" size="20"><br>
	<? 	
	
	if($_POST["mail"]) {
		if (check_email($_POST["mail"]) == false) {
			echo "<span style=\"color:red\">".get_lang("register_err_mailnotvalid")."</span><br>\n";
		}
		if($mailexists == true) {
			echo "<span style=\"color:red\">".get_lang("register_err_mailexists")."</span><br>\n"; 
		}
	}
	?>
	<?php echo get_lang("register_pw"); ?>: <input type="password" name="pass" value="<? echo $_POST["pass"]; ?>" size="20"><br> 
	<?php echo get_lang("register_pwagain"); ?>: <input type="password" name="pass2" value="<? echo $_POST["pass2"]; ?>" size="20"><br>
	<? if($_POST["pass"] != $_POST["pass2"]) {
		echo "<span style=\"color:red\">".get_lang("register_err_pwnotident")."</span><br>\n"; 
	} ?><br>
	
	<? if($options_captcha==true) { ?>
		<img src="includes/captcha/captcha.php" border="0" title="Sicherheitscode"><br><br>Code in der Box: <input type="text" name="sicherheitscode" size="5"><br>
		<br><? 
		if($_POST["sicherheitscode"]) {
			if(!(isset($_SESSION['captcha_spam']) AND $_POST["sicherheitscode"] == $_SESSION['captcha_spam'])) {
				echo "<span style=\"color:red\">".get_lang("register_err_captchawrong")."</span><br><br>\n"; 
			}
		}
	}
		?>
	<input type="submit" value="<?php echo get_lang("register_send"); ?>"> <br><br>
</form> 
<?
}
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/footer.php");
?>
