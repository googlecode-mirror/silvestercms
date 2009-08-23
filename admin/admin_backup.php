<?php
session_start();
include_once("../config.php");

if($_GET[add]) {
	$backupFile = "backups/".$conf[DB][mysql_database] ."_". date("Y-m-d-H-i-s") . '.gz'; echo "<br />";
	$command = "mysqldump --opt -h ".$conf[DB][mysql_host]." -u".$conf[DB][mysql_user]." -p".$conf[DB][mysql_password]." ".$conf[DB][mysql_database]." | gzip > $backupFile";
	system($command);
	$n = "[".date("D M j G:i:s T Y")."] Backup ".$backupFile." was created by user ".$_SESSION["user_name"]."\n";
	$handle = fopen("../silv.log", "a+");
	fputs($handle,$n);
	fclose($handle);
}
if($_GET[remove]) {
	unlink("backups/".$_GET[file]);
}

if($_GET[insert]) {
	$self_config['backupfile'] = $_GET[file];
	$self_config['verz'] = 'backups/';
	
	$self_config['zipformat'] = 'gz';
	$self_config['logfile'] = '../silv.log'; 
	$zip_format['gz'] = 'gz';
	
	$compressFile = $self_config['verz'] . $self_config['backupfile'];
	$checkCompressFile = TRUE; 
	
    $shellBefehl = "gzip -d $compressFile";
    exec($shellBefehl);
    $pattern = '/.'.$zip_format[$self_config['zipformat']].'/';
	$sqlFile = @preg_replace($pattern,"",$compressFile)	;
	
	if(@file_exists($sqlFile) && $checkCompressFile == TRUE)
	{ 
	    $mysqlDump = 'mysql ';
	    $mysqlDump .= '--host="' . $conf[DB][mysql_host] . '" ';
	    $mysqlDump .= '--user="' . $conf[DB][mysql_user] . '" ';
	    $mysqlDump .= '--password="' . $conf[DB][mysql_password] . '" ';
	    $mysqlDump .= $conf[DB][mysql_database] . ' < ' . $sqlFile;
	    exec($mysqlDump);
	    
	}
    
}
?>
<h1>Backups</h1>
<table width=100%>
<tr><td>Backup</td><td>Actions</td></tr>
<?php
if ($handle = opendir("backups/")) {
	while (false !== ($file = readdir($handle))) {
		if ($file != "." && $file != ".." && $file != ".svn" && $file !=".DS_Store" && $file != "._.DS_Store") {
			echo "<tr><td>".$file."</td><td><a href=index.php?include=backup&insert=true&file=".$file."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-find.png></a>&nbsp;<a href=index.php?include=backup&remove=true&file=".$file."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-delete.png></a></td></tr>";
		}
	}
	closedir($handle);
}
?></table>
<br /><br />
<?php echo "<a href=index.php?include=backup&add=true><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/list-add.png>&nbsp;Add backup</a>";?>