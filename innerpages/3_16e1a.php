<?php
	require_once("../genclude.php");
  $_SESSION['whereami'] = 1;
?>
    <center>
      <form method="POST" name="aform" action="<?php tc('3_2cc42'); ?>.php">
        <table>
          <tr>
            <td>IP:<td>
            <td><input id="ip" name="ip" type="text" size="20"/><td>
          <tr>
          <tr>
            <td>Netmask:<td>
            <td><input id="netmask" name="netmask" type="text" size="20"/><td>
          <tr>
          <tr>
            <td>Gateway:<td>
            <td><input id="gateway" name="gateway" type="text" size="20"/><td>
          <tr>
          <tr>
            <td style="text-align:center">
              <input class="button" type="submit" value="CONTINUE"/>
            <td>
          <tr>
        </table>
      </form>
      <a href="<?php tc('3_7e215'); ?>.php">need help? :)</a>
    </center>

