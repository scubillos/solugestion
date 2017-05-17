<?php

use Base\Controller as Controller;

class Login Extends Controller{
	public $titlePage = "Login Solugestion"; //Para el titulo de la pagina
	protected $verifySession = false;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function Index(){
		$this->AddJs("modules/Login/assets/js/login.js");
		$this->RenderView("Index");
	}
	
	public function Auth(){
		if($_POST){
			$email = $_POST["usuario"];
			$users = $this->LoadModel("Usuarios/Usuarios");
			$users = $users->where([ "correo" => $email ])->toArray();
			if(count($users)==1){
				$idbin = decbin($users[0]["id"]);
				$nombreus = $users[0]["nombre"];
				$this->session->varSession_set("idbin",$idbin);
				$this->session->varSession_set("nombre",$nombreus);
				$this->session->varSession_set("url_app",URL_APP);
				
				$permissions = [
					array("id" => 1, "nombre" => "Diagnostico SG", "url" => "Diagnostico", "icono" => "glyphicon glyphicon-signal"),
					array("id" => 2, "nombre" => "Plan", "url" => "Plan", "icono" => "glyphicon glyphicon-search"),
					array("id" => 3, "nombre" => "Administrador", "url" => "#", "icono" => "glyphicon glyphicon-eye-open", "submenus" => [
						array("id" => 4, "nombre" => "Tipos de usuario", "url" => "TiposUsuario", "icono" => "glyphicon glyphicon-list"),
						array("id" => 5, "nombre" => "Usuarios", "url" => "Usuarios", "icono" => "glyphicon glyphicon-user"),
					])
				];
				
				$this->session->varSession_set("permissions",$permissions);
				
				$this->redirect("Home");
			}else{
				$this->redirect("Login/Index?invalid=1");
			}
		}
	}
	
	
	
	public function Logout(){
		$this->AddJs("modules/Login/assets/js/login.js");
		if($this->session->destroySession()){
			$this->RenderView("Index");
		}
	}
}

?>