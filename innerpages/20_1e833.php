<?php
	require_once("../genclude.php");
	if(isset($_GET['param2']) && $_GET['param2'] == '2') {
		recordVisit($testcase);
		echo 'you got it';
	} else {
		echo '<a href="../pages/20.php">again!</a>';
	}
?>
