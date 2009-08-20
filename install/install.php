<?
include("../config.php");

mysql_query ("

CREATE TABLE IF NOT EXISTS `sil_blog_articles` (
  `id` int(11) NOT NULL auto_increment,
  `autor` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `tags` varchar(50) NOT NULL,
  `categories` varchar(50) NOT NULL,
  `creation_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `sil_blog_comments` (
  `commentid` int(11) NOT NULL auto_increment,
  `blogid` int(11) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(250) NOT NULL,
  `creation_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`commentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `sil_pages` (
  `id` int(11) NOT NULL auto_increment,
  `conent` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `sil_user` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '',
  `pass` varchar(50) NOT NULL default '',
  `mail` varchar(50) NOT NULL default '',
  `profile_name` varchar(50) NOT NULL default '',
  `profile_avatar` varchar(50) NOT NULL default '',
  `profile_icq` varchar(50) NOT NULL default '',
  `profile_msn` varchar(50) NOT NULL default '',
  `profile_jabber` varchar(50) NOT NULL default '',
  `profile_page` varchar(50) NOT NULL default '',
  `profile_date` varchar(50) NOT NULL default '',
  `role` varchar(50) NOT NULL default 'User',
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

");


// Definition der Benutzer 
$benutzer[0]["user"] = "admin"; 
$benutzer[0]["pass"] = "admin";  

mysql_query ("DELETE FROM sil_user"); 

// Daten eintragen 
while (list ($key, $value) = each ($benutzer)) 
{ 
  // SQL-Anweisung erstellen 
  $sql = "INSERT INTO ".
    "sil_user (user,pass) ".
  "VALUES ('".$value["user"]."', '".
                       md5 ($value["pass"])."')"; 
  mysql_query ($sql); 

  if (mysql_affected_rows ($connectionid) > 0) 
  { 
    echo "Benutzer erfolgreich angelegt.<br>\n"; 
  } 
  else 
  { 
   echo "Fehler beim Anlegen der Benutzer.<br>\n"; 
  } 
} 

?>