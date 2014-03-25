<?php
	define('NOSTARTBODY', true);
  require_once('../genclude.php');
?>
  <script type="text/javascript" src="../js/jquery/jquery.js"></script>
  <script type="text/javascript" >
    $(document).ready(function(){
      $("#link").each(function(){this.href = "../innerpages/<?php tc('11_1f2e4'); ?>.php";});
    });
  </script>
<?php html_body();  ?>
    <center>
      <a id="link" href="" target="body">click me</a>
      <a href="javascript:window.open('../innerpages'+'/<?php tc('11_2d3ff'); ?>.php', 'windowopen', 'resizable=yes,width=500,height=400');">click me 2</a>
    </center>
