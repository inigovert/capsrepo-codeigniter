<?php
ob_start();
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');
session_start();

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
$db = new DBConnection;
$conn = $db->conn;

/**
 * Redirect to the specified URL.
 */
function redirect($url='') {
	if (!empty($url)) {
		echo '<script>location.href="'.base_url.$url.'"</script>';
	}
}

/**
 * Validate the image path and return the full URL.
 */
function validate_image($file) {
	if (!empty($file)) {
		$ex = explode('?', $file);
		$file = $ex[0];
		$param = isset($ex[1]) ? '?'.$ex[1] : '';
		if (is_file(base_app.$file)) {
			return base_url.$file.$param;
		} else {
			return base_url.'dist/img/no-image-available.png';
		}
	} else {
		return base_url.'dist/img/no-image-available.png';
	}
}

/**
 * Validate the video path and return the full URL.
 */
function validate_video($file) {
	if (!empty($file)) {
		$ex = explode('?', $file);
		$file = $ex[0];
		$param = isset($ex[1]) ? '?'.$ex[1] : '';
		if (is_file(base_app.$file)) {
			return base_url.$file.$param;
		} else {
			return base_url.'uploads/videos/default.mp4'; // Replace with your default video path
		}
	} else {
		return base_url.'uploads/videos/default.mp4'; // Replace with your default video path
	}
}

/**
 * Check if the user is accessing the site from a mobile device.
 */
function isMobileDevice() {
	$aMobileUA = array(
		'/iphone/i' => 'iPhone',
		'/ipod/i' => 'iPod',
		'/ipad/i' => 'iPad',
		'/android/i' => 'Android',
		'/blackberry/i' => 'BlackBerry',
		'/webos/i' => 'Mobile'
	);

	// Return true if Mobile User Agent is detected
	foreach ($aMobileUA as $sMobileKey => $sMobileOS) {
		if (preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])) {
			return true;
		}
	}
	// Otherwise, return false
	return false;
}

ob_end_flush();
?>
