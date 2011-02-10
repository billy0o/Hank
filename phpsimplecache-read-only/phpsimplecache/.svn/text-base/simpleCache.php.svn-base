<?php
// Base directory of the site from the server root
if(!defined('ABSPATH')) { 			define('ABSPATH', str_replace('/Site_Common', '', dirname(__FILE__)).'/'); }
if(!defined('LOAD_CACHE')) { 		define('LOAD_CACHE', true); }
if(!defined('CACHE_PATH')) { 		define('CACHE_PATH', ABSPATH.'Cache/'); }
if(!defined('CACHE_TIME_OUT')) { 	define('CACHE_TIME_OUT', 3600); } // Lifetime of cache in seconds (3600 = 60 minutes)

if (LOAD_CACHE) { // Load cached page unless cache bypass is requested
	if ($_GET['Cache_Bypass'] != 'Yes' && $Bypass_Cache_Var == 'Yes') {
		echo '<!-- Cache bypassed -->';
	}
}

/*
***********************************************
There should be no need to edit below this line
***********************************************
*/

if ($_GET['Cache_Bypass'] != 'Yes' && $Bypass_Cache == '') {
	function getUrl() {
		// Returns the current URL of the script file being processed
		$URL_Var = '';
		if (array_key_exists('HTTPS',$_POST)) {
			if (@$_SERVER['HTTPS'] != '') {
				$URL_Var = 'https://';
			} else {
				$URL_Var = 'http://';
			}
		} else {
			$URL_Var = 'http://';
		}
		$URL_Var = $URL_Var . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		return $URL_Var;
	}

	$cacheFile = md5(getUrl()); // Cached file built based on URL

	if (file_exists(CACHE_PATH.$cacheFile) && (filemtime(CACHE_PATH.$cacheFile) > (time() - CACHE_TIME_OUT))) {
		$fileHandle = fopen(CACHE_PATH.$cacheFile, "r");
		$pageContents = fread($fileHandle, filesize(CACHE_PATH.$cacheFile));
		echo $pageContents;
		echo "<!-- Cached page served -->";
	} else {
		$currentUrl = getUrl();
		$dynamicUrl = strpos($currentUrl, '?');

		if ($dynamicUrl === false) {
			$requestedUrl = $currentUrl . '?Cache_Bypass=Yes';
		} else {
			$requestedUrl = $currentUrl . '&Cache_Bypass=Yes';
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $requestedUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$pageContents = curl_exec($ch);

		curl_close($ch);

		if (curl_errno($ch) == 0) {
			if (!$fileHandle = fopen(CACHE_PATH.$cacheFile, 'w')) {
				echo "<!-- Unable to create cache file -->";
				exit;
			}
			if (fwrite($fileHandle, $pageContents) === FALSE) {
				echo "<!-- Unable to write to cache file -->";
				exit;
			} else {
				echo "<!-- Cache created -->";
			}
			echo $pageContents;
			echo "<!-- Dynamic page served -->";
		} else {
			if (file_exists(CACHE_PATH.$cacheFile)) {
				$fileHandle = fopen(CACHE_PATH.$cacheFile, "r");
				$pageContents = fread($fileHandle, filesize(CACHE_PATH.$cacheFile));
				echo $pageContents;
				echo "<!-- Cached page served - unable to read dynamic version because server did not respond -->";
			} else {
				echo "<!-- Unable to request page and no cache exists. -->";
			}
		}
	}
	exit;
}
?>