<?php
	define('NOSTARTBODY', true);
	$html_body_class = 'menu';
	require_once('genclude.php');
  
  $menuPages = listPages();
  sort($menuPages, SORT_NUMERIC);
?>
		<base href="<?php echo $_SESSION['baseaddr']; ?>pages/" target="body">
<?php html_body();  ?>
    <div class="menulinks">
      <?php
        
        foreach ($menuPages as $k=>$v){
          if(strcmp($v,"100.php") != 0)
            echo "<div class='menulink'><a href='".$v."'>".$v."</a></div>";
        }
      ?>      
      <div class="menulink">&nbsp;</div>
      <div class="menulink">&nbsp;</div>
      <div class="menulink"><a href="<?php echo $_SESSION['baseaddr']; ?>offscanpages/statistics.php" target="body">Statistics</a></div>
      <div class="menulink"><a href="<?php echo $_SESSION['baseaddr']; ?>offscanpages/current.php">Current Run</a></div>
      <div class="menulink"><a href="<?php echo $_SESSION['baseaddr']; ?>offscanpages/about.php">About</a></div>
			<div class="menulink"><a href="<?php echo $_SESSION['baseaddr']; ?>logout.php">Logout</a></div>
    </div>

