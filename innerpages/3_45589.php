<?php
	require_once("../genclude.php");
	if(isset($_SESSION['whereami']) && $_SESSION['whereami'] == 3) {
		recordVisit($testcase);
	}
?>
    <center>
        The journey ends here, if followed the right path!
    </center>

