<?php
require_once("includes/Theme.php"); 
$theme = new Theme();

?>
<link href="css/<?php echo $theme->getActiveTheme();?>.css" type="text/css" rel="stylesheet">

<!-- Footer Content -->
 <div class="footer">
 <div class="designer"> Designed and Developed By: <a  href="http://www.chrimoska.co.ke" target="main">CHRIMOSKA LIMITED</a> P.O. Box 1990-00232, Ruiru. Email:&nbsp;&nbsp;<a href="mailto:info@chrimoska.co.ke">info@chrimoska.co.ke </a> </div>
 <div class="version">Mod: 5:02:2017</div>
 </div>
<!-- End Footer Content -->
