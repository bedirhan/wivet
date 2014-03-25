<?php
	define('NOSTARTBODY', true);
  require_once('../genclude.php');
?>
  <script>
    window.onload = function(){
      with(document){
        var dframe = createElement("frame");
        dframe.src = "../innerpages/<?php tc('12_2a2cf'); ?>.php";
        body.appendChild(dframe);

        var diframe = createElement("iframe");
        diframe.src = "../innerpages/<?php tc('12_3a2cf'); ?>.php";
        body.appendChild(diframe);
      }
    }
  </script>
<?php html_body();  ?>
    <iframe src="../innerpages/<?php tc('12_1a2cf'); ?>.php"></iframe>

