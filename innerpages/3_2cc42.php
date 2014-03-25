<?php
	require_once("../genclude.php");
	if(isset($_SESSION['whereami']) && $_SESSION['whereami'] == 1) {
		$_SESSION['whereami'] = 2;
	}
?>
    <center>
      <form method="POST" name="aform" action="<?php tc('3_3fadc'); ?>.php">
        <table>
          <tr>
            <td>Hostname:<td>
            <td><input id="hn" name="hn" type="text" size="20"/><td>
          <tr>
          <tr>
            <td>DNS:<td>
            <td><input id="dns" name="dns" type="text" size="20"/><td>
          <tr>
          <tr>
            <td>Alternate DNS:<td>
            <td><input id="dns2" name="dns2" type="text" size="20"/><td>
          <tr>
          <tr>
            <td style="text-align:center">
              <input class="button" type="submit" value="CONTINUE"/>
            <td>
          <tr>
        </table>
      </form>
      <a href="<?php tc('3_16e1a'); ?>.php">start again</a>
      <br/>
      <a href="<?php tc('3_5befd'); ?>.php">need some more help? :)</a>
    </center>
