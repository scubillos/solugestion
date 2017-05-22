<?php
use Base\Controller as Controller;

class Usuarios Extends Controller{
	public $titlePage = ".: Usuarios - Solugestion :."; //Para el titulo de la pagina

	public $Usuarios;
	
	public function __construct(){
		parent::__construct();
		$this->Usuarios = $this->LoadModel("Usuarios");
	}
	
	public function Index($status = ""){
		if(!empty($status)){
			switch($status){
				case "saved":
					$this->Toast("Usuario guardado correctamente");
				break;
				case "updated":
					$this->Toast("Usuario actualizado correctamente");
				break;	
			}
			
		}

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
		$data["tiposUsuario"] = $this->LoadModel("TiposUsuario/TiposUsuario")->select(["id","nombre_tipo"])->where("estado",1)->toArray();
		$this->RenderView("Crear",$data);
	}
	
	public function Guardar(){
		if ($_POST) {
				
			$campos = $_POST["campo"];
			$campos["pass"] = md5($_POST["pass"]);

			if($campos["id"] == ""){
			unset($campos["id"]);
			$usuario = $this->Usuarios->insert($campos);

			$this->redirect("Usuarios/Index/saved");
			}else{
				$Usuarios = $this->Usuarios->find($campos["id"]);
				unset($campos["id"]);
				
				$Usuarios->update($campos);
				
				$this->redirect("Usuarios/Index/updated");
			}

			
		}
		
		
	}

	public function listar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		
		$Usuarios = $this->Usuarios->where(["id" => ["!=", "0"] ])->toArray();
		
		$response = new stdClass();
        $response->page     = $_POST["page"];
        $response->total    = ceil( count($Usuarios)/$_POST["rows"] );
        $response->records  = count($Usuarios);
        $i=0;

        if(count($Usuarios) != 0){
			// PROVICIONAL. CAMBIAR CUANDO SE CREE LA FUNCION PARA RELACIONES UNO A UNO
			$TipoUsuario = $this->LoadModel("TiposUsuario/TiposUsuario");
            foreach ($Usuarios AS $i => $row){
				
				// PROVICIONAL. CAMBIAR CUANDO SE CREE LA FUNCION PARA RELACIONES UNO A UNO
				$tipo = $TipoUsuario->where("id",$row["tipo_usuario"])->toArray();
				
				$tipo_usuario_txt = $tipo[0]["nombre_tipo"];
				
				$link_editar = $this->UrlBase()."Usuarios/Editar/".strtoupper($row['idx_encode']);
                $hidden_options = '<a href="'.$link_editar.'" class="btn btn-block btn-outline btn-primary" id="btnEditar"  >Editar</a>';
                $hidden_options .= '<a href="#" id="btnEliminar" class="btn btn-block btn-outline btn-danger" data-id="'.$row['id'].'">Eliminar</a>';

                $link_option = '<button class="viewOptions btn btn-success btn-sm" type="button" data-id="'.$row['id'].'" ><i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm hidden-md">Opciones</span></button>';
                $response->rows[$i]["id"] = $row['id'];
                $response->rows[$i]["cell"] = array(
                    $row['nombre'],
                    $tipo_usuario_txt,
                    $row['persona_contacto'],
                    $row['num_percontacto'],
                    $row['estado'],
                    $link_option,
                    $hidden_options
                );
            }
        }

        echo json_encode($response);
        exit;
	}

	public function Editar($idx = ""){
		if($idx == ""){
			return false;
		}
		$this->AddJS('modules/Usuarios/assets/js/crear.js');
		$Usuarios = $this->Usuarios->findByIdx($idx)->toArray();
		
		$data["data"] = $Usuarios;
		$data["breadcrumb"] = [
			"titulo" => "Editar usuario",
			"ruta" => [
				[ "nombre" => "usuarios", "url" => $this->UrlBase()."Usuarios" ],
				[ "nombre" => "Editar" ]
			],
			"opciones" => [ ]
		];
		$data["tiposUsuario"] = $this->LoadModel("TiposUsuario/TiposUsuario")->select(["id","nombre_tipo"])->where("estado",1)->toArray();
		$this->RenderView("Crear",$data);
	}

	public function eliminar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		$response = new stdClass();
		$response->finish = 0;
		
		$id = $_POST["id"];
		$Usuarios = $this->Usuarios->find($id);
		$Usuarios->update(array("estado"=>3));
		
		$response->finish = 1;
		$response->status = "success";
		$response->message = "Usuario eliminado correctamente";
		$response->title = "<b>Eliminacion</b>";
		
		echo json_encode($response);
		exit;		
	}	
}

?>