	<div style="background-color:#F9F9F9;">
		<div style="position:relative;width:560px;left:10px;">
			<div style="float:left;width:55px;"><br />
			<img src="<?php 
if($data["profile_avatar"] !="") { 
	echo $data["profile_avatar"]; 
} else { 
	echo $conf[System][url]."/includes/templates/Default/img/default_profile_normal.png"; 
} ?>" width=50 height=50 />
			</div>
			<div style="float:right;width:495px;"><br />
				<span style="font-size:18px;"><? echo $row["title"]; ?></span><br>
				<span style="font-size:10px;"><?php echo get_lang("general_by"); ?> <a href=profile.php?id=<? echo $data[id]; ?>><? echo $data[user]; ?></a> <?php echo get_lang("general_on"); ?> <? echo $row["creation_date"]; ?></span><br>
				<br>
				<? echo $row["content"]; ?>
			</div>
			<div style="clear:both;"></div>
		</div><br>
	</div>