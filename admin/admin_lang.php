<h1>Language packs</h1>
<?php 
if($_POST["upload"]) {
/**$zip = zip_open($_FILES['userfile']['tmp_name']);

if ($zip) {
    while ($zip_entry = zip_read($zip)) {
        echo "Name:               " . zip_entry_name($zip_entry) . "\n";
        echo "Actual Filesize:    " . zip_entry_filesize($zip_entry) . "\n";
        echo "Compressed Size:    " . zip_entry_compressedsize($zip_entry) . "\n";
        echo "Compression Method: " . zip_entry_compressionmethod($zip_entry) . "\n";

        if (zip_entry_open($zip, $zip_entry, "r")) {
            echo "File Contents:\n";
            $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            echo "$buf\n";

            zip_entry_close($zip_entry);
        }
        echo "\n";

    }

    zip_close($zip);

}**/
	$zip = new ZipArchive;
	$zip->open($_FILES['userfile']['tmp_name']);
    $zip->extractTo($conf[System][path].'/includes/lang/');
    $zip->close();
}
if($_GET["mode"] == "add") { ?>
	<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="index.php?include=lang" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <input type="hidden" name="upload" value="true" />
    <input type="hidden" name="user" value="<?php echo $_SESSION["user_name"]; ?>" />
    <!-- Name of input element determines name in $_FILES array -->
    Upload language pack:<br /><input name="userfile" type="file" size=40 /><br />
    <input type="submit" value="Upload" />
</form><?php 
} else {
?>The installation of language packs uses the ZIP Extension. If your server does not support this, you'll be able to install the language
packs manually by extracting the .zip file to "silvesterCMS Folder"/includes/lang/.<br /><br />
<table width=100%>
<tr><td>Flag</td><td>Name</td><td>Code</td><td>Version</td><td>Translator</td></tr>
<?php
if ($handle = opendir("/".$conf[System][path]."/includes/lang")) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != ".svn" && $file !=".DS_Store" && $file != "._.DS_Store") {
				$incl_strg = $conf[System][path]."/includes/lang/".$file."/lang.".$file.".php";
				include($incl_strg);
				echo "<tr><td><img src=\"".$conf[System][url]."/includes/lang/".$file."/".$file.".png\"></td>";
				echo "<td>".$lang_info[name]."</td><td>".$file."</td><td>".$lang_info[version]."</td><td>".$lang_info[translator]."</td></tr>";
			}
		}
		closedir($handle);
	}
?></table>
<?php
	echo "<br /><a href=index.php?include=lang&mode=add><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/list-add.png>&nbsp;Add langpack</a>";
}
?>