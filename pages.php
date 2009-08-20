<?php
include_once("config.php");

global $connectionid;
$sql = "SELECT * FROM sil_pages WHERE ( id = '" .$_GET["id"]. "')";
$result = mysql_query ($sql, $connectionid);   
$row = mysql_fetch_assoc($result);

$title = $pagename . " - " . $row['title'];
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/header.php");

echo $row['content'];

include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/footer.php");
?>