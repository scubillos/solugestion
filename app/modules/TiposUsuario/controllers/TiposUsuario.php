<?php
use Base\Controller as Controller;

class TiposUsuario Extends Controller{
	public $titlePage = ".: Tipos de Usuario - Solugestion :."; //Para el titulo de la pagina
	
	public $tiposUsuario;
	
	public function __construct(){
		parent::__construct();
		$this->tiposUsuario = $this->LoadModel("TiposUsuario");
	}
	
	public function Index($status = ""){
		if(!empty($status)){
			switch($status){
				case "saved":
					$this->Toast("Tipo de usuario guardado correctamente");
				break;
				case "updated":
					$this->Toast("Tipo de usuario actualizado correctamente");
				break;
			}
			
			$this->AddVarJS(["toast_messag" => $status]);
		}
		
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
		$this->AddJS('modules/TiposUsuario/assets/js/formulario.js');
		
		$data["breadcrumb"] = [
			"titulo" => "Crear tipo de usuario",
			"ruta" => [
				[ "nombre" => "Tipos de usuario", "url" => $this->UrlBase()."TiposUsuario" ],
				[ "nombre" => "Crear" ]
			],
			"opciones" => [ ]
		];
		
		$this->RenderView("Crear",$data);
	}
	
	public function Formulario($info = []){
		$catalogos = $this->LoadModel("AdmCatalogos/AdmCatalogos");
		$estados = $catalogos->select("*")->where(["modulo" => "TiposUsuario", "tipo" => "Estado"])->toArray();
		
		$data["estados"] = $estados;
		$data["data"] = $info;
		$this->RenderView("Formulario",$data);
	}
	
	public function Guardar(){
		if($_POST){
			$campos = $_POST["campo"];
			if($campos["id_tipo"] == ""){
				//Guardar registro nuevo
				unset($campos["id_tipo"]);
				$tipoUsuario = $this->tiposUsuario->insert($campos);
				$this->redirect("TiposUsuario/Index/saved");
			}else{
				//Actualizar registro
				$tipoUsuario = $this->tiposUsuario->find($campos["id_tipo"]);
				unset($campos["id_tipo"]);
				
				$tipoUsuario->update($campos);
				
				$this->redirect("TiposUsuario/Index/updated");
			}
		}
	}
	
	public function Editar($idx = ""){
		if($idx == ""){
			return false;
		}
		$this->AddJS('modules/TiposUsuario/assets/js/formulario.js');
		
		$tipoUsuario = $this->tiposUsuario->findByIdx($idx)->toArray();
		
		$data["data"] = $tipoUsuario;
		$data["breadcrumb"] = [
			"titulo" => "Editar tipo de usuario",
			"ruta" => [
				[ "nombre" => "Tipos de usuario", "url" => $this->UrlBase()."TiposUsuario" ],
				[ "nombre" => "Editar" ]
			],
			"opciones" => [ ]
		];
		
		$this->RenderView("Editar",$data);
	}
	
	public function listar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		
		//$tiposUsuario = $this->tiposUsuario->where(["id" => ["!=", "0"] ])->toArray();
		$tiposUsuario = $this->tiposUsuario->select("*")->toArray();
		
		$response = new stdClass();
        $response->page     = $_POST["page"];
        $response->total    = ceil( count($tiposUsuario)/$_POST["rows"] );
        $response->records  = count($tiposUsuario);
        $i=0;

        if(count($tiposUsuario) != 0){
		
            foreach ($tiposUsuario AS $i => $row){
				
				$link_editar = $this->UrlBase()."TiposUsuario/Editar/".strtoupper($row['idx_encode']);
				$link_permisos = $this->UrlBase()."Permisos/Editar/".strtoupper($row['idx_encode']);;
                $hidden_options = '<a href="'.$link_editar.'" class="btn btn-block btn-outline btn-primary" id="btnEditar"  >Editar</a>';
                $hidden_options .= '<a href="#" id="btnEliminar" class="btn btn-block btn-outline btn-danger" data-id="'.$row['id'].'">Eliminar</a>';
                $hidden_options .= '<a href="'.$link_permisos.'" class="btn btn-block btn-outline btn-success" >Permisos</a>';

                $link_option = '<button class="viewOptions btn btn-success btn-sm" type="button" data-id="'.$row['id'].'" ><i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm hidden-md">Opciones</span></button>';
                $response->rows[$i]["id"] = $row['id'];
                $response->rows[$i]["cell"] = array(
                    $row['nombre_tipo'],
                    $row['estado'],
                    $link_option,
                    $hidden_options
                );
            }
        }

        echo json_encode($response);
        exit;
	}
	
	public function eliminar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		$response = new stdClass();
		$response->finish = 0;
		
		$id = $_POST["id"];
		$tipoUsuario = $this->tiposUsuario->find($id);
		$tipoUsuario->rawQuery("update usuarios_tipos set estado = 3 where id='".$id."' ");
		
		$response->finish = 1;
		$response->status = "success";
		$response->message = "Usuario eliminado correctamente";
		$response->title = "<b>Eliminacion</b>";
		
		echo json_encode($response);
		exit;		
	}
	
}

?>