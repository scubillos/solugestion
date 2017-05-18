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
	
	public function Guardar(){
		if($_POST){
			$campos = $_POST["campo"];
			
			$tipoUsuario = $this->tiposUsuario->insert($campos);
			
			$this->redirect("TiposUsuario/Index/saved");
		}
	}
	
	public function listar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		
		$tiposUsuario = $this->tiposUsuario->where(["estado" => ["!=", "0"] ])->toArray();
		
		$response = new stdClass();
        $response->page     = $_POST["page"];
        $response->total    = ceil( count($tiposUsuario)/$_POST["rows"] );
        $response->records  = count($tiposUsuario);
        $i=0;

        if(count($tiposUsuario) != 0){
            foreach ($tiposUsuario AS $i => $row){
				
                $hidden_options = '<a href="#" class="btn btn-block btn-outline btn-primary">Editar</a>';
                $hidden_options .= '<a href="#" id="btnEliminar" class="btn btn-block btn-outline btn-danger" data-id="'.$row['id'].'">Eliminar</a>';

                $link_option = '<button class="viewOptions btn btn-success btn-sm" type="button" data-id="'.$row['id'].'"><i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm hidden-md">Opciones</span></button>';
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
		$tipoUsuario->toArray();
		
		$response->finish = 1;
		$response->status = "success";
		$response->message = "Usuario eliminado correctamente";
		$response->title = "<b>Eliminacion</b>";
		
		echo json_encode($response);
		exit;		
	}
	
}

?>