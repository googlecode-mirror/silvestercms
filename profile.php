<?
include_once("config.php");
if($_POST["edited"]) {
	session_start();
	if(isset($_SESSION["user_name"])) {
		$sql_comments_insert = 	"UPDATE sil_user SET profile_name = '".$_POST["profile_name"].
								"' , mail = '".$_POST["mail"].
								"' , profile_page = '".$_POST["profile_page"].
								"' , profile_icq = '".$_POST["profile_icq"].
								"' , profile_msn = '".$_POST["profile_msn"].
								"' , profile_jabber = '".$_POST["profile_jabber"].
								"' , profile_date = '".$_POST["profile_date"].
								"' WHERE ( user = '".$_POST["user"]."' )";
		mysql_query ($sql_comments_insert, $connectionid);  
	} else {
	echo get_lang("profile_loggedin_edit");
	}
} 
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/header.php");

if($_POST["upload"]) {
	$uploaddir = $conf[System][path].'/uploads/avatar/';
	$uploadfile = $uploaddir . $_POST["user"] ."__". basename($_FILES['userfile']['name']);//$_FILES['userfile']['name']);
	
	$uploaddir_url = $conf[System][url].'/uploads/avatar/';
	$uploadfile_url = $uploaddir_url . $_POST["user"] ."__". basename($_FILES['userfile']['name']);//$_FILES['userfile']['name']);
	
	echo '<pre>';
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	    echo get_lang("profile_upload_succ")." -> ".$uploadfile."\n";
	} else {
	    echo get_lang("profile_upload_err")."\n";
	}

	echo '<br />';
	$sql_comments_insert = 	"UPDATE sil_user SET profile_avatar = '".$uploadfile_url."' WHERE ( user = '".$_POST["user"]."' )";
	mysql_query ($sql_comments_insert, $connectionid);
	print "</pre>";
}
?>
<div style="width:100%;background-color:;">
<table width=100%>
<?php 
if($_GET["mode"] == "edit") {
	if(isset($_SESSION["user_name"])) {
		if($_GET["id"] != "")
			$sql = "SELECT * FROM sil_user WHERE ( id = ".$_GET["id"]." )";
		else
			$sql = "SELECT * FROM sil_user WHERE ( user = '".$_SESSION["user_name"]."' )";	 
		$result = mysql_query ($sql, $connectionid); 
		$data = mysql_fetch_array ($result);
?>
<tr><td colspan=2 style="background-color:orange;"><center><br /><?php echo get_lang("profile_edit"); ?></center>
<br /></tr>
<tr style="background-color:#F9F9F9;" valign=top>
<td width=30%><br /><center><?php echo $data["user"]; ?><br /><?php echo $data["role"]; ?><br /><br />
<img src="<?php 
if($data["profile_avatar"] !="") { 
	echo $data["profile_avatar"]; 
} else { 
	echo $conf[System][url]."/includes/templates/Default/img/default_profile_normal.png"; 
} ?>" width=50 height=50 />
<br /><br />
<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="profile.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <input type="hidden" name="upload" value="true" />
    <input type="hidden" name="user" value="<?php echo $_SESSION["user_name"]; ?>" />
    <!-- Name of input element determines name in $_FILES array -->
    <?php echo get_lang("profile_upload"); ?>:<br /><input name="userfile" type="file" size=8 /><br />
    <input type="submit" value="<?php echo get_lang("general_send"); ?>" />
</form>
</center></td>
<td >
<form action="profile.php" method="post">
<input type="hidden" name="edited" value="1" />
<input type="hidden" name="user" value="<?php echo $_SESSION["user_name"]; ?>" />
<br /><?php echo get_lang("general_name"); ?>: <input type="text" name="profile_name" value="<?php echo $data["profile_name"]; ?>" /><br /><?php echo get_lang("profile_date"); ?>: <input type="text" name="profile_date" value="<?php echo $data["profile_date"]; ?>" /><br /><?php echo get_lang("register_mail"); ?>: <input type="text" name="mail" value="<?php echo $data["mail"]; ?>" /><br /><?php echo get_lang("profile_page"); ?>: <input type="text" name="profile_page" value="<?php echo $data["profile_page"]; ?>" /><br /><br /><?php echo get_lang("profile_icq"); ?>: <input type="text" name="profile_icq" value="<?php echo $data["profile_icq"]; ?>" /><br /><?php echo get_lang("profile_msn"); ?>: <input type="text" name="profile_msn" value="<?php echo $data["profile_msn"]; ?>" /><br/><?php echo get_lang("profile_jabber"); ?>: <input type="text" name="profile_jabber" value="<?php echo $data["profile_jabber"]; ?>" /><br /><br /><input type="submit" name="<?php echo get_lang("general_send"); ?>" /></td>
</tr>
</form>
<?php	
	} else {
		echo get_lang("profile_loggedin_edit");
	}
} else {
	if($_GET["id"] != "")
		$sql = "SELECT * FROM sil_user WHERE ( id = ".$_GET["id"]." )";
	else
		$sql = "SELECT * FROM sil_user WHERE ( user = '".$_SESSION["user_name"]."' )";	 
	$result = mysql_query ($sql, $connectionid); 
	$data = mysql_fetch_array ($result);
	if(isset($_SESSION["user_name"])) {
?>
<tr><td colspan=2 style="background-color:orange;"><span><center><br /><?php echo get_lang("profile_of"); ?> <?php echo $data["user"]; ?>
<?php if($_SESSION["user_name"] == $data["user"]) { echo "<div style=position:absolute;left:635px;top:35px;>".get_lang("profile_edit_link")." <a href=profile.php?mode=edit>".get_lang("profile_edit_click")."</a></div>"; }?><br /><br /></center></span></td>
</tr>
<tr style="background-color:#F9F9F9;" valign=top>
<td width=30%><br /><center><?php echo $data["user"]; ?><br /><?php echo $data["role"]; ?><br /><br /><img src="<?php if($data["profile_avatar"] !="") { echo $data["profile_avatar"]; } else  { echo $conf[System][url]."/includes/templates/Default/img/default_profile_normal.png"; } ?>" width=50 height=50 /></center></td>
<td ><br /><?php echo get_lang("general_name"); ?>: <?php echo $data["profile_name"]; ?><br /><?php echo get_lang("profile_date"); ?>: <?php echo $data["profile_date"]; ?><br /><?php echo get_lang("register_mail"); ?>: <?php echo $data["mail"]; ?><br />Page: <?php echo $data["profile_page"]; ?><br /><br />ICQ: <?php echo $data["profile_icq"]; ?><br />MSN: <?php echo $data["profile_msn"]; ?><br/>Jabber: <?php echo $data["profile_jabber"]; ?><br /><br /></td>

</tr>
<?php 
	} else {
	echo get_lang("profile_loggedin_view");
	}
}
?>
</table>
</div>
<?
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/footer.php");
?>