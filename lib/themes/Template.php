<?php

namespace Theme;

class Template{
	//Clase para generar el template del aplicativo
	public static $theme = "default";
	
	public function __construct(){
		require(APP_PATH."config/config.php");
		if($config["THEME"]!=""){
			static::$theme = $config["THEME"];
		}else{
			static::$theme = "default";
		}
	}
	
	public static function navbar($navbar){
		$routeNavbar = PUBLIC_PATH."themes/".static::$theme."/navbar.php";
		require_once($routeNavbar);
	}
	
	public static function sidebar($sidebar){
		$routeSidebar = PUBLIC_PATH."themes/".static::$theme."/sidebar.php";
		require_once($routeSidebar);
	}
}
?>