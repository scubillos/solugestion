<?php
	date_default_timezone_set('America/Bogota');

	include("app/config/config.php");

	define("URL_APP",$config["URL_APP"]);
	define("SYS_PATH","lib/");
	define("APP_PATH","app/");
	define("PUBLIC_PATH","public/");

	require_once(SYS_PATH."Index.php");
?>