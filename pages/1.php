<?php
	define('NOSTARTBODY', true);
  require_once('../genclude.php');
?>
  <script>
    window.onload = function(){
      // what what      
      setTimeout(showLink, 3000);
    }
    function showLink(){
        var container = document.getElementById("container");
        var alink = document.createElement("a");
				alink.href = "../innerpages/<?php tc('1_12c3b'); ?>.php";
        alink.innerHTML = "click me";
        container.appendChild(alink);
    }
    function showLink2(){
        var container = document.getElementById("container");
        var alink = document.createElement("a");
        alink.href = "../innerpages/<?php tc('1_25e2a'); ?>.php";
        alink.innerHTML = "click me 2";
        container.appendChild(alink);
    }
  </script>
<?php html_body();  ?>
    <div id="container">
    </div>    
    <input type="button" onclick="showLink2()" value="click me"/>

