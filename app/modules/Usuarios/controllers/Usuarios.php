<?php
use Base\Controller as Controller;

class Usuarios Extends Controller{
	public $titlePage = ".: Usuarios - Solugestion :."; //Para el titulo de la pagina
	
	public function __construct(){
		parent::__construct();
	}
	
	public function Index(){
		$this->LoadPluginJS("jqgrid");
		$this->AddJS('modules/Usuarios/assets/js/tabla.js');
		$data["breadcrumb"] = [
			"titulo" => "Usuarios",
			"ruta" => [
				[ "nombre" => "Lista de Usuarios" ]
			],
			"opciones" => [
				"nombre" => "Crear",
				"url" => $this->UrlBase()."Usuarios/Crear"
			]
		];
		
		$this->RenderView("Index",$data);
	}
	
	public function Crear(){
		$this->AddJS('modules/Usuarios/assets/js/crear.js');
		$data["breadcrumb"] = [
			"titulo" => "Crear usuario",
			"ruta" => [
				[ "nombre" => "Lista de usuario", "url" => $this->UrlBase()."Usuarios" ],
				[ "nombre" => "Crear" ]
			],
			"opciones" => [
				"nombre" => "Crear",
				"url" => $this->UrlBase()."Usuarios/Crear"
			]
		];
		
		$this->RenderView("Crear",$data);
	}
	
	public function Guardar(){
		$this->AddJS('modules/Login/assets/js/prueba.js');
		
		$this->RenderView();
	}
	
}

?>