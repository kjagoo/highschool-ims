<?php
include('dbconnector.php');
class Theme{

function Theme() {
}
   

 function getActiveTheme(){
 $theme="style_blue";
 $resultg = mysql_query("select css_name from tbl_themes where theme_status='1'");
	while ($rowg= mysql_fetch_array($resultg)) {
		$theme = $rowg['css_name'];
	}
	return   $theme;
 }
function getActiveThemeSmall(){
 $theme="styleblue";
 $resultg = mysql_query("select css_m from tbl_themes where theme_status='1'");
	while ($rowg= mysql_fetch_array($resultg)) {
		$theme = $rowg['css_m'];
	}
	return   $theme;
 }



 
 //end of class Grading
}
?>
