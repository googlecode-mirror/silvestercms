<div style="float:left;width:580px;">
	<div style="background-color:#F9F9F9;">
		<div style="position:relative;width:560px;left:10px;"><br>
			<span style="font-size:25px;"><? echo $data["title"]; ?></span><br>
			<span style="font-size:10px;"><?php echo get_lang("general_by"); ?> <a href=profile.php?id=<? echo $data_profile[id]; ?>><? echo $data["autor"]; ?></a> <?php echo get_lang("general_on"); ?> <? echo $data["creation_date"]; ?></span><br>
			<br>
			<? echo $data["content"]; ?>
			<br><br>
			<div style="position:relative;width:540px;background-color:#EEE;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border: 0px solid #000;
			padding: 5px;">
			<div style="float:left;left:5px;top:7px;position:relative;">
				<?php echo get_lang("blog_cate"); ?>: <a href=index.php?category=<? echo $data["categories"]; ?>><? echo $data["categories"]; ?></a><br>
				<?php echo get_lang("blog_tags"); ?>: <a href=index.php?tag=<? echo $data["tags"]; ?>><? echo $data["tags"]; ?></a><br><br>
			</div>
			<div style="float:right;top:13px;position:relative;right:15px;">
				<img class="sociable-hovers" src="includes/templates/Default/img/delicious11.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/digg11.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/facebook11.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/flickr11.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/friendfeed3.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/linkedin1.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/myspace3.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/reddit13.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/stumbleupon11.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/technorati11.png" style="width:20px; height:20px;"> 
				<img class="sociable-hovers" src="includes/templates/Default/img/twitter11.png" style="width:20px; height:20px;"> 
			</div>
			<div style="clear:both;"></div>
			</div><br>
		</div>
	</div><br>
	
<div style="background-color:#F9F9F9;">
		<div style="position:relative;width:560px;left:10px;"><br>
			<hr>
			<span style="font-size:18px;"><?php echo get_lang("blog_comments"); ?></span><hr>
		</div>
	</div>	