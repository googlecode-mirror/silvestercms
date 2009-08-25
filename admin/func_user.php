<?php
if($_POST["add"]) {
	include_once("../config.php");
	
//$sql_comments_insert = "INSERT INTO sil_user (title, content)
	//				VALUES ('".$_POST["title"]."', '".$_POST["elm1"]."')"; 
	//	mysql_query ($sql_comments_insert, $connectionid); 
		
		header ("Location: index.php?include=user");
} else if($_POST["edit"]) {
//	include_once("../config.php");
//	$sql_comments_insert = 	"UPDATE sil_pages SET title = '".$_POST["title"].
//							"' , content = '".$_POST["elm1"].
//							"' WHERE id = ".$_POST["id"];
//	mysql_query ($sql_comments_insert, $connectionid); 
	header ("Location: index.php?include=user"); 
} else if($_POST["remove"]) {
	include_once("../config.php");
	
	$sql_comments_remove = "DELETE FROM sil_user WHERE id = " . $_POST["id"];
	mysql_query ($sql_comments_remove, $connectionid); 
	header ("Location: index.php?include=user"); 
}
?>