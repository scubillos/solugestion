<?php
use Base\Controller as Controller;

class DiagnosticoSG_SST Extends Controller{
	public $titlePage = ".: DiagnosticoSG_SST - Solugestion :."; //Para el titulo de la pagina
	
	public $Diagnostico;
	
	public function __construct(){
		parent::__construct();
		$this->Diagnostico = $this->LoadModel("Diagnostico");
	}
	
	public function Index($status = ""){
		if(!empty($status)){
			switch($status){
				case "saved":
					$this->Toast("DiagnosticoSG_SST guardado correctamente");
				break;
				case "updated":
					$this->Toast("DiagnosticoSG_SST actualizado correctamente");
				break;
			}
		}
		
		$this->LoadPluginJS("jqgrid");
		$this->AddJS('modules/DiagnosticoSG_SST/assets/js/tabla.js');
		$data["breadcrumb"] = [
			"titulo" => "DiagnosticoSG_SST",
			"ruta" => [
				[ "nombre" => "Diagnóstico SG-SST" ]
			],
			"opciones" => [
				"nombre" => "Crear",
				"url" => $this->UrlBase()."DiagnosticoSG_SST/Crear"
			]
		];
		
		$this->RenderView("Index",$data);
	}
	
	public function Crear(){
		$this->AddJS('modules/DiagnosticoSG_SST/assets/js/crear.js');
		$data["breadcrumb"] = [
			"titulo" => "Crear DiagnosticoSG_SST",
			"ruta" => [
				[ "nombre" => "Diagnóstico SG-SST", "url" => $this->UrlBase()."DiagnosticoSG_SST" ],
				[ "nombre" => "Crear" ]
			]
		];
		$data['estados_diag'] = $this->LoadModel("AdmCatalogos/AdmCatalogos")->select(array('valor','texto'))->where(array('modulo' => 'DiagnosticoSG_SST','tipo' => 'Estado'))->toArray();
		
		$this->RenderView("Crear",$data);
	}
	
	public function Editar($idx = ""){
		if($idx == ""){
			return false;
		}
		$this->AddJS('modules/DiagnosticoSG_SST/assets/js/crear.js');
		$Diagnostico = $this->Diagnostico->findByIdx($idx)->toArray();
		
		$data["data"] = $Diagnostico;
		$data["breadcrumb"] = [
			"titulo" => "Editar diagnostico",
			"ruta" => [
				[ "nombre" => "Diagnóstico SG-SST", "url" => $this->UrlBase()."DiagnosticoSG_SST" ],
				[ "nombre" => "Editar" ]
			]
		];
		
		$data['estados_diag'] = $this->LoadModel("AdmCatalogos/AdmCatalogos")->select(array('valor','texto'))->where(array('modulo' => 'DiagnosticoSG_SST','tipo' => 'Estado'))->toArray();

		$this->RenderView("Editar",$data);
	}
	
	public function Guardar(){
		if($_POST){
			$campos = $_POST["campo"];
			if($campos["id"] == ""){
				//Guardar registro nuevo
				unset($campos["id"]);
				$Diagnostico = $this->Diagnostico->insert($campos);
				$this->redirect("DiagnosticoSG_SST/Index/saved");
			}else{
				//Actualizar registro
				$Diagnostico = $this->Diagnostico->find($campos["id"]);
				unset($campos["id"]);
				
				$Diagnostico->update($campos);
				
				$this->redirect("DiagnosticoSG_SST/Index/updated");
			}
		}
	}
	
	
	public function listar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		
		$Diagnostico = $this->Diagnostico->select("*")->toArray();
		
		$response = new stdClass();
        $response->page     = $_POST["page"];
        $response->total    = ceil( count($Diagnostico)/$_POST["rows"] );
        $response->records  = count($Diagnostico);
        $i=0;

        if(count($Diagnostico) != 0){
            foreach ($Diagnostico AS $i => $row){
				
                $hidden_options = '<a href="'.$this->UrlBase().'DiagnosticoSG_SST/Editar/'.$row['idx_encode'].'" id="btnEditar" class="btn btn-block btn-outline btn-primary" >Editar</a>';
                

                $link_option = '<button class="viewOptions btn btn-success btn-sm" type="button" data-id="'.$row['id'].'" ><i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm hidden-md">Opciones</span></button>';
				
                $response->rows[$i]["id"] = $row['id'];
                $response->rows[$i]["cell"] = array(
                    $row['fecha_diagnostico'],
                    $row['estado'],
                    $row['observaciones_diagnostico'],
                    $link_option,
                    $hidden_options
                );
            }
        }

        echo json_encode($response);
        exit;
	}
	
	
}

?>