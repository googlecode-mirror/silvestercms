 <?
 include_once($path."config.php");
 ?>
 </div>
           <div id="div_footer">
                    Powered by silvesterCMS <? echo $verstring; ?> / Copyright Marc A. Kastner 2009
            </div>
            
            

        </div>
           
<div id="ctl00_PanelContainer" class="ui-widget-content" style="height:189px;width:380px;">
    <div id="ctl00_PanelHeader" class="ui-widget-header" style="height:15px;">  
        <div style="float:left">Chat mit "Andere Person"</div>
        <? echo"<div id=\"divAjaxMini\" style=\"float:right; position:relative; top:2px;\"><img id=\"colimage_min\" src=\"".$url."includes/templates/Default/img/minimize.gif\" onclick=\"HideChat();\" /></div>"; ?>
        <? echo "<div id=\"divAjaxOpen\" style=\"float:right; position:relative; top:2px;\"><img id=\"colimage_open\" onclick=\"ShowChat();\" src=\"".$url."includes/templates/Default/img/open.gif\" /></div>"; ?>
    </div>
    <div id="ctl00_PanelBody" style="height:inherit;">
        <div  style="position:relative;">
            <div id="divAjaxMiddle" style="position:relative;height:inherit;">  
                <div style="float:left;"><textarea name="ctl00$TextBox2" rows="2" cols="20" id="ctl00_TextBox2" class="alsoresize" style="height:140px;width:290px;">
(19:13:42) Marc A. Kastner: Text1 
(19:13:45) Andere Person: Text2 
(19:13:49) Marc A. Kastner: Text3 
(19:13:53) Andere Person: Text4 
(19:13:59) Marc A. Kastner: Text5 
(19:14:04) Andere Person: Text6 
(19:15:42) Marc A. Kastner: Text7</textarea></div>
<div style="float:right;position:relative;right:5px; font-size:10px;">Marc A. Kastner<br />
    <img id="Image1" src="http://maku.ath.cx/silvesterCMS/includes/templates/Default/img/default_profile_normal.png" /><br /><br />Andere Person<br />
    <img id="Image2" src="http://maku.ath.cx/silvesterCMS/includes/templates/Default/img/default_profile_normal.png" />

</div>
                <br />
            </div>
            <div id="divAjaxFooter" style="position:relative;height:25px;">
                <input name="ctl00$TextBox1" type="text" id="ctl00_TextBox1" style="width:290px;" />
                <input type="submit" name="ctl00$Button1" value="Send" id="ctl00_Button1" style="height:20px;width:45px;" />
				<div class="handleContainer"></div>
                
            </div>
           
        </div>
    </div> 
</div>
</body>
</html>
