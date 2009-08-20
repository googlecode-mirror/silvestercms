<?
include_once("config.php");
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/header.php");

if(isset($_REQUEST["error"])) {
	
	echo "<span style=\"color:red\">".get_lang("login_err")."</span><br><br>"; 
	
}
?>
<form action="login_session.php" method="post">
	<span style="font-size:25px;">Login</span><br><br>
	<?php echo get_lang("general_name"); ?>: <input type="text" name="name" size="20"><br> 
	<?php echo get_lang("register_pw"); ?>: <input type="password" name="pwd" size="20"><br> 
	<input type="submit" value="<?php echo get_lang("navbar_login"); ?>"> 
</form> 
<?
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/footer.php");
?>