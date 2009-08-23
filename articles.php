<?
include_once($path."config.php");
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/header.php");


if(isset($_POST["add"])) {
	$sql_comments_insert = "INSERT INTO sil_blog_comments (blogid, autor, title, content)
				VALUES ('".$_GET["id"]."', '".$_SESSION["user_name"]."', '".$_POST["title"]."', '".$_POST["content"]."')"; 
	mysql_query ($sql_comments_insert, $connectionid); 
}

// id, autor, title, content,tags,categories, creation_date
$sql = "SELECT * FROM sil_blog_articles WHERE ( id = ".$_GET["id"]." )"; 
$result = mysql_query ($sql, $connectionid); 
$data = mysql_fetch_array ($result);

$sql = "SELECT * FROM sil_user WHERE ( user = '".$data[autor]."' )";	 
$result = mysql_query ($sql, $connectionid); 
$data_profile = mysql_fetch_array ($result);

$tags = explode("; ",$data['tags']);
reset($tags);
$get_tags = " ";
foreach($tags as $line => $value)
{ $get_tags = $get_tags. "<a href=index.php?tag=".preg_replace('/\s/', '%20', $value).">".$value."</a>&nbsp;"; } 

include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/articles_article_self.php");

// id, autor, title, content,tags,categories, creation_date
$sql = "SELECT * FROM sil_blog_comments WHERE ( blogid = '".$_GET["id"]."') ORDER BY creation_date ASC"; 
$result = mysql_query ($sql, $connectionid);   
$row_num = mysql_num_rows($result); 
$max_articles = 15; 
$page_num = ceil($row_num/$max_articles);

	if($_GET['page'] == 1 || !isset($_GET['page']))
    {
		// id, autor, title, content,tags,categories, creation_date
        $result2 = mysql_query("SELECT * FROM sil_blog_comments WHERE ( blogid = '".$_GET["id"]."') ORDER BY creation_date ASC LIMIT 0,$max_articles", $connectionid);
        while ($row = mysql_fetch_assoc($result2)) {
        		// For profile links
        		$sql = "SELECT * FROM sil_user WHERE ( user = '".$row[autor]."' )";	 
				$result = mysql_query ($sql, $connectionid); 
				$data = mysql_fetch_array ($result);
				
				include($conf[System][path]."includes/templates/".$conf[Page][design]."/articles_comments.php");
           }
		   ?><br> <?php echo get_lang("general_page"); ?> <?
        for($i = 1;$i<($page_num +1);$i++)
            {
                echo "<a href='articles.php?id=".$_GET["id"]."&page=".$i."'>".$i."</a>&nbsp;";
            }
			?><br><br><?
    }  
	if ($_GET['page'] >1)
    { 	
		 $start=($_GET['page']*$max_articles)-$max_articles; 
		 
		 // id, autor, title, content,tags,categories, creation_date
        $result2 = mysql_query("SELECT * FROM sil_blog_comments WHERE ( blogid = '".$_GET["id"]."') ORDER BY creation_date ASC LIMIT $start,$max_articles", $connectionid);
        while ($row = mysql_fetch_assoc($result2)) {
        		// For profile links
        		$sql = "SELECT * FROM sil_user WHERE ( user = '".$row[autor]."' )";	 
				$result = mysql_query ($sql, $connectionid); 
				$data = mysql_fetch_array ($result);

				include($conf[System][path]."includes/templates/".$conf[Page][design]."/articles_comments.php");
            }
			 ?><br> <?php echo get_lang("general_page"); ?> <?
        for($c = 1;$c<($page_num +1);$c++)
            {
                echo "<a href='articles.php?id=".$_GET["id"]."&page=".$c."'>".$c."</a>&nbsp;";
            }
			?><br><br><?
    }  
?>
	<div style="background-color:#F9F9F9;">
			<div style="position:relative;left:10px;width:560px;"><br><hr>
			<span style="font-size:18px;"><?php echo get_lang("blog_send_comment"); ?></span><hr>
			<? if(isset($_SESSION["user_name"])) { 
				echo "<form action=\"articles.php?id=".$_GET["id"]."\" method=\"post\">";
			?>
				<br>
				<input type="hidden" name="add" value="">
				<?php echo get_lang("general_name"); ?>: <? echo $_SESSION["user_name"]; ?> / <? $datum = date("d.m.Y",time()); $uhrzeit = date("H:i",time()); echo $datum," - ",$uhrzeit,"";?><br>
				<?php echo get_lang("general_title"); ?>: <input type="text" name="title" size="20"><br><br>
				<textarea name="content" cols="45" rows="7"></textarea><br><br>
				<input type="submit" value="<?php echo get_lang("general_send"); ?>"> <br>
				</form><br>
			<? } else { echo get_lang("blog_loggedin_comments"); }?>
			</div>
	</div>
</div>
<div style="float:right; width:300px;">
	<div style="background-color:#F9F9F9;">
		<div style="position:relative;width:280px;left:10px;"><br><u><?php echo get_lang("blocks_latestarticles"); ?></u><br>
		<?php $result = mysql_query("SELECT * FROM sil_blog_articles ORDER BY creation_date DESC"); 
		echo "<ul>";
		$i = 0;
		while ($row = mysql_fetch_assoc($result)) {
			$i++;
			$sql = "SELECT * FROM sil_user WHERE ( user = '".$row[autor]."' )";	 
$result2 = mysql_query ($sql, $connectionid); 
$data_profile = mysql_fetch_array ($result2);
			echo "<li><a href='articles.php?id=".$row["id"]."'>".$row["title"]."</a></li>";
			echo "<ul><li style='font-size:11px;'>".get_lang("general_by")." <a href=profile.php?id=".$data_profile[id].">".$row["autor"]."</a> ".get_lang("general_on")." ".$row["creation_date"]."</li></ul>";
			if($i == 5) break;
        }
       	echo "</ul>";
		?>
		<br><br></div>
	</div>
	<br>
	<div style="background-color:#F9F9F9;">
		<div style="position:relative;width:280px;left:10px;"><br><u><?php echo get_lang("blocks_latestcomments"); ?></u><br><br>
		<?php $result = mysql_query("SELECT * FROM sil_blog_comments ORDER BY commentid DESC"); 
		echo "<ul>";
		$i = 0;
		while ($row = mysql_fetch_assoc($result)) {
			$i++;
			$result2 = mysql_query("SELECT * FROM sil_blog_articles WHERE ( id = ". $row["blogid"].")"); 
			$row2 = mysql_fetch_assoc($result2);
			
			$sql = "SELECT * FROM sil_user WHERE ( user = '".$row[autor]."' )";	 
$result3 = mysql_query ($sql, $connectionid); 
$data_profile = mysql_fetch_array ($result3);
			echo "<li><a href='articles.php?id=".$row2["id"]."'>".$row2["title"]."</a></li>";
			echo "<ul><li style='font-size:11px;'>".get_lang("general_by")." <a href=profile.php?id=".$data_profile[id].">".$row["autor"]."</a> ".get_lang("general_on")." ".$row["creation_date"]."</li></ul>";
			if($i == 5) break;
        }
       	echo "</ul>";
		?>		<br><br></div>
	</div>
</div>
<div style="clear:both;"></div>
<?
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/footer.php");
?>