<h1>Log</h1><br />
This is log and debug file of silvesterCMS. The file is also available at
silv.log in your silvesterCMS root folder.<br /><br />
<?php
$userdatei = fopen("../silv.log","r");
while(!feof($userdatei))
   {
   $zeile = fgets($userdatei,5000)."<br />";
   echo $zeile;
   }
fclose($userdatei);
?>