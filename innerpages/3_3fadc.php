<?php
	require_once("../genclude.php");
	if(isset($_SESSION['whereami']) && $_SESSION['whereami'] == 2) {
		$_SESSION['whereami'] = 3;
	}
?>
    <center>
      <form method="POST" name="aform" action="<?php tc('3_45589'); ?>.php">
        <table>
          <tr>
            <td>Name:<td>
            <td><input id="name" name="name" type="text" size="20"/><td>
          <tr>
          <tr>
            <td>Surname:<td>
            <td><input id="surname" name="surname" type="text" size="20"/><td>
          <tr>
          <tr>
            <td>Email:<td>
            <td><input id="email" name="email" type="text" size="20"/><td>
          <tr>
          <tr>
            <td style="text-align:center">
              <input class="button" type="submit" value="FINISH"/>
            <td>
          <tr>
        </table>
      </form>
      <a href="<?php tc('3_2cc42'); ?>.php">go back</a>
      <br/>
      <a href="<?php tc('3_6ff22'); ?>.php">main page :)</a>
    </center>

