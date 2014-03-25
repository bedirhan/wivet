<?php
    // starting output buffering in order to avoid; Headers sent before ... warning
    ob_start();
		define('NOSTARTHTML', true);
    require_once('../genclude.php');
    function redirect($url, $hiddenUrl)
    {
        header("Location: $url");
				html_header();
        echo 'This page has moved to <a href="'.$hiddenUrl.'">HERE :)</a>';
        exit();
    }

    redirect('../innerpages/'.tc('16_1b14f').'.php', '../innerpages/'.tc('16_2f41a').'.php');
    ob_end_flush();
?>
