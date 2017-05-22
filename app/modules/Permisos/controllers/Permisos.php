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
		$tipoUsuario = $this->LoadModel("TiposUsuario/TiposUsuario")->findByIdx($tipoUser)->toArray();
		if($tipoUsuario == NULL){
			die("Tipo de usuario no valido");
		}
		
		$data["breadcrumb"] = [
			"titulo" => "Permisos de usuarios",
			"ruta" => [
				[ "nombre" => "Administrar" ],
				[ "nombre" => "Permisos" ]
			]
		];
		$data["idx"] = $tipoUser;
		$data["id_tipousuario"] = $tipoUsuario["id"];
		$this->RenderView("Editar",$data);
	}
	
	public function Guardar(){
		if($_POST){
			$usuariosTiposPermisos = $this->LoadModel("UsuariosTiposPermisos");
			$id_tipo_usuario = $_POST["id_tipousuario"];
			if( isset($_POST["permisos"]) ){
				$usuariosTiposPermisos->delete("id_tipo_usuario",$id_tipo_usuario);
				$permisos = $_POST["permisos"];
				foreach($permisos as $permiso){
					$campos = [ "id_tipo_usuario" => $id_tipo_usuario, "id_permiso" => $permiso ];
					$usuariosTiposPermisos->insert($campos);
				}
			}
		}
		$this->redirect("TiposUsuario");
	}
	
	public function getPermisos($idx){
		$permisos = $this->Permisos->where("id_padre",0)->relations(["submenus"])->toArray();
		
		return $permisos;
	}
	
}

?>