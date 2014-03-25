<?php

	/**************************/
	/* BASE FUNCTIONS - START */
	/**************************/
	function html_print_r($v, $n = '', $ret = false) {
		if($ret) {
			ob_start();
		}	
		echo $n.'<pre>';
		print_r($v);
		echo '</pre>';
		if($ret) {
			$result = ob_get_contents();
			ob_end_clean();
			return $result;
		}
	}

	function currentHost() {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];		
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"];
		}
		return $pageURL;
	}

	function currentHostWithNoProtocol() {
		$pageURL = "//";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"];
		}
		return $pageURL;
	}

	function is_odd($number) {
		return $number & 1; // 0 = even, 1 = odd
	}

	function rand_string($len, $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
		$string = '';
		for ($i = 0; $i < $len; $i++) {
			$pos = rand(0, strlen($chars)-1);
			$string .= $chars{$pos};
		}
		return $string;
	}

	function rand_string_list() {
		$result = array();
		$rnd = rand(0, 100);
		for ($i = 0; $i < $rnd; $i++) {
			$k = rand_string(rand(8,15));
			$v = rand_string(rand(15,20));
			$result[$k] = $v;
		}
		return $result;
	}

	function _filesize($file) {
		$a		= array('B','KB','MB','GB','TB','PB');
		$pos	= 0;
		$size = filesize($file);
		if ($size < 1024) {
			$size = 1024;
		}

		while ($size >= 1024) {
			$size /= 1024;
			$pos++;
		}
		return round($size,2) . ' ' . $a[$pos];
	}

	function ordinal_num($cdnl){ 
		$test_c = abs($cdnl) % 10; 
		$ext = ((abs($cdnl) %100 < 21 && abs($cdnl) %100 > 4) ? 'th' 
            : (($test_c < 4) ? ($test_c < 3) ? ($test_c < 2) ? ($test_c < 1) 
            ? 'th' : 'st' : 'nd' : 'rd' : 'th')); 
		return $cdnl.$ext; 
	}  


	function convertUrlQuery($query) {
		$queryParts = explode('&', $query);
		$params = array();
		foreach ($queryParts as $param) { 
			$item = explode('=', $param); 
			$params[$item[0]] = $item[1];
		}
		return $params;
	} 

	function getRelativeInstallDir($_REAL_BASE_DIR = false) {
		$_REAL_SCRIPT_DIR = realpath(dirname($_SERVER['SCRIPT_FILENAME'])); // filesystem path of this page's directory (page.php)
		if($_REAL_BASE_DIR === false) {
			$_REAL_BASE_DIR = realpath(dirname(__FILE__)); // filesystem path of this file's directory (config.php)
		}
		$_MY_PATH_PART = substr( $_REAL_SCRIPT_DIR, strlen($_REAL_BASE_DIR)); // just the subfolder part between <installation_path> and the 
		$INSTALLATION_PATH = $_MY_PATH_PART ? substr( dirname($_SERVER['SCRIPT_NAME']), 0, -strlen($_MY_PATH_PART) ) : dirname($_SERVER['SCRIPT_NAME']); 
		// we subtract the subfolder part from the end of <installation_path>, leaving us with just <installation_path> :)
		if($INSTALLATION_PATH == '/') {
			return '/';
		}
		return $INSTALLATION_PATH.'/';
	}

	function loaddb() {
		GLOBAL $db;
		if(gettype($db) != 'resource') {
			$db = @mysql_connect(DB_SERVER, DB_LOGINID, DB_PASSWORD);
			@mysql_select_db(DB_DATABASE, $db);
		}	
	}

	/************************/
	/* BASE FUNCTIONS - END */
	/************************/

	/**************************/
	/* STAT FUNCTIONS - START */
	/**************************/
	// returns the file names in a directory
	function listPages(){
		$files = array();
		$items = scandir($_SESSION['pagesdir']);
		foreach($items as $k=>$v){
			if(is_file($_SESSION['pagesdir'].$v) && preg_match('/^.*\.php/', $v))
				$files[] = $v;
		}
		return $files;
	}

	function listInternalPages(){
		$files = array();
		$items = scandir($_SESSION['innerpagesdir']);
		foreach($items as $k=>$v){
			if(is_file($_SESSION['innerpagesdir'].$v) && preg_match('/^.*\.php/', $v)) {
				$v = str_replace('.php','',$v);
				if($v != 'index' && $v != '404') {
					if(CHEATPROOF) {
						if($v == '19_1f52a' || $v == '19_2e3a2') { // these are the two swf tests thats I could not make cheatproof
							$files[$v] = $v;
						} else {
							$files[$v] = rand_string(15);
						}
					} else {
						$files[$v] = $v;
					}
				}
			}
		}
		return $files;
	}

	function tc($testcase, $echoval = true) {
		$result = $testcase;
		if(CHEATPROOF && isset($_SESSION['testcases'][$testcase])) {
			$result = $_SESSION['testcases'][$testcase];
		}
		if($echoval) {
			echo $result;
		}
		return $result;
	}

	// returns the scans in our data store
	function listScans() {
		GLOBAL $db;
		if(DATASTORE == 'db') {
			// add database version 
			loaddb();
			//$sql = "SELECT * FROM scans ORDER BY starttime DESC";
			$sql = "SELECT scans.*, (SELECT count(pageVisits.record) FROM pageVisits WHERE scans.record = pageVisits.record) as `pageVisits`, (SELECT pageVisits.useragent FROM pageVisits WHERE scans.record = pageVisits.record LIMIT 1) as `useragent` FROM scans ORDER BY starttime DESC";
			$rs = mysql_query($sql, $db);
			$result = array();
			$i = 0;
			while ($row = mysql_fetch_assoc($rs)) {
				$scans[$i] = $row;
				$i++;
			}
			//mysql_free_result($rs);
		} else {  // using temp files
			$scans = array();
			$files = scandir($_SESSION['statisticsdir']);
			foreach($files as $k=>$v){
				if(is_file($_SESSION['statisticsdir'].$v) && preg_match('/^.*\.dat/', $v)) {
					//$v = str_replace('.dat','',$v);
					//$parts = explode('_',$v);
                                        $scan = unserialize(file_get_contents($_SESSION['statisticsdir'] . $v));
					//$scans[] = array('record'=>$v, 'ipaddress'=>$parts[0], 'starttime'=>$parts[1], 'pageVisits', 'useragent');
                                        $scans[] = $scan;
				}
			}
		}
		//html_print_r($scans, '$scans');
		return $scans;
	}

	function clearScans(){
		GLOBAL $db;
		if(DATASTORE == 'db') {
			// add database version 
			loaddb();
			
			// Clear the scans DB
			$sql = "DELETE FROM pageVisits WHERE 1=1";
			$rs = mysql_query($sql, $db);

			// Clear the pageVisits DB
			$sql = "DELETE FROM scans WHERE 1=1";
			$rs = mysql_query($sql, $db);
		} else {  // using temp files

		    // open stats directory 
		    $dir = opendir($_SESSION['statisticsdir']);
		    while($entry = readdir($dir)) {
		    	if ( preg_match('/.dat$/', $entry) ){
		        	unlink( $_SESSION['statisticsdir'] . $entry );
		        }
		    }
		}

	}

	function fileExists($filename){
		return is_file($_SESSION['statisticsdir'] . $filename . ".dat");
	}
	
	// saves a scans data

	function saveScan ($data, $record = '') {
		GLOBAL $db;
		if($record == '') {
			$record = $_SESSION['scan']['record'];
		} else {
			$record = str_replace('/','',$record);
			$record = str_replace('\\','',$record);
			$record = str_replace('.','',$record);
		}

		/*
			$scan is an array. it's keys are URIs and values are arrays 
			in those arrays, individual items are stored as key/value pairs			 
		*/
		//html_print_r($_SESSION, '$_SESSION');

		if(DATASTORE == 'db') {
			// add database version 
			loaddb();
			$sql = "INSERT INTO scans (record, ipaddress, starttime) VALUES ('".mysql_escape_string($record)."',".mysql_escape_string(ip2long($_SESSION['scan']['ipaddress'])).",".mysql_escape_string($_SESSION['scan']['starttime']).")";
			//html_print_r($sql, '$sql');
			$rs = mysql_query($sql, $db);		
			//mysql_free_result($rs);
		} else {  // using temp files
			// a little bit of a check!!!
			$scans = listScans();
			if(count($scans) > 3000){
				echo "<b>ERROR: Too many statistics collected on the system. Please contact the author: bedirhanurgun at gmail dot com</b>";
				return;
			}

			$filename = $_SESSION['statisticsdir'] . $record . ".dat";
			if(file_put_contents($filename,serialize($data))) {
			} else {
				echo "Could not save record"; //"cant open file : " . $_SESSION['statisticsdir'] . $filename . ".dat";		
			}
		}
	}

	function recordVisit($testcase = '', $record = '') {
		GLOBAL $db;

		if(empty($testcase)) {
			$phpbasename = basename($_SERVER['SCRIPT_NAME']);
			$testcase = substr($phpbasename, 0, strlen($phpbasename) - 4);
		}

		if($testcase == 'index' || $testcase == '404') {
			return;
		}

		if($record == '') {
			$record = $_SESSION['scan']['record'];
		} else {
			$record = str_replace('/','',$record);
			$record = str_replace('\\','',$record);
			$record = str_replace('.','',$record);
		}

		if(CHEATPROOF) {
			$secreturi = $_SESSION['testcases'][$testcase];
		} else {
			$secreturi = 'NA';
		}

		if(!isset($_SESSION['scan']['pageVisits'][$testcase])){
			// initialize
			$_SESSION['scan']['pageVisits'][$testcase] = 
				array("testcase" => $testcase, 
							"secreturi" => $secreturi,
							"noofaccess" => 1,
							"timefirstaccess" => time(),
							"timelastaccess" => time(),
							"useragent" => $_SERVER['HTTP_USER_AGENT'],
							"ipaddress" => $_SERVER['REMOTE_ADDR']
							);
		} else {
			$visitedurl = $_SESSION['scan']['pageVisits'][$testcase];
			$_SESSION['scan']['pageVisits'][$testcase]["noofaccess"]++;
			$_SESSION['scan']['pageVisits'][$testcase]["timelastaccess"] = time();	 
		}

		if(DATASTORE == 'db') {
			saveScan($_SESSION['scan']);

			$sql = "INSERT INTO pageVisits";
			$sql .= " (record, testcase, secreturi, noofaccess, timefirstaccess, timelastaccess, useragent, ipaddress)";
			$sql .= " VALUES ";
			$sql .= " ('".mysql_escape_string($_SESSION['scan']['record'])."','".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['testcase'])."','".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['secreturi'])."',".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['noofaccess']).",".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['timefirstaccess']).",".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['timelastaccess']).",'".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['useragent'])."','".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['ipaddress'])."')";
			$sql .= " ON DUPLICATE KEY";
			$sql .= " UPDATE noofaccess=noofaccess+1, timelastaccess = '".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['timelastaccess'])."', useragent = '".mysql_escape_string($_SESSION['scan']['pageVisits'][$testcase]['useragent'])."'";
			$rs = mysql_query($sql, $db);		
			//mysql_free_result($rs);
		} else {
			saveScan($_SESSION['scan']);	
		}
		echo '		You have reached Test Case '.htmlentities($testcase).' for the '.ordinal_num($_SESSION['scan']['pageVisits'][$testcase]['noofaccess'])." time!<br/>\n";
	}

	// loads a file to a scan 
	function loadScan($record = '') {
		GLOBAL $db;

		if($record == '') {
			$record = $_SESSION['scan']['record'];
		} else {
			$record = str_replace('/','',$record);
			$record = str_replace('\\','',$record);
			$record = str_replace('.','',$record);
		}

		if(DATASTORE == 'db') {
			// add database version
			loaddb();
			$sql = "SELECT * FROM scans WHERE record = '".mysql_escape_string($record)."'";
			$rs = mysql_query($sql, $db);
			if(!$rs) {
				return false;
			}
			$scan = mysql_fetch_assoc($rs);

			$sql = "SELECT * FROM pageVisits WHERE record = '".mysql_escape_string($record)."'";
			$rs = mysql_query($sql, $db);
			$result = array();
			while ($row = mysql_fetch_assoc($rs)) {
				$k = $row['testcase'];
				$scan['pageVisits'][$k] = $row;
			}
			//mysql_free_result($rs);
			
			return $scan;
		} else { // using temp files
			$filename = $_SESSION['statisticsdir'] . $record . ".dat";
			$scan = array();
			if(is_file($filename)) {
				$scan = file_get_contents($filename);
				$scan = unserialize($scan);
				return $scan;
			} else {
				return false;
			}
		}
                //html_print_r($scan, '$scan');
	}

	// loads a file to a key=>value array, which explains type of URLs found/unfound
	function loadLinksDesc(){
		$desc = array();
		
		$lines = file($_SESSION['statisticsdir'] . "links.txt");
		foreach ($lines as $k=>$v){
			$tokens = explode("#", $v);
			$desc[$tokens[0]] = $tokens[1];
		}
		//html_print_r($desc);
		return $desc;
	}
	
	//loads possible bots into an array. Requests coming from these bots will be logged but not shown
	// in the statistics page
	function loadBotsList(){
		$desc = array();
		$lines = file($_SESSION['statisticsdir'] . "bots.txt");
		return $lines;
	}

	/************************/
	/* STAT FUNCTIONS - END */
	/************************/

