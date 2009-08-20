<?
// Starting session
session_start();

// If Admin -> Start Admincenter
if($_SESSION["user_role"] == "Administrator") {
	include "admin.php";
	
// If Not -> Redirect to main page
} else {
	header("Location: ../index.php", 3);
	echo "Keine Zugriffsrechte!";
}
?>