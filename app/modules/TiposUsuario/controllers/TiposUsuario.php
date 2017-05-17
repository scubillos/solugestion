<?php
use Base\Controller as Controller;

class TiposUsuario Extends Controller{
	public $titlePage = ".: Tipos de Usuario - Solugestion :."; //Para el titulo de la pagina
	
	public function __construct(){
		parent::__construct();
	}
	
	public function Index(){
		$this->LoadPluginJS("jqgrid");
		$this->AddJS('modules/TiposUsuario/assets/js/tabla.js');
		$data["breadcrumb"] = [
			"titulo" => "Tipos de Usuario",
			"ruta" => [
				[ "nombre" => "Tipos de usuario" ]
			],
			"opciones" => [
				"nombre" => "Crear",
				"url" => $this->UrlBase()."TiposUsuario/Crear"
			]
		];
		
		$this->RenderView("Index",$data);
	}
	
	public function Crear(){
		$data["breadcrumb"] = [
			"titulo" => "Crear tipos de usuario",
			"ruta" => [
				[ "nombre" => "Tipos de usuario", "url" => $this->UrlBase()."TiposUsuario" ],
				[ "nombre" => "Crear" ]
			],
			"opciones" => [
				"nombre" => "Crear",
				"url" => $this->UrlBase()."TiposUsuario/Crear"
			]
		];
		
		$this->RenderView("Crear",$data);
	}
	
	public function Info(){
		$this->AddJS('modules/Login/assets/js/prueba.js');
		
		$this->RenderView();
	}
	
}

?>