<?php
include_once("config.php");
$title = $conf[Page][pagename] . " - Startseite";
include_once($conf[System][path]."includes/templates/".$conf[Page][design]."/header.php");

// id, autor, title, content,tags,categories, creation_date
if(isset($_GET["category"])) {
	$sql = "SELECT * FROM sil_blog_articles WHERE ( categories = '".$_GET["category"]."') ORDER BY creation_date DESC"; 
} else if(isset($_GET["tag"])) {
	$sql = "SELECT * FROM sil_blog_articles WHERE ( tags = '".$_GET["tag"]."') ORDER BY creation_date DESC"; 
} else {
	$sql = "SELECT * FROM sil_blog_articles ORDER BY creation_date DESC";
}
$result = mysql_query ($sql, $connectionid);   
$row_num = mysql_num_rows($result); 
$max_articles = 5; 
$page_num = ceil($row_num/$max_articles);
?>
<div style="float:left;width:580px;">
<?
	if($_GET['page'] == 1 || !isset($_GET['page']))
    {
		// id, autor, title, content,tags,categories, creation_date
    	if(isset($_GET["category"]))
			$getstring =  " WHERE ( categories = '".$_GET["category"]."') ";
		else if(isset($_GET["tag"]))
			$getstring =  " WHERE ( tags = '".$_GET["tag"]."') ";
		else
			$getstring =  "";
        $result2 = mysql_query("SELECT * FROM sil_blog_articles ".$getstring." ORDER BY creation_date DESC LIMIT 0,$max_articles", $connectionid);
        while ($row = mysql_fetch_assoc($result2)) {
        		$sql = "SELECT * FROM sil_user WHERE ( user = '".$row[autor]."' )";	 
$result = mysql_query ($sql, $connectionid); 
$data_profile = mysql_fetch_array ($result);
				include($conf[System][path]."includes/templates/".$conf[Page][design]."/articles_article_list.php");
            }
			?><?php echo get_lang("general_page"); ?> <?
        for($i = 1;$i<($page_num +1);$i++)
            {
                echo "<a href='index.php?page=".$i."'>".$i."</a>&nbsp;";
            }
    }  
	if ($_GET['page'] >1)
    { 	
		 $start=($_GET['page']*$max_articles)-$max_articles; 
		 
		 // id, autor, title, content,tags,categories, creation_date
        $result2 = mysql_query("SELECT * FROM sil_blog_articles ORDER BY creation_date DESC LIMIT $start,$max_articles", $connectionid);
        while ($row = mysql_fetch_assoc($result2)) {
        	$sql = "SELECT * FROM sil_user WHERE ( user = '".$row[autor]."' )";	 
$result = mysql_query ($sql, $connectionid); 
$data_profile = mysql_fetch_array ($result);
				include($conf[System][path]."includes/templates/".$conf[Page][design]."articles_article_list.php");
            }
			?><?php echo get_lang("general_page"); ?> <?
        for($c = 1;$c<($page_num +1);$c++)
            {
                echo "<a href='index.php?page=".$c."'>".$c."</a>&nbsp;";
            }
    }  
?>
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