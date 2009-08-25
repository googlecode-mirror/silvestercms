<?php if($_POST["removeit"]) {
	include_once("../config.php");
	$sql_comments_remove = "DELETE FROM sil_user_roles WHERE id = " . $_POST["id"];
	mysql_query ($sql_comments_remove, $connectionid); 
}
 if($_POST["added"]) {
	include_once("../config.php");
	$sql_comments_insert = "INSERT INTO sil_user_roles (role, blog_articles_read, blog_articles_write, blog_comments_write, profiles_view, admin_system)
							VALUES ('".$_POST["role"]."', ".$_POST["blog_articles_read"].", ".$_POST["blog_articles_write"].", ".$_POST["blog_comments_write"].", ".$_POST["profiles_view"].", ".$_POST["admin_system"].")"; 
	echo $sql_comments_insert;
	mysql_query ($sql_comments_insert, $connectionid); 
} 
 if($_POST["edited"]) {
	include_once("../config.php");
	$sql_comments_insert = 	"UPDATE sil_user_roles SET role = '".$_POST["role"].
						"' , blog_articles_read = '".$_POST["blog_articles_read"].
						"' , blog_articles_write = '".$_POST["blog_articles_write"].
						"' , blog_comments_write = '".$_POST["blog_comments_write"].
						"' , profiles_view = '".$_POST["profiles_view"].
						"' , admin_system = '".$_POST["admin_system"].
						"' WHERE id = ".$_POST["id"];
	mysql_query ($sql_comments_insert, $connectionid); 
} ?>
<h1>User Role Management 
<?php if($_GET["mode"]==add) { ?> - Add</h1><br />
<form action="index.php?include=roles" method="post"> 
<input type="hidden" name="added" value=true />
Role name: <input type="text" name=role /><br />
blog_articles_read = <select size=1 name=blog_articles_read><option>0</option><option>1</option></select><br />
blog_articles_write =  <select size=1 name=blog_articles_write><option>0</option><option>1</option></select><br />
blog_comments_write =  <select size=1 name=blog_comments_write><option>0</option><option>1</option></select><br />
profiles_view =  <select size=1 name=profiles_view><option>0</option><option>1</option></select><br />
admin_system =  <select size=1 name=admin_system><option>0</option><option>1</option></select><br /><br />
<input type="submit" name="Submit" /></form>

<?php } else if($_GET["mode"]==edit) {?> - Edit - id: <?php echo $_GET["id"]; ?></h1><br />
<?php 
$sql = "SELECT * FROM sil_user_roles WHERE ( id = " .$_GET["id"]. " )";
$result = mysql_query ($sql, $connectionid); 
$data = mysql_fetch_array ($result);
?>
<form action="index.php?include=roles" method="post"> 
<input type="hidden" name="edited" value=true />
<input type="hidden" name="id" value=<?php echo $data["id"]; ?> />
Role name: <input type="text" name=role value="<?php echo $data["role"]; ?>" /><br />
blog_articles_read = <select size=1 name=blog_articles_read><option>0</option><option>1</option></select><br />
blog_articles_write =  <select size=1 name=blog_articles_write><option>0</option><option>1</option></select><br />
blog_comments_write =  <select size=1 name=blog_comments_write><option>0</option><option>1</option></select><br />
profiles_view =  <select size=1 name=profiles_view><option>0</option><option>1</option></select><br />
admin_system =  <select size=1 name=admin_system><option>0</option><option>1</option></select><br /><br />
<input type="submit" name="Submit" /></form>

<?php } else if($_GET["mode"]==remove) {?> - Remove - id: <?php echo $_GET["id"]; ?></h1><br />
Are you sure, you want to remove id <?php echo $_GET["id"]; ?> with the title 
<?php 
$sql = "SELECT * FROM sil_user_roles WHERE ( id = " .$_GET["id"]. " )"; 
$result = mysql_query ($sql, $connectionid); 
$data = mysql_fetch_array ($result);
echo $data["role"];
?>?<br /><br />
<form action="index.php?include=roles" method="post">
<input type="submit" value=" Remove ">
<input type="hidden" name="removeit" value="true" />
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
<button  class="Cancel"  type="button" onclick="location.href='index.php?include=roles'" id="Cancel">Cancel</button>
</form>
<?php } else {
	echo "</h1><br />";
	$sql = "SELECT * FROM sil_user_roles"; 
	$result = mysql_query ($sql, $connectionid); 
	echo "<table width=100%><tr><td>id</td><td>role</td><td>b_a_r</td><td>b_a_w</td><td>b_c_w</td><td>p_v</td><td>a_s</td></tr>";
	while ($data = mysql_fetch_array ($result)) {
		echo "<tr>";
		echo "<td>".$data["id"]."</td>";
		echo "<td>".$data["role"]."</td>";
		echo "<td>".$data["blog_articles_read"]."</td>";
		echo "<td>".$data["blog_articles_write"]."</td>"; 
		echo "<td>".$data["blog_comments_write"]."</td>";
		echo "<td>".$data["profiles_view"]."</td>";
		echo "<td>".$data["admin_system"]."</td>";
		echo 	"<td><a href=index.php?include=roles&mode=edit&id=".$data["id"]."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-find.png></a>&nbsp;".
				"<a href=index.php?include=roles&mode=remove&id=".$data["id"]."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-delete.png></a>".
				"</td>";
		echo "</tr>";
	}
	echo "</table><br><a href=index.php?include=roles&mode=add><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/list-add.png>&nbsp;Add roles</a><br /><br />"; 
?>
Legend:<br />b_a_r = blog_articles_read<br />
b_a_w = blog_articles_write <br/>
b_c_w = blog_comments_write <br/>
p_v = profiles_view <br/> 
a_s = admin_system <br/> 
<?php
} ?>