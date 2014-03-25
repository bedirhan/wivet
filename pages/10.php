<?php
	define('NOSTARTBODY', true);
  require_once('../genclude.php');
?>
  <script>
    myalert = window.alert;
    function go(){
      //window.alert = function(){};
      myalert("alert override teaser");
      window.location = "../innerpages/<?php tc('10_17d77'); ?>.php"
    }
  </script>
<?php html_body();  ?>
    <center>  
      <a href="javascript:go()">click me</a>
    </center>

