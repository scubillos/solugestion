<?php
	/***
	 Archivo de configuracion de frontend. Es decir JS, CSS que se deben ejecutar siempre al cargar un controlador
	 
	 - Utilizar {NombreDeLaInstanciaQueSeCarga} => {RutaDelArchivoParaCargarInstancia}
	 - Las rutas deben partir desde la carpeta principal del aplicativo
	**/
	
	$frontend = [];
	$frontend = [
		//JS
		"JS" => [
			"config" => "app/generals/frontend/AppCore/config.js",
			"functions" => "app/generals/frontend/AppCore/functions.js",
			"jquery" => "app/generals/frontend/jquery/jquery-3.2.1.min.js",
			"bootstrap" => "app/generals/frontend/bootstrap/js/bootstrap.min.js",
			"validate" => "app/generals/frontend/jquery.validate/jquery.validate.min.js",
			"lodash" => "app/generals/frontend/lodash/lodash.min.js",
			"toast" => "app/generals/frontend/toast/jquery.toast.min.js"
		],
		"CSS" => [
			"bootstrap" => "app/generals/frontend/bootstrap/css/bootstrap.min.css",
			"theme_default" => "public/themes/default/css/estilosp.css",
			"toast" => "app/generals/frontend/toast/jquery.toast.min.css"
		]
	];
	
?>