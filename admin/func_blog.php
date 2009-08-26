<?php
if($_POST["add"]) {
	session_start();
	include_once("../config.php");
	$sql_comments_insert = "INSERT INTO sil_blog_articles (autor, title, content, tags, categories)
					VALUES ('".$_SESSION["user_id"]."', '".$_POST["title"]."', '".$_POST["elm1"]."', '".$_POST["tags"]."', '".$_POST["cate"]."')"; 
	mysql_query ($sql_comments_insert, $connectionid); 
	
	header ("Location: index.php?include=blog_articles"); 
} else if($_POST["edit"]) {
	session_start();
	include_once("../config.php");
	$sql_comments_insert = 	"UPDATE sil_blog_articles SET autor = '".$_SESSION["user_id"].
							"' , title = '".$_POST["title"].
							"' , content = '".$_POST["elm1"].
							"' , tags = '".$_POST["tags"].
							"' , categories = '".$_POST["cate"].
							"' WHERE id = ".$_POST["id"];
	mysql_query ($sql_comments_insert, $connectionid); 
	header ("Location: index.php?include=blog_articles"); 

} else if($_POST["remove"]) {
	include_once("../config.php");
	
	$sql_comments_remove = "DELETE FROM sil_blog_comments WHERE blogid = " . $_POST["id"];
	mysql_query ($sql_comments_remove, $connectionid); 
	$sql_comments_remove = "DELETE FROM sil_blog_articles WHERE id = " . $_POST["id"];
	mysql_query ($sql_comments_remove, $connectionid); 
	header ("Location: index.php?include=blog_articles"); 
}
?>