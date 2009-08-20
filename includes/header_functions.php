<? 
include_once("config.php");

function sil_maintenance() {
	global $conf;
	if(!isset($_GET[$conf[System][mainte_keyword]]))  {
		if($_SESSION["user_role"] != "Administrator") {
			if($conf[System][maintenance]) {
				echo get_lang("system_maintenance").$conf[Page][pagename].get_lang("system_maintenance_2")."<br><br>";
				exit();
			}
		}
	}
}

function sil_head_login() { 
	if(!isset($_SESSION["user_name"])) { 
		?><form action="login_session.php" method="post"><?			   
		$url = 'http://'.$_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
		echo "<input id=\"referer\" name=\"referer\" type=\"hidden\" value=\".$url.\" />";
		?>
		User: <input id="name" name="name" type="text" style="width:75px;" /> 
		Pass: <input id="pwd" type="password" name="pwd" style="width:75px;" />
		&nbsp;<input id="Login" type="submit" value=">>" style="width:25px;" />
	   </form> 
	<? } else { ?>
		Hallo, 
	<? echo $_SESSION["user_name"]." (".$_SESSION["user_role"].")"; } 
} 

function sil_head_lang() {
	global $conf;
	if ($handle = opendir("/".$conf[System][path]."/includes/lang")) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != ".svn" && $file != ".DS_Store") {
				echo "<a href=\"".$conf[System][url]."/includes/lang_functions.php?change_lang=".$file."\"><img style='border-style: none' src=\"".$conf[System][url]."/includes/lang/$file/$file.png\"></a>&nbsp;&nbsp;";
			}
		}
		closedir($handle);
	}
}
function sil_head_nav() { ?>
	<ul id="navlist">
		<li>
			<a href="index.php"><?php echo get_lang("navbar_start");?></a>
		</li>
		
		<li>
			<a href=""><?php echo get_lang("navbar_forum");?></a>
		</li>
		<? sil_head_nav_pages(); ?>
	</ul><?
}

function sil_head_nav_pages() {
	global $connectionid;
	$sql = "SELECT * FROM sil_pages";
	$result = mysql_query ($sql, $connectionid);   
	while ($row = mysql_fetch_assoc($result)) {
		?><li><a href="pages.php?id=<? echo $row['id']; ?>"><? echo $row['title']; ?></a></li><?
    }
}

function sil_head_nav_logged() { ?>
	<ul id="navlist">
	<? if(!isset($_SESSION["user_name"])) { ?>
		<li>
			<a href="register.php"><?php echo get_lang("navbar_register");?></a>
		</li>
		<li>
			<a href="login.php"><?php echo get_lang("navbar_login");?></a>
		</li>
	<? } else { ?>
		<li>
			<a href="profile.php"><?php echo get_lang("navbar_profile");?></a>
		</li>
		<? if($_SESSION["user_role"] == "Administrator") { ?>
			<li>
				<a href="admin/index.php"><?php echo get_lang("navbar_admin");?></a>
			</li> 
		<? } ?>
		<li>
			<a href="logout.php"><?php echo get_lang("navbar_logout");?></a>
		</li> 
	<? } ?>
	</ul> <?
}

function sil_powered() {
	// footer function
	echo "Powered by silvesterCMS ".$verstring." / Copyright Marc A. Kastner 2009";
}
?>