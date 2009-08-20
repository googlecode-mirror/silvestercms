<? 
/** CONFIG MANUAL
 * Edit config_inc.php on your own risk - documentation:
 * 
 * <DB>: 
 * 	Mysql Config		The configuration of MySql - needed to connect database for data // Notice: Can destroy your installation..
 * <System>:
 * 	Captcha: 			Set on false, if you don't want captcha checks...
 * 						Notice: It needs GD module for PHP. If there are no captchas, your hosting service might not have GD module installed.
 * 						Activating this without having GD module might lead to register problems.
 * 	Path/Url:			Set to the absolute Path/Url to your silvesterCMS installation // Notice: Can destroy your installation..
 * 	Maintenance Mode:	Set the maintenance keyword to something like a password... if you are in maintenance mode, you can still access your
 * 						website through visiting it with index.php?<your keyword>
 * 						Additionally, the website will be accessible by every kind of administrators of the webpage, so you might
 * 						want to log in after accessing page with index.php?<your keyword>
 * 						Note: The parameter <your keyword> won't passed through links, so you will get the maintenance page after clicking on links.
 * 						The parameter should be only seen as a way to access log in menu.
 * <Page>:					
 * 	Pagename/Pagedescr:	Details about your Page
 * 	Design/Lang:		The design and language you're setting here will be the default option for new created users and guests.
 * 						Note: You're able to activate language and design-switching menus or modules on frontpage.
 **/
include_once("admin/config_inc.php");

////////////////
// DONT TOUCH // 
////////////////

// For nightlies: display svn revision id instead of version in footer
$svn = File('.svn/entries');
$svnrev = $svn[3];
unset($svn);
$verstring = "revision ".$svnrev;

// For releases
//$verstring = "v0.1b1";

// Init Language System
include_once("includes/lang_functions.php");

// Init MySQL
$connectionid = mysql_connect ($conf[DB][mysql_host], $conf[DB][mysql_user], $conf[DB][mysql_password]); 
if (!mysql_select_db ($conf[DB][mysql_database], $connectionid)) 
{ 
	$n = "[".date("D M j G:i:s T Y")."] No connection to MySQL server.\n";
	$handle = fopen("silv.log", "a+");
	fputs($handle,$n);
	fclose($handle);
  	die ("Keine Verbindung zur Datenbank"); 
}  
?>