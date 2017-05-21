<?php
use Base\Controller as Controller;

class AdmCatalogos Extends Controller{
	public $titlePage = ".: Administrar catálogos - Solugestion :."; //Para el titulo de la pagina
	
	public $admCatalogos;
	
	public function __construct(){
		parent::__construct();
		$this->admCatalogos = $this->LoadModel("AdmCatalogos");
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
		}
		
		$this->LoadPluginJS("jqgrid");
		$this->AddJS('modules/AdmCatalogos/assets/js/tabla.js');
		$data["breadcrumb"] = [
			"titulo" => "Administrador de Catálogos",
			"ruta" => [
				[ "nombre" => "Administrar" ],
				[ "nombre" => "Catálogos" ]
			]
		];
		
		//Se trae informacion de la BD
		$data["tipos"] = $this->admCatalogos->select("tipo")->groupBy("tipo")->toArray();
		
		$this->RenderView("Index",$data);
	}
	
	public function Guardar(){
		if($_POST){
			$campos = $_POST["campo"];
			if($campos["id"] == ""){
				//Guardar registro nuevo
				unset($campos["id"]);
				$admCatalogos = $this->admCatalogos->insert($campos);
				$this->redirect("AdmCatalogos/Index/saved");
			}else{
				//Actualizar registro
				$admCatalogos = $this->admCatalogos->find($campos["id"]);
				unset($campos["id"]);
				
				$admCatalogos->update($campos);
				
				$this->redirect("AdmCatalogos/Index/updated");
			}
		}
	}
	
	public function ajax_editar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		$id = $_POST["id"];
		$infoCat = $this->admCatalogos->find($id)->toArray();
		
		echo json_encode($infoCat);
		exit;
	}
	
	public function listar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		
		$admCatalogos = $this->admCatalogos->select("*")->toArray();
		
		$response = new stdClass();
        $response->page     = $_POST["page"];
        $response->total    = ceil( count($admCatalogos)/$_POST["rows"] );
        $response->records  = count($admCatalogos);
        $i=0;

        if(count($admCatalogos) != 0){
            foreach ($admCatalogos AS $i => $row){
				
                $hidden_options = '<a href="#" id="btnEditar" class="btn btn-block btn-outline btn-primary" id="btnEditar" data-id="'.$row['id'].'" >Editar</a>';
                $hidden_options .= '<a href="#" id="btnEliminar" class="btn btn-block btn-outline btn-danger" data-id="'.$row['id'].'">Eliminar</a>';

                $link_option = '<button class="viewOptions btn btn-success btn-sm" type="button" data-id="'.$row['id'].'" ><i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm hidden-md">Opciones</span></button>';
                $response->rows[$i]["id"] = $row['id'];
                $response->rows[$i]["cell"] = array(
                    $row['modulo'],
                    $row['tipo'],
                    $row['valor'],
                    $row['texto'],
                    $row['observaciones'],
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