<h1>Blog Category Management</h1>
<?php 
if($_POST["added"]) {
		$sql_comments_insert = "INSERT INTO sil_blog_categories (name)
					VALUES ('".$_POST["category"]."')"; 
		mysql_query ($sql_comments_insert, $connectionid); 
} 
if($_GET["mode"] == "remove") {
	$sql_comments_remove = "DELETE FROM sil_blog_categories WHERE id = " . $_GET["id"];
		mysql_query ($sql_comments_remove, $connectionid); 
}
?>
<?php
	echo "<br />";
	$sql = "SELECT * FROM sil_blog_categories"; 
	$result = mysql_query ($sql, $connectionid); 
	echo "<table width=100%><tr><td>id</td><td>title</td></tr>";
	while ($data = mysql_fetch_array ($result)) {
		echo "<tr>";
		echo "<td>".$data["id"]."</td>";
		echo "<td>".$data["name"]."</td>";
		//echo "<td>".$data["autor"]."</td>";
		//echo "<td>".$data["creation_date"]."</td>"; 
		//echo "<td>".$data["categories"]."</td>";
		echo 	"<td><a href=index.php?include=blog_cate&mode=remove&id=".$data["id"]."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-delete.png></a>".
				"</td>";
		echo "</tr>";
	}
	echo "</table><br><form action=index.php?include=blog_cate method=post>Add: <input type=text name=category>&nbsp;<input type=hidden name=added value=true /><input type=submit value=Add></form>";
?>