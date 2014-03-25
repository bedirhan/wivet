<?php
	define('NOSTARTHTML', true);
	require_once('genclude.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <frameset rows = "60, *" framespacing="0" border="0" frameborder="0">
    <frame src ="header.php" name="header"/>
    <frameset id="fset" cols = "150, *" framespacing="0" border="0" frameborder="0">
      <frame src ="menu.php" name="menu"/>
      <frame src ="body.php" id="fbody" name="body"/>
    </frameset>
  </frameset>
</html>
