<?
include_once("config.php");
session_start();
if(isset($_SESSION["user_name"])) // If logged in -> redirect to index page
	header("Location: index.php", 3);

include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/header.php");
if($_GET["forgot"]) { // If Passwort forgot function triggered
	echo get_lang("login_forgot_text");
	?><form action="login.php" method="post">
	<input type="hidden" name="forgot_send" value="true" />
		<?php echo get_lang("general_name"); ?>: <input type="text" name="name" size="20"><br>  
		<input type="submit" value="<?php echo get_lang("general_send"); ?>"> 
	</form><?php 
} else if ($_GET["forgot_send"]) { // Function to send new password
	// TODO
} else { // Normal login page
	if(isset($_REQUEST["error"])) {
		
		echo "<span style=\"color:red\">".get_lang("login_err")."</span><br><br>"; 
		
	}
	?>
	<form action="login_session.php" method="post">
		<span style="font-size:25px;">Login</span><br><br>
		<?php echo get_lang("general_name"); ?>: <input type="text" name="name" size="20"><br> 
		<?php echo get_lang("register_pw"); ?>: <input type="password" name="pwd" size="20"><br> 
		<input type="submit" value="<?php echo get_lang("navbar_login"); ?>"> 
	</form> <br /> <br /><?php echo get_lang("login_forgot"); ?> 
	<a href=login.php?forgot=true><?php echo get_lang("login_forgot2"); ?></a>
	<?
}
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/footer.php");
?>