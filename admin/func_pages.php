<?php
if($_POST["add"]) {
	include_once("../config.php");
	
	$sql_comments_insert = "INSERT INTO sil_pages (title, content)
					VALUES ('".$_POST["title"]."', '".$_POST["elm1"]."')"; 
		mysql_query ($sql_comments_insert, $connectionid); 
		
		header ("Location: index.php?include=pages");
} else if($_POST["edit"]) {
	include_once("../config.php");
	$sql_comments_insert = 	"UPDATE sil_pages SET title = '".$_POST["title"].
							"' , content = '".$_POST["elm1"].
							"' WHERE id = ".$_POST["id"];
	mysql_query ($sql_comments_insert, $connectionid); 
	header ("Location: index.php?include=pages"); 
} else if($_POST["remove"]) {
	include_once("../config.php");
	
	$sql_comments_remove = "DELETE FROM sil_pages WHERE id = " . $_POST["id"];
	mysql_query ($sql_comments_remove, $connectionid); 
	header ("Location: index.php?include=pages"); 
}
?>