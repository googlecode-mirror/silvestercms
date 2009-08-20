<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title><? echo $title ?></title>
	
	<? echo "<link href=\"../includes/templates/Default/css/jquery-ui-1.7.2.custom.css\" rel=\"stylesheet\" type=\"text/css\" />"; ?>
	<? echo "<link href=\"../includes/templates/Default/css/Default.css\" rel=\"stylesheet\" type=\"text/css\" />"; ?>
		
    <? echo "<script src=\"../includes/js/jquery-1.3.2.min.js\" type=\"text/javascript\"></script>"; ?>
    <? echo "<script src=\"../includes/js/jquery-ui-1.7.2.custom.min.js\" type=\"text/javascript\"></script>"; ?>
</head>
<body>

 <div id="div_main">
        <div id="div_head">

                <div style="position:absolute; top: 63px; left: 370px; color: red; font-size:33px; text-shadow: 1px 1px 1px #000;">
                    adminCP
                </div>
                <div id="div_head_login" style="">
					Hello, <? echo $_SESSION["user_name"]." (".$_SESSION["user_role"].")"; ?>
				</div>
                 <? echo "<img id=\"Image1\" src=\"../includes/templates/Default/img/header.png\" />"; ?>

                <div id="div_head_menu_bar" style="left:70px;bottom:12px; width:700px;">
						<ul id="navlist">
							<li>
								<a href="index.php">adminCP Start</a>
							</li>
							
							<li>
								<a href="../index.php">Homepage</a>
							</li>
						</ul>
                </div>
            </div>
		<div style="position:relative; left:25px; width:910px;"><br><br>