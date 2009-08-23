<?
include("../admin/config_inc.php");

// Part 2 of Installation
if($_POST[changed] == true) {
	?><h1>silvesterCMS <?php echo $verstring; ?>: Installation</h1><?php 
		$conf[DB][mysql_host] = $_POST["mysql_host"];
		$conf[DB][mysql_user] = $_POST ["mysql_user"];
		$conf[DB][mysql_password] = $_POST["mysql_password"];
		$conf[DB][mysql_database] = $_POST ["mysql_database"];
		$conf[System][path] = $_POST["path"];
		$conf[System][url] = $_POST ["url"];
		$conf[Page][pagename] = $_POST["pagename"];
		$conf[Page][pagedescr] = $_POST ["pagedescr"];
		$conf[Page][design] = $_POST ["design"];
		$conf[Page][lang] = $_POST ["lang"];
		$file = fopen("../admin/config_inc.php", "w");
		
		$string = "<?php \$conf = ";
		$string = $string.var_export($conf, true);
		$string = $string."; ?>";
		
		fwrite($file, $string);
		fclose($file);
		echo "Die Änderungen wurden gespeichert.";

		$connectionid = mysql_connect ($conf[DB][mysql_host], $conf[DB][mysql_user], $conf[DB][mysql_password]); 
		mysql_select_db ($conf[DB][mysql_database], $connectionid);
		mysql_query ("CREATE TABLE IF NOT EXISTS `sil_blog_articles` (
		  `id` int(11) NOT NULL auto_increment,
		  `autor` varchar(50) character set latin1 NOT NULL,
		  `title` varchar(50) character set latin1 NOT NULL,
		  `content` text character set latin1 NOT NULL,
		  `tags` varchar(50) character set latin1 NOT NULL,
		  `categories` varchar(50) character set latin1 NOT NULL,
		  `creation_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;");
		
		mysql_query ("CREATE TABLE IF NOT EXISTS `sil_blog_categories` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(50) character set latin1 NOT NULL default 'Uncategorized',
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;");
		
		mysql_query ("CREATE TABLE IF NOT EXISTS `sil_blog_comments` (
		  `commentid` int(11) NOT NULL auto_increment,
		  `blogid` int(11) NOT NULL,
		  `autor` varchar(50) character set latin1 NOT NULL,
		  `title` varchar(50) character set latin1 NOT NULL,
		  `content` varchar(250) character set latin1 NOT NULL,
		  `creation_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
		  PRIMARY KEY  (`commentid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;");
		
		mysql_query ("CREATE TABLE IF NOT EXISTS `sil_pages` (
		  `id` int(11) NOT NULL auto_increment,
		  `title` varchar(50) character set latin1 NOT NULL,
		  `content` text character set latin1 NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;");
		
		mysql_query ("CREATE TABLE IF NOT EXISTS `sil_user` (
		  `id` int(11) NOT NULL auto_increment,
		  `user` varchar(50) character set latin1 NOT NULL default '',
		  `pass` varchar(50) character set latin1 NOT NULL default '',
		  `mail` varchar(50) character set latin1 NOT NULL default '',
		  `profile_name` varchar(50) character set latin1 NOT NULL default '',
		  `profile_avatar` text character set latin1 NOT NULL,
		  `profile_icq` varchar(50) character set latin1 NOT NULL default '',
		  `profile_msn` varchar(50) character set latin1 NOT NULL default '',
		  `profile_jabber` varchar(50) character set latin1 NOT NULL default '',
		  `profile_page` varchar(50) character set latin1 NOT NULL default '',
		  `profile_date` varchar(50) character set latin1 NOT NULL default '',
		  `role` varchar(50) character set latin1 NOT NULL default 'User',
		  `created` timestamp NOT NULL default CURRENT_TIMESTAMP,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;");
		
		// Definition der Benutzer 
		$benutzer[0]["user"] = "admin"; 
		$benutzer[0]["pass"] = "admin";  
		
		mysql_query ("DELETE FROM sil_user"); 
		
		// Daten eintragen 
		while (list ($key, $value) = each ($benutzer)) 
		{ 
		  // SQL-Anweisung erstellen 
		  $sql = "INSERT INTO ".
		    "sil_user (user,pass,role) ".
		  "VALUES ('".$value["user"]."', '".
		                       md5 ($value["pass"])."', 'Administrator')"; 
		  mysql_query ($sql); 
		
		  if (mysql_affected_rows ($connectionid) > 0) 
		  { 
		    echo "Installation done.<br>User was created.<br>"
		    	."User: admin / Passwort: admin<br><br>Delete folder install in your "
		    	."silvesterCMS directory.<br><br><a href=../index.php>Your silvesterCMS Installation</a>"; 
		  } 
		  else 
		  { 
		   echo "Error. Contact developer.<br>"; 
		  } 
		} 
} else {
		?><h1>silvesterCMS <?php echo $verstring; ?>: Installation</h1>
		<form action="install.php" method="post">
			<input type="hidden" name="changed" value="true">
			Page name: <input name="pagename" type="text" size="60" maxlength="" value="<?php echo $conf[Page][pagename]; ?>"><br>
			Page description: <input name="pagedescr" type="text" size="60" maxlength="" value="<?php echo $conf[Page][pagedescr]; ?>"><br><br>
			MySQL Host: <input name="mysql_host" type="text" size="60" maxlength="" value="<?php echo $conf[DB][mysql_host]; ?>"><br>
			MySQL Username: <input name="mysql_user" type="text" size="60" maxlength="" value="<?php echo $conf[DB][mysql_user]; ?>"><br>
			MySQL Password: <input name="mysql_password" type="text" size="60" maxlength="" value="<?php echo $conf[DB][mysql_password]; ?>"><br>
			MySQL Database: <input name="mysql_database" type="text" size="60" maxlength="" value="<?php echo $conf[DB][mysql_database]; ?>"><br><br>
			Path: <input name="path" type="text" size="60" maxlength="" value="<?php echo $conf[System][path]; ?>"><br>
			Url: <input name="url" type="text" size="60" maxlength="" value="<?php echo $conf[System][url]; ?>"><br><br>
			Default Design: <input name="design" type="text" size="60" maxlength="" value="<?php echo $conf[Page][design]; ?>"><br> 
			Default Language: <input name="lang" type="text" size="60" maxlength="" value="<?php echo $conf[Page][lang]; ?>"><br><br>
			<input type="submit" value="Abschicken">
		</form>
		<?php
}

?>