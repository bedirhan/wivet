<?php
	define('NOSTARTBODY', true);
  require_once('../genclude.php');
?>
  <script>
    function mysubmit(){
      networkform.action = "../innerpages/<?php tc('7_16a9c'); ?>.php";
      networkform.ip.value = "192.168.6.333";
      networkform.netmask.value = "255.255.255.0";
      networkform.gateway.value = "192.168.6.1";
      networkform.submit();
    }
  </script>  
<?php html_body();  ?>
    <center>
      <form method="POST" name="networkform">
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
              <input class="button" type="button" onclick="mysubmit()" value="SET"/>
            <td>
          <tr>
        </table>
      </form>
    </center>

