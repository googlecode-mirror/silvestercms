<h1>Templates</h1>
<?php 
if($_POST["upload"]) {
	$zip = new ZipArchive;
	$zip->open($_FILES['userfile']['tmp_name']);
    $zip->extractTo($conf[System][path].'/includes/templates');
    $zip->close();
}
if($_GET["mode"] == "add") { ?>
	<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="index.php?include=design" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <input type="hidden" name="upload" value="true" />
    <input type="hidden" name="user" value="<?php echo $_SESSION["user_name"]; ?>" />
    <!-- Name of input element determines name in $_FILES array -->
    Upload template:<br /><input name="userfile" type="file" size=40 /><br />
    <input type="submit" value="Upload" />
</form><?php 
} else {
?>The installation of templates uses the ZIP Extension. If your server does not support this, you'll be able to install the templates
 manually by extracting the .zip file to "silvesterCMS Folder"/includes/templates/.<br /><br />
<table width=100%>
<tr><td>Name</td><td>Version</td><td>Creator</td></tr>
<?php
if ($handle = opendir("/".$conf[System][path]."/includes/templates")) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != ".svn" && $file !=".DS_Store" && $file != "._.DS_Store") {
				$incl_strg = $conf[System][path]."/includes/templates/".$file."/info.php";
				include($incl_strg);
				echo "<tr><td>".$temp_info[name]."</td><td>".$temp_info[version]."</td><td>".$temp_info[creator]."</td></tr>";
			}
		}
		closedir($handle);
	}
?></table>
<?php
	echo "<br /><a href=index.php?include=design&mode=add><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/list-add.png>&nbsp;Add template</a>";
}
?>