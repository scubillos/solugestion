<?php

use Base\Controller as Controller;

class Login Extends Controller{
	public $titlePage = "Login"; //Para el titulo de la pagina
	
	public function __construct(){
		parent::__construct();
	}
	
	public function Index(){
		$this->RenderView("Index");
	}
	
	public function Auth(){
		if($_POST){
			$nombre = $_POST["usuario"];
			$users = $this->LoadModel("Usuarios/Usuarios");
			$users = $users->where([ "nombre" => $nombre ])->toArray();
			if(count($users)==1){
				$idbin = decbin($users[0]["id"]);
				$nombreus = $users[0]["nombre"];
				$this->session->varSession_set("idbin",$idbin);
				$this->session->varSession_set("nombre",$nombreus);
				$this->session->varSession_set("url_app",URL_APP);
				
				$permissions = [
					array("nombre" => "Diagnostico SG", "url" => "Diagnostico/listar", "icono" => "glyphicon glyphicon-signal"),
					array("nombre" => "Plan", "url" => "Plan/listar", "icono" => "glyphicon glyphicon-search"),
					array("nombre" => "Administrador", "url" => "#", "icono" => "glyphicon glyphicon-eye-open", "submenus" => [
						array("nombre" => "Tipos de usuario", "url" => "TiposUsuario/listar", "icono" => "glyphicon glyphicon-list"),
						array("nombre" => "Usuarios", "url" => "Usuarios/listar", "icono" => "glyphicon glyphicon-user"),
					])
				];
				
				$this->session->varSession_set("permissions",$permissions);
				
				$this->redirect("Home");
			}
		}
	}
}

?>