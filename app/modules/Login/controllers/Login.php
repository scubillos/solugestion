<?php

use Base\Controller as Controller;

class Login Extends Controller{
	public $titlePage = "Login Solugestion"; //Para el titulo de la pagina
	protected $verifySession = false;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function Index(){
		if($_GET){
			if($_GET["invalid"]==1){
				$this->Toast("Usuario o contraseña no valido","error","Error login");
			}
		}
		$this->AddJs("modules/Login/assets/js/login.js");
		$this->RenderView("Index");

	}
	
	public function Auth(){
		if($_POST){
			$email = $_POST["usuario"];
			$pass = md5($_POST["pass"]);
			$users = $this->LoadModel("Usuarios/Usuarios");
			$users = $users->where(["correo" => $email, "pass" => $pass ])->toArray();
			if(count($users)==1){
				$idhex = dechex($users[0]["id"]);
				$nombreus = $users[0]["nombre"];
				$tipo_usuario = $users[0]["tipo_usuario"];
				
				$this->session->varSession_set("idhex",$idhex);
				$this->session->varSession_set("nombre",$nombreus);
				$this->session->varSession_set("tipo_usuario",$tipo_usuario);
				$this->session->varSession_set("url_app",URL_APP);
				
				$Permisos = $this->LoadModel("Permisos/Permisos");
				$UsuariosTiposPermisos = $this->LoadModel("Permisos/UsuariosTiposPermisos");
				
				//Se obtienen todos los permisos
				$perms = $Permisos->select(["id","nombre","icono","modulo","accion","id_padre"])->where("id_padre",0)->relations(["submenus"])->toArray();
				$permissions = [];
				foreach($perms as $value){
					$url = $value["modulo"] != "" ? $value["modulo"] : "#";
					$url .= $value["accion"] != "" ? "/".$value["accion"] : "";
					
					$submenus = [];
					if(isset($value["submenus"])){
						foreach($value["submenus"] as $sub){
							$urlsub = $sub["modulo"] != "" ? $sub["modulo"] : "#";
							$urlsub .= $sub["accion"] != "" ? "/".$sub["accion"] : "";
							
							$submenus[] = [
								"id" => $sub["id"],
								"nombre" => $sub["nombre"],
								"url" => $urlsub,
								"icono" => $sub["icono"],
							];
						}
					}
					
					$permissions[] = [
						"id" => $value["id"],
						"nombre" => $value["nombre"],
						"url" => $url,
						"icono" => $value["icono"],
						"submenus" => $submenus
					];
				}
				$this->session->varSession_set("permissions",$permissions);
				
				// Se obtienen los permisos del tipo de usuario
				$permsUs = $UsuariosTiposPermisos->select("id_permiso")->where("id_tipo_usuario",$tipo_usuario)->toArray();
				$permisosUser = [];
				foreach($permsUs as $k => $val){
					$permisosUser[] = $val["id_permiso"];
				}
				$this->session->varSession_set("permissions_auth",$permisosUser);
				
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