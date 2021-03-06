<!-- TinyMCE -->
<script type="text/javascript" src="../includes/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,style,layer,table,save,advhr,advimage,advlink,emotions,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,directionality,fullscreen,noneditable,visualchars,xhtmlxtras",

		relative_urls : true,
		document_base_url : "<?php echo $conf[System][url]; ?>",	
		
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,visualchars",
		theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
	});
</script>
<!-- /TinyMCE -->

<h1>Pages
<?php if($_GET["mode"]==add) { ?> - Add</h1><br />

<form action="func_pages.php" method="post">
<input type="hidden" name="add" value="true" />
 <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<div>Titel: <input type="text" name="title" size="80"><br /><br />
			<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%">
				&lt;p&gt;
					This is some example text that you can edit inside the &lt;strong&gt;TinyMCE editor&lt;/strong&gt;.
				&lt;/p&gt;
				&lt;p&gt;
				Nam nisi elit, cursus in rhoncus sit amet, pulvinar laoreet leo. Nam sed lectus quam, ut sagittis tellus. Quisque dignissim mauris a augue rutrum tempor. Donec vitae purus nec massa vestibulum ornare sit amet id tellus. Nunc quam mauris, fermentum nec lacinia eget, sollicitudin nec ante. Aliquam molestie volutpat dapibus. Nunc interdum viverra sodales. Morbi laoreet pulvinar gravida. Quisque ut turpis sagittis nunc accumsan vehicula. Duis elementum congue ultrices. Cras faucibus feugiat arcu quis lacinia. In hac habitasse platea dictumst. Pellentesque fermentum magna sit amet tellus varius ullamcorper. Vestibulum at urna augue, eget varius neque. Fusce facilisis venenatis dapibus. Integer non sem at arcu euismod tempor nec sed nisl. Morbi ultricies, mauris ut ultricies adipiscing, felis odio condimentum massa, et luctus est nunc nec eros.
				&lt;/p&gt;
			</textarea><br /> <br />
			
<input type="submit" value="Submit">
		</div>
</form>
<?php } else if($_GET["mode"]==edit) {?> - Edit - id: <?php echo $_GET["id"]; ?></h1><br />
<?php $sql = "SELECT * FROM sil_pages WHERE ( id = ".$_GET["id"]." )"; 
$result = mysql_query ($sql, $connectionid); 
$data = mysql_fetch_array ($result); ?>
<form action="func_pages.php" method="post">
<input type="hidden" name="edit" value="true" />
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
 <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<div>Title: <input type="text" name="title" size="80" value="<?php echo $data["title"]; ?>"><br /><br />
			<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%">
				<?php echo $data["content"]; ?>
			</textarea><br /> <br />

<input type="submit" value="Submit">
		</div>
</form>
<?php } else if($_GET["mode"]==remove) {?> - Remove - id: <?php echo $_GET["id"]; ?></h1><br />
Are you sure, you want to remove id <?php echo $_GET["id"]; ?> with the title 
<?php 
$sql = "SELECT * FROM sil_pages WHERE ( id = " .$_GET["id"]. " )"; 
$result = mysql_query ($sql, $connectionid); 
$data = mysql_fetch_array ($result);
echo $data["title"];
?>?<br /><br />
<form action="func_pages.php" method="post">
<input type="submit" value=" Remove ">
<input type="hidden" name="remove" value="true" />
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
<button  class="Cancel"  type="button" onclick="location.href='index.php?include=pages'" id="Cancel">Cancel</button>
</form>
<?php } else {
	echo "</h1><br />";
	$sql = "SELECT * FROM sil_pages ORDER BY id DESC"; 
	$result = mysql_query ($sql, $connectionid); 
	echo "<table width=100%><tr><td>id</td><td>title</td></tr>";
	while ($data = mysql_fetch_array ($result)) {
		echo "<tr>";
		echo "<td>".$data["id"]."</td>";
		echo "<td>".$data["title"]."</td>";
		//echo "<td>".$data["autor"]."</td>";
		//echo "<td>".$data["creation_date"]."</td>"; 
		//echo "<td>".$data["categories"]."</td>";
		echo 	"<td><a href=index.php?include=pages&mode=edit&id=".$data["id"]."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-find.png></a>&nbsp;".
				"<a href=index.php?include=pages&mode=remove&id=".$data["id"]."><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/edit-delete.png></a>".
				"</td>";
		echo "</tr>";
	}
	echo "</table><br><a href=index.php?include=pages&mode=add><img style='border-style: none' src=".$conf[System][url]."/includes/templates/".$conf[Page][design]."/img/list-add.png>&nbsp;Add page</a>";
}
?>