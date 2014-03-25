<?php
	define('NOSTARTBODY', true);
  require_once('../genclude.php');
?>
  <script>
    function openSoftwareInfo(){
      window.open('../innerpages/<?php tc('5_1e4d2'); ?>.php', 'usersetting', 'resizable=yes,width=400,height=50');
    }
  </script>  
<?php html_body();  ?>
    <center>
    <div onmouseover="openSoftwareInfo()">  
       Over Me
    </div>
    <center>
