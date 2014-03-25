<?php
	define('NOSTARTBODY', true);
  require_once('../genclude.php');
?>
  <script>
    function openUserSetting(){
      window.open('../innerpages/<?php tc('4_1c3f8'); ?>.php', '8', 'resizable=yes,width=400,height=50');
    }
  </script>
<?php html_body();  ?>
    <center>
    <p> 
      <a href="javascript:openUserSetting()">click me</a> 
    </p>
    <center>

