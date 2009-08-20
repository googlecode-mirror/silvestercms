<?
session_start();
include_once("config.php");

$sql = "SELECT id, user, role FROM sil_user WHERE ( user = '".$_POST["name"]."' ) AND ( pass = '".md5 ($_POST["pwd"])."' )"; 
$result = mysql_query ($sql, $connectionid);   
print mysql_error(); 

if (mysql_num_rows ($result) > 0) 
{ 
  // Benutzerdaten in ein Array auslesen. 
  $data = mysql_fetch_array ($result); 

  // Sessionvariablen erstellen und registrieren 
  $_SESSION["user_id"] = $data["id"]; 
  $_SESSION["user_name"] = $data["user"]; 
  $_SESSION["user_role"] = $data["role"]; 
  $_SESSION["lang"] = $conf[Page][lang];//$data["role"]; 
  if(@$_SERVER['HTTP_REFERER'] != '')
   header('Location: '.$_SERVER['HTTP_REFERER']);
  else
	header ("Location: index.php"); 
} 
else 
{ 
  header ("Location: login.php?error=1"); 
}  
?>
