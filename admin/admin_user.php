<h1>Users
<?php if($_GET["mode"]==add) { ?> - Add</h1><br />
<?php } else if($_GET["mode"]==edit) {?> - Edit - id: <?php echo $_GET["id"]; ?></h1><br />
<?php } else if($_GET["mode"]==remove) {?> - Remove - id: <?php echo $_GET["id"]; ?></h1><br />
Are you sure, you want to remove id <?php echo $_GET["id"]; ?> with the title 
<?php 
$sql = "SELECT * FROM sil_user WHERE ( id = " .$_GET["id"]. " )"; 
$result = mysql_query ($sql, $connectionid); 
$data = mysql_fetch_array ($result);
echo $data["user"]." / ".$data["mail"];
?>?<br /><br />
<form action="func_user.php" method="post">
<input type="submit" value=" Remove ">
<input type="hidden" name="removeit" value="true" />
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
<button  class="Cancel"  type="button" onclick="location.href='index.php?include=user'" id="Cancel">Cancel</button>
</form>
<?php } else {
	?></h1><?php
	$sql = "SELECT * FROM sil_user ORDER BY id DESC"; 
	$result = mysql_query ($sql, $connectionid); 
	echo "<table width=100%><tr><td>id</td><td>username</td><td>mail</td><td>role</td></tr>";
	while ($data = mysql_fetch_array ($result)) {
		echo "<tr>";
		echo "<td>".$data["id"]."</td>";
		echo "<td>".$data["user"]."</td>";
		echo "<td>".$data["mail"]."</td>";
		echo "<td>".$data["role"]."</td>"; 
		//echo "<td>".$data["categories"]."</td>";
		echo 	"<td><a href=index.php?include=user&mode=edit&id=".$data["id"]."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-find.png></a>&nbsp;".
				"<a href=index.php?include=user&mode=remove&id=".$data["id"]."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-delete.png></a>".
				"</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>