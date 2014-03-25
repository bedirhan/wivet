<?php
	if(file_exists(dirname(__FILE__).'/config.php')) {
		require_once('config.php');
	} else {
		require_once('config.sample.php');
	}
	require_once('functions.php');

	/**************************/
	/* HTML FUNCTIONS - START */
	/**************************/
	function html_header() {
		GLOBAL $url_relative, $html_title, $html_body_class;
		if(!defined('HTML_HEADER_DISPLAYED')) {
			define('HTML_HEADER_DISPLAYED', true);

			if(!isset($html_title)) { $html_title = ''; }
			if(!isset($html_body_class)) { $html_body_class = 'body'; }
		
			echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">'."\n";
			echo "<html>\n";
			echo "	<head>\n";
			echo '		<meta http-equiv="content-type" content="text/html; charset=windows-1250">'."\n";
			echo '		<link type="text/css" rel="stylesheet" href="'.$url_relative.'style.css" />'."\n";
			if(!empty($html_title)) {
				echo "		<title>$html_title</title>\n";
			}

			if(!defined('NOSTARTBODY')) {
				html_body();
			}
		}
	}

	function html_body() {
		GLOBAL $url_relative, $html_body_class;
		if(!defined('HTML_BODY_DISPLAYED')) {
			define('HTML_BODY_DISPLAYED', true);
			echo "	</head>\n";
			echo '	<body  class="'.$html_body_class.'">'."\n";
		}
	}
	
	function html_footer() {
		GLOBAL $db;
		if(gettype($db) == 'resource') {
			mysql_close($db);			
		}
		if(defined('HTML_HEADER_DISPLAYED')) {
			echo '	</body>'."\n";
			echo '</html>'."\n";
		}
	}

	/************************/
	/* HTML FUNCTIONS - END */
	/************************/

	/******************/
	/* Setup defaults */
	/******************/

	$url_relative = getRelativeInstallDir();

	if(!defined('DATASTORE')) {
		define('DATASTORE', 'file');
	}
	if(!defined('FILESTORE_PATH')) {
		define('FILESTORE_PATH', '/tmp/wivet/');
	}
	if(DATASTORE == 'file' && !is_dir(FILESTORE_PATH)) {
		mkdir(FILESTORE_PATH);
	}

	/**********************/
	/* Get things rolling */
	/**********************/
	
	register_shutdown_function('html_footer');
	
	if(empty($_SESSION)) { 
		session_start();
	}

	//loaddb();

	$_SESSION['baseaddr'] = currentHost() . $url_relative;
	$_SESSION['baseaddrwithnoprotocol'] = currentHostWithNoProtocol() . $url_relative;
	$_SESSION['statisticsdir'] = FILESTORE_PATH;
	$_SESSION['installdir'] = dirname(__FILE__) . "/";
	$_SESSION['pagesdir'] = $_SESSION['installdir'] . "pages/";
	$_SESSION['innerpagesdir'] = $_SESSION['installdir'] . "innerpages/";
        $_SESSION['offscanpagesdir'] = $_SESSION['installdir'] . "offscanpages/";

	if(!isset($_SESSION['time'])){
		$_SESSION['time'] = time();
	}

	if(!isset($_SESSION['testcases'])){
		$_SESSION['testcases'] = listInternalPages();
	}
	
//html_print_r($_SESSION['testcases'], '$_SESSION[testcases]');

	if(!isset($_SESSION['scan']['starttime'])){
		$_SESSION['scan']['starttime'] = time();
	}

	if(!isset($_SESSION['scan']['ipaddress'])){
		$_SESSION['scan']['ipaddress'] = $_SERVER['REMOTE_ADDR'];
	}

	if(!isset($_SESSION['scan']['record'])){
		$_SESSION['scan']['record'] = ip2long($_SESSION['scan']['ipaddress']).'_'.$_SESSION['scan']['starttime'];
	}

	if(!isset($_SESSION['scan']['pageVisits'])){
		$_SESSION['scan']['pageVisits'] = array();
	}

	if(!defined('NOSTARTHTML')) {
		html_header();
	}

	if(!isset($testcase)) {
		$testcase = '';
	}
