<? $title = "adminCP";
include_once("../config.php");
include_once("./admin_incl_header.php");

//  $n = "[".date("D M j G:i:s T Y")."] User ".$_SESSION["user-name"]." accesses adminCP.\n";
//  $handle = fopen("../silv.log", "a+");
//  fputs($handle,$n);
//  fclose($handle);
  
?>
<div style="position:relative; right:20px;float:left;">
<ul>
	<li>Blog</li>
	<ul>
		<li>
			Options
		</li>
		<li>
			<a href="?include=blog_articles">Articles</a>
		</li>
		<li>
			<a href="?include=blog_cate">Categories</a>
		</li>
		<li>
			Comments
		</li>
	</ul>
</ul>
<ul>
	<li>Pages</li>
	<ul>
		<li>
			<a href="?include=pages">Pages</a>
		</li>
	</ul>
</ul>
<ul>
	<li>Forum</li>
	<ul>
		<li>
			General Options
		</li>
		<li>
			Forum Options
		</li>
	</ul>
</ul>
<ul>
	<li>System</li>
	<ul>
		<li>
			<a href="?include=options">Options</a>
		</li>
		<li>
			<a href="?include=user">Users</a>
		</li>
		<li>
			<a href="?include=logs">DEBUG / Logs</a>
		</li>
		<li>
			<a href="?include=backup">Backup</a>
		</li>
		<li>
			<a href="?include=phpinfo">PhpInfo();</a>
		</li>
	</ul>
</ul>

<ul>
	<li>Add-Ons</li>
	<ul>
		<li>
			<a href="?include=lang">Language packs</a>
		</li>
		<li>
			<a href="?include=design">Templates</a>
		</li>
		<li>
			Plugins
		</li>
	</ul>
</ul>
</div>
<div style="float:right; width:660px;">
<?php 
if($_GET["include"]){
	include_once("./admin_" . $_GET["include"] . ".php");	
} else {
	include_once("./admin_start.php");	
}
?>
</div>
<div style="clear:both"></div>
<?php
include_once("./admin_incl_footer.php");
?>