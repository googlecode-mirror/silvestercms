<? 
session_start (); 
include_once($path."includes/header_functions.php");
sil_maintenance();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title><? echo $title ?></title>
	
	<? echo "<link href=\"".$conf[System][url]."includes/templates/Default/css/jquery-ui-1.7.2.custom.css\" rel=\"stylesheet\" type=\"text/css\" />"; ?>
	<? echo "<link href=\"".$conf[System][url]."includes/templates/Default/css/Default.css\" rel=\"stylesheet\" type=\"text/css\" />"; ?>
		
    <? echo "<script src=\"".$conf[System][url]."includes/js/jquery-1.3.2.min.js\" type=\"text/javascript\"></script>"; ?>
    <? echo "<script src=\"".$conf[System][url]."includes/js/jquery-ui-1.7.2.custom.min.js\" type=\"text/javascript\"></script>"; ?>

	<script type="text/javascript">
        $(document).ready(function() {
            //$("#ctl00_PanelContainer").draggable({ handle: '#ctl00_PanelHeader' });
            //$("#ctl00_PanelContainer").resizable({
            //minHeight: 189,
            //minWidth: 380,
            //alsoResize: '.alsoresize',
			//});
        $("#divAjaxOpen").hide();
		$("#ctl00_PanelContainer").hide();//visibility:hidden;
        Init();
		
		
		$('.hover').hover(function() { $(this).addClass('hover').fadeIn(); }, function() { $(this).removeClass('hover').fadeOut(); }); 
    });

        function Init() {
            var left = window.innerWidth - 390;
            var top = window.innerHeight - 25;
            $("#divAjaxMini").hide();
            $("#ctl00_PanelBody").hide();
            $("#divAjaxOpen").show();
            $("#ctl00_PanelContainer").css('position', 'fixed');
            $("#ctl00_PanelContainer").css('left', left);
            $("#ctl00_PanelContainer").css('top', top);
            $("#ctl00_PanelContainer").draggable('disable');
        }
        
        function HideChat() {
                 $("#divAjaxMini").hide();
                 $("#ctl00_PanelBody").hide();
                 $("#divAjaxOpen").show();

                 var left = window.innerWidth - 390;
                 var top = window.innerHeight - 25;
                 $("#ctl00_PanelContainer").css('position', 'fixed');
                 $("#ctl00_PanelContainer").animate({
                     left: left + "px",
                     top: top + "px"
                 }, 1000);
                 $("#ctl00_PanelContainer").draggable('disable');
                 $("#ctl00_PanelContainer").css('width','380px');
                 $("#ctl00_TextBox2").css('width','290px');
             }
		function ShowChat() {
			 $("#ctl00_PanelBody").show();
			 $("#divAjaxOpen").hide();
			 $("#divAjaxMini").show();

			 var left = window.innerWidth - 390;
			 var top = 125;
			 $("#ctl00_PanelContainer").animate({
				 left: left + "px",
				 top: top + "px"
			 }, 1000);
			 $("#ctl00_PanelContainer").draggable('enable');
		}
      </script> 
</head>
<body>

 <div id="div_main">
        <div id="div_head">

                <div id="div_head_pagename">
                    <? echo $conf[Page][pagename]; ?>
                </div>
                <div id="div_head_descr">
                    <? echo $conf[Page][pagedescr]; ?>
                </div>
                <div id="div_head_login" style="">
					<? sil_head_login(); ?>
				</div>
                <div id="div_head_lang_bar">
					<? sil_head_lang(); ?>
                </div>
                 <? echo "<img id=\"Image1\" src=\"".$conf[System][url]."includes/templates/Default/img/header.png\" />"; ?>
                
                <div id="div_head_menu_bar" style="left:30px;bottom:12px; width:700px;">
					<? sil_head_nav(); ?>
                </div>

                <div id="div_head_menu_bar" style="left:710px;width:300px;bottom:12px;">
                    <? sil_head_nav_logged(); ?>
                </div>
            </div>
		<div style="position:relative; left:25px; width:910px;"><br /><br />