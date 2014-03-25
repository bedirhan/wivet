<?php

  if ( strcmp($_GET['sure'], 'yes') == 0 ){
    // Remove all previous stats from wivet. Useful for unittest integration with various scanners.
    require_once('../genclude.php');
    
    clearScans();    
    echo 'Done!';
  }

?>