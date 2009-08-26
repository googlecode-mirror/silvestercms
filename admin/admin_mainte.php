<?php 
include_once("../config.php");
if($_POST[toggle]) {
	$conf[System][maintenance] =  $_POST ["mainte"];	
	$file = fopen("config_inc.php", "w");
	
	$string = "<?php \$conf = ";
	$string = $string.var_export($conf, true);
	$string = $string."; ?>";
	
	fwrite($file, $string);
	fclose($file);
	echo "The changes were written.<br><br>";
}
if($_POST[changepw]) {
	$conf[System][mainte_keyword] =  $_POST ["mainte_pw"];	
	$file = fopen("config_inc.php", "w");
	
	$string = "<?php \$conf = ";
	$string = $string.var_export($conf, true);
	$string = $string."; ?>";
	
	fwrite($file, $string);
	fclose($file);
	echo "The changes were written.<br><br>";
}
?>

<h1>Maintenance</h1>
If you want to toggle maintenance mode, click the button in the bottom. While it is turned on, users or guests
can't access your website. Logged-in administrators can use the website for testing.<br />
If you want to log in or give someone who is no administrator access to your website, you are able to access the webpage
through adding your maintenance password to the url like <br /><br /><?php echo $conf[System][url]; ?>/index.php?mainte_pw=&lt;your password&gt; -> <br />&nbsp;&nbsp;&nbsp;<a href="<?php echo $conf[System][url]; ?>/index.php?mainte_pw=<?php echo $conf[System][mainte_keyword]; ?>"><?php echo $conf[System][url]; ?>/index.php?mainte_pw=<?php echo $conf[System][mainte_keyword]; ?></a><br /><br /><hr/><br />
<form action="index.php?include=mainte" method="post">
The maintenance mode is currently: 
<?php
if($conf[System][maintenance]) {
	echo "<span style='color:red'>on</span><input type='hidden' name='mainte' value='0'>";
} else {
	echo "<span style='color:green'>off</span><input type='hidden' name='mainte' value='1'>";
}
?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="toggle" value="true"><input type="submit" value="Toggle" />
</form>	
<br/><hr/><br/>
<form action="index.php?include=mainte" method="post">
Changing maintenance pw: <input type="text" size="20" name="mainte_pw" value="<?php echo $conf[System][mainte_keyword];?>" />
<input type="hidden" name="changepw" value="true"><input type="submit" value="Submit" /></form>
<br/><hr/><br/>