<?php
use Base\Controller as Controller;

class Permisos Extends Controller{
	public $titlePage = ".: Administrar permisos - Solugestion :."; //Para el titulo de la pagina
	
	public $Permisos;
	
	public function __construct(){
		parent::__construct();
		$this->Permisos = $this->LoadModel("Permisos");
	}
	
	public function Editar($tipoUser = ""){
		
		$this->AddJS('modules/Permisos/assets/js/editar.js');
		$this->AddCSS('modules/Permisos/assets/css/editar.css');
		$data["breadcrumb"] = [
			"titulo" => "Permisos de usuarios",
			"ruta" => [
				[ "nombre" => "Administrar" ],
				[ "nombre" => "Permisos" ]
			]
		];
		$data["idx"] = $tipoUser;
		$this->RenderView("Editar",$data);
	}
	
	public function Guardar(){
		if($_POST){
			$campos = $_POST["campo"];
			if($campos["id"] == ""){
				//Guardar registro nuevo
				unset($campos["id"]);
				$admCatalogos = $this->admCatalogos->insert($campos);
				$this->redirect("Permisos/Index/saved");
			}else{
				//Actualizar registro
				$admCatalogos = $this->admCatalogos->find($campos["id"]);
				unset($campos["id"]);
				
				$admCatalogos->update($campos);
				
				$this->redirect("Permisos/Index/updated");
			}
		}
	}
	
	public function getPermisos($idx){
		$permisos = $this->Permisos->select("*")->toArray();
		return $permisos;
	}
	
}

?>