<?php
if($_POST["changed"]) {
	$conf_new = $conf;
	$conf_new[Page][pagename] = $_POST["pagename"];
	$conf_new[Page][pagedescr] = $_POST ["pagedescr"];
	$conf_new[Page][design] = $_POST ["design"];
	$conf_new[Page][lang] = $_POST ["lang"];
	
	$conf_new[System][path] = $_POST["path"];
	$conf_new[System][url] = $_POST ["url"];
	$conf_new[System][options_captcha] =  $_POST ["options_captcha"];
	$conf_new[System][maintenance] =  $_POST ["maintenance"];
	$conf_new[System][mainte_keyword] =  $_POST ["mainte_keyword"];
	
	$conf_new[DB][mysql_host] = $_POST["mysql_host"];
	$conf_new[DB][mysql_user] = $_POST ["mysql_user"];
	$conf_new[DB][mysql_password] = $_POST["mysql_password"];
	$conf_new[DB][mysql_database] = $_POST ["mysql_database"];

	
	$file = fopen("config_inc.php", "w");
	
	$string = "<?php \$conf = ";
	$string = $string.var_export($conf_new, true);
	$string = $string."; ?>";
	
	fwrite($file, $string);
	fclose($file);
	echo "Die Änderungen wurden gespeichert.<br><br>";
	$conf = $conf_new;
}
?><span style="color:red;">Changes related to MySQL or Path/Url on your own risk.</span><br><br>
<form action="index.php?include=options" method="post">
	<input type="hidden" name="changed" value="true">
	Page name: <input name="pagename" type="text" size="60" maxlength="" value="<?php echo $conf[Page][pagename]; ?>"><br>
	Page description: <input name="pagedescr" type="text" size="60" maxlength="" value="<?php echo $conf[Page][pagedescr]; ?>"><br><br>
	MySQL Host: <input name="mysql_host" type="text" size="60" maxlength="" value="<?php echo $conf[DB][mysql_host]; ?>"><br>
	MySQL Username: <input name="mysql_user" type="text" size="60" maxlength="" value="<?php echo $conf[DB][mysql_user]; ?>"><br>
	MySQL Password: <input name="mysql_password" type="text" size="60" maxlength="" value="<?php echo $conf[DB][mysql_password]; ?>"><br>
	MySQL Database: <input name="mysql_database" type="text" size="60" maxlength="" value="<?php echo $conf[DB][mysql_database]; ?>"><br><br>
	Path: <input name="path" type="text" size="60" maxlength="" value="<?php echo $conf[System][path]; ?>"><br>
	Url: <input name="url" type="text" size="60" maxlength="" value="<?php echo $conf[System][url]; ?>"><br><br>
	Design: <input name="design" type="text" size="60" maxlength="" value="<?php echo $conf[Page][design]; ?>"><br> 
	Language: <input name="lang" type="text" size="60" maxlength="" value="<?php echo $conf[Page][lang]; ?>"><br><br>
	Captcha (Server needs to have gd module): <input name="options_captcha" type="text" size="50" maxlength="" value="<?php echo $conf[System][options_captcha]; ?>"><br>
	Maintenance mode: <input name="maintenance" type="text" size="60" maxlength="" value="<?php echo $conf[System][maintenance]; ?>"><br>
	Maintenance password: <input name="mainte_keyword" type="text" size="60" maxlength="" value="<?php echo $conf[System][mainte_keyword]; ?>"><br><br>
	<input type="submit" value="Submit">
</form>
