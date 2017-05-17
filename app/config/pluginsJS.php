<?php
	/***
	 Archivo de configuracion de plugins JS.
	 
	 - Utilizar {NombreDeLaInstanciaQueSeCarga} => {RutaDelArchivoParaCargarInstancia}
	 - Las rutas deben partir desde la carpeta principal del aplicativo
	**/
	
	$pluginsJS = [];
	$pluginsJS = [
		"jqgrid" => [
			"JS" => [
				"app/generals/plugins/jqGrid/js/jquery.jqGrid.min.js"
			],
			"CSS" => [
				"app/generals/plugins/jqGrid/css/ui.jqgrid-bootstrap.css"
			],
			"Template" => [
				"default" => "templates/js/jqgrid/template.php"
			]
		]
	];
	
?>