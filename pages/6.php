<?php
	define('NOSTARTBODY', true);
  require_once('../genclude.php');
?>
  <script>
    function searchMe(){
      alert("alert teaser");
      var searchcontainer = document.getElementById("searchcontainer");
      var enginesel = document.getElementById("engine");
      searchcontainer.src = enginesel.options[enginesel.selectedIndex].value;
    }
  </script>  
<?php html_body();  ?>
    <center>
      <form method="POST" name="systemform">
        <table>
          <tr>
            <td>Input:<td>
            <td><input id="term" name="term" type="text" size="20"/><td>
          <tr>
          <tr>
            <td>Select One:<td>
            <td>
              <select name="engine" id="engine" onchange="searchMe();">
                <option value ="http://www.google.com">google</option>
                <option value ="http://www.live.com">live</option>
                <option value ="http://www.yahoo.com">yahoo</option>
                <option value ="<?php echo $_SESSION['baseaddr']; ?>innerpages/<?php tc('6_14b3c'); ?>.php">ours</option>
              </select>
            <td>
          <tr>
        </table>
      </form>
      <iframe id="searchcontainer" width="600px" height="300px"/>
    <center>

