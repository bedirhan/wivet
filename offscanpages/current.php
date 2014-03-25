<?php
	require_once('../genclude.php');

	if(empty($_SESSION['scan']['pageVisits'])) {
		saveScan($_SESSION['scan']);
	}
	$_GET['id'] = $_SESSION['scan']['record'];
	$showbacklink = false;
	include('statistics.php');
	exit;
?>
