<?php
	ob_start();
	defined('BASEPATH') OR exit('No direct script access allowed');
	if ($_SERVER['SERVER_NAME'] == 'localhost') {
		$segment = explode('/', $_SERVER['REQUEST_URI']);
		$segment = $segment[1];
		$url = "http://" . $_SERVER['SERVER_NAME'] . '/' . $segment . '/404';
	}else{
		// GETTING ROOT FOLDER OF PROJECT
		$segment =  realpath('.');
		$segment = explode('/', $segment);
		$segment = end($segment);

		$url = "http://" . $_SERVER['SERVER_NAME'] . '/' . $segment . '/404';
	}

	header("Location: " . $url) or die('<script>location.replace("' . $url .'")</script>');		
	exit;
?>
