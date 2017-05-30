<?php
use Base\Controller as Controller;

class DiagnosticoSG_SST Extends Controller{
	public $titlePage = ".: DiagnosticoSG_SST - Solugestion :."; //Para el titulo de la pagina
	
	public $Diagnostico;
	public $diagnosticoCatalogos;
	public $Diagdetalle;
	
	public function __construct(){
		parent::__construct();
		$this->Diagnostico = $this->LoadModel("Diagnostico");
		$this->diagnosticoCatalogos = $this->LoadModel("AdmDiagnosticoSG_SST/DiagnosticoCatalogos");
		$this->Diagdetalle = $this->LoadModel("Diagnosticodetalle");
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
			$respuestas = $_POST["respuestas"];
			if($campos["id"] == ""){
				//Guardar registro nuevo
				unset($campos["id"]);
				$Diagnostico = $this->Diagnostico->insert($campos);
				var_dump($Diagnostico);
				foreach ($respuestas as $id_parametro => $respuesta){
					$detalle = array(
						"id_diagnostico" => $Diagnostico->id,
						"id_parametro" => $id_parametro,
						"respuesta" => $respuesta
						);
					$guardarres = $this->Diagdetalle->insert($detalle);
				}
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


	public function getParametrizacionTipo(){
		
		$tipoUsuario = $this->session->varSession_get("tipo_usuario");
		$Parametros = $this->diagnosticoCatalogos->select("*")->where(["tipo" => 0, "estado" => 1])->relations(["secciones"])->toArray();
		
		for($i=0; $i < count($Parametros); $i++){
			$Parametro = $Parametros[$i];
			
			if(isset($Parametro["secciones"]) AND count($Parametro["secciones"]) != 0){
				$j = 0;
				foreach($Parametro["secciones"] as $k => $seccion){
					$id_seccion = $seccion["id"];
					$Subsecciones = $this->diagnosticoCatalogos->select(["id","texto"])->where(["id_padre" => $id_seccion,"tipo" => 2, "estado" => 1])->relations(["parametros"])->toArray();
					
					$Parametros[$i]["secciones"][$j]["subsecciones"] = $Subsecciones;
					$j++;
				}				
			}
		}
		$FormTipoUsuario = $this->LoadModel("AdmDiagnosticoSG_SST/DiagForms")->select("id_parametro")->where("id_tipo_usuario",$tipoUsuario)->toArray();
		$ParametrosTipoUsuario = [];
		if($FormTipoUsuario != NULL){
			foreach($FormTipoUsuario as $k => $value){
				$ParametrosTipoUsuario[] = $value["id_parametro"];
			}
		}
		
		$data["Parametros"] = $Parametros;
		$data["ParametrosTipoUsuario"] = $ParametrosTipoUsuario;
	
		$this->RenderView("TablaParametrizacion",$data);
	}
	
}

?>