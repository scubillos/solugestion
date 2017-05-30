<?php
use Base\Controller as Controller;

class AdmDiagnosticoSG_SST Extends Controller{
	public $titlePage = ".: Administrar parámetros Diagnóstico SG-SST - Solugestion :."; //Para el titulo de la pagina
	
	public $admDiagnostico;
	public $diagnosticoCatalogos;
	
	public function __construct(){
		parent::__construct();
		$this->admDiagnostico = $this->LoadModel("AdmDiagnostico");
		$this->diagnosticoCatalogos = $this->LoadModel("DiagnosticoCatalogos");
	}
	
	public function Index($status = ""){
		if(!empty($status)){
			switch($status){
				case "saved":
					$this->Toast("Parámetro creado correctamente");
				break;
				case "updated":
					$this->Toast("Parámetro actualizado correctamente");
				break;
				case "parameterized":
					$this->Toast("Formulario parametrizado correctamente");
				break;
			}
		}
		
		$this->LoadPluginJS("jqgrid");
		$this->AddJS('modules/AdmDiagnosticoSG_SST/assets/js/tabla.js');
		$data["breadcrumb"] = [
			"titulo" => "Administrador Diagnóstico SG-SST",
			"ruta" => [
				[ "nombre" => "Administrar" ],
				[ "nombre" => "Diagnóstico SG-SST" ]
			],
			"opciones" => [
				"nombre" => "Crear",
				"url" => $this->UrlBase()."AdmDiagnosticoSG_SST/Crear"
			],
			"botones" => [
				[
					"nombre" => "Parametrizar",
					"url" => $this->UrlBase()."AdmDiagnosticoSG_SST/Parametrizar"
				]
			]
		];
		
		$this->RenderView("Index",$data);
	}
	
	public function Crear(){
		$this->AddJS([
			'modules/AdmDiagnosticoSG_SST/assets/js/formulario.js',
			'modules/AdmDiagnosticoSG_SST/assets/js/crear.js'
		]);
		$data["breadcrumb"] = [
			"titulo" => "Crear parámetro",
			"ruta" => [
				[ "nombre" => "Administrar" ],
				[ "nombre" => "Diagnóstico SG-SST", "url" => $this->UrlBase()."AdmDiagnosticoSG_SST" ],
				[ "nombre" => "Crear" ]
			]
		];
		
		//Se obtienen los pasos de los catalogos principales - tipo=0
		$data["Pasos"] = $this->diagnosticoCatalogos->select(["id","texto"])->where(["estado" => 1,"tipo"=>0])->toArray();
		$data["estados"] = $this->LoadModel("AdmCatalogos/AdmCatalogos")->select(["valor","texto"])->where(["modulo" => "AdmDiagnosticoSG_SST","tipo" => "Estado"])->toArray();
		
		$this->RenderView("Crear",$data);
	}
	
	public function Editar($idx = ""){
		if($idx == ""){
			return false;
		}
		$this->AddJS('modules/AdmDiagnosticoSG_SST/assets/js/crear.js');
		$Parametro = $this->admDiagnostico->findByIdx($idx)->toArray();
		
		$data["data"] = $Parametro;
		$data["breadcrumb"] = [
			"titulo" => "Editar parámetro",
			"ruta" => [
				[ "nombre" => "Administrar" ],
				[ "nombre" => "Diagnóstico SG-SST", "url" => $this->UrlBase()."AdmDiagnosticoSG_SST" ],
				[ "nombre" => "Editar" ]
			]
		];
		//Se obtienen los pasos de los catalogos principales - tipo=0
		$data["Pasos"] = $this->diagnosticoCatalogos->select(["id","texto"])->where(["estado" => 1,"tipo"=>0])->toArray();
		$data["estados"] = $this->LoadModel("AdmCatalogos/AdmCatalogos")->select(["valor","texto"])->where(["modulo" => "AdmDiagnosticoSG_SST","tipo" => "Estado"])->toArray();
		
		$this->RenderView("Editar",$data);
	}
	
	public function Parametrizar(){
		$TiposUsuario = $this->LoadModel("TiposUsuario/TiposUsuario")->select(["id","nombre_tipo"])->where(["administrador" => 0, "estado" => 1])->toArray();
		$this->AddJS('modules/AdmDiagnosticoSG_SST/assets/js/parametrizar.js');
		
		$data["TiposUsuario"] = $TiposUsuario;
		$data["breadcrumb"] = [
			"titulo" => "Editar parámetro",
			"ruta" => [
				[ "nombre" => "Administrar" ],
				[ "nombre" => "Diagnóstico SG-SST", "url" => $this->UrlBase()."AdmDiagnosticoSG_SST" ],
				[ "nombre" => "Parametrizar" ]
			]
		];
		
		$this->RenderView("Parametrizar",$data);
	}
	
	public function Guardar(){
		if($_POST){
			$campos = $_POST["campo"];
			if($campos["id"] == ""){
				//Guardar registro nuevo
				unset($campos["id"]);
				$admDiagnostico = $this->admDiagnostico->insert($campos);
				$this->redirect("AdmDiagnosticoSG_SST/Index/saved");
			}else{
				//Actualizar registro
				$admDiagnostico = $this->admDiagnostico->find($campos["id"]);
				unset($campos["id"]);
				
				$admDiagnostico->update($campos);
				
				$this->redirect("AdmDiagnosticoSG_SST/Index/updated");
			}
		}
	}
	
	public function ajax_buscarSecciones(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		$id_paso = $_POST["id_paso"];
		
		$options = $this->diagnosticoCatalogos->select(["id","texto"])->where(["tipo" => '1', "id_padre" => $id_paso, "estado" => 1])->toArray();

		$response = new stdClass();
		$response->finish = false;
		if(count($options)!=0){
			$response->finish = true;
			$response->options = $options;
			
		}
		
		echo json_encode($response);
		die;
	}
	
	public function ajax_buscarSubsecciones(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		$id_seccion = $_POST["id_seccion"];
		
		$options = $this->diagnosticoCatalogos->select(["id","texto"])->where(["tipo" => '2', "id_padre" => $id_seccion, "estado" => 1])->toArray();

		$response = new stdClass();
		$response->finish = false;
		if(count($options)!=0){
			$response->finish = true;
			$response->options = $options;
		}
		
		echo json_encode($response,true);
		die;
	}
	
	public function ajax_getInfoEditar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		$id = $_POST["id"];
		
		$options = $this->admDiagnostico->find($id)->toArray();

		$response = new stdClass();
		$response->finish = false;
		if(count($options)!=0){
			$response->finish = true;
			$response->seccion = $options["seccion"];
			$response->subseccion = $options["subseccion"];
		}
		
		echo json_encode($response,true);
		die;
	}
	
	public function ajax_getParametrizacionTipo(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		$tipoUsuario = $_POST["tipoUsuario"];
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
		$FormTipoUsuario = $this->LoadModel("DiagForms")->select("id_parametro")->where("id_tipo_usuario",$tipoUsuario)->toArray();
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
	
	public function GuardarParametrizacion(){
		if($_POST){
			$id_tipo_usuario = $_POST["id_tipo_usuario"];
			$parametros = $_POST["parametros"];
			$DiagForms = $this->LoadModel("DiagForms");
			$DiagForms->delete("id_tipo_usuario",$id_tipo_usuario);
			foreach($parametros as $id_parametro){
				$campos = [];
				$campos["id_tipo_usuario"] = $id_tipo_usuario;
				$campos["id_parametro"] = $id_parametro;
				$DiagForms->insert($campos);
			}
			$this->redirect("AdmDiagnosticoSG_SST/Index/parameterized");
		}
	}
	
	public function listar(){
		if(!$this->isAjaxRequest()){
			return false;
		}
		
		//$admDiagnostico = $this->admDiagnostico->select("*")->relations(["nPaso","nSeccion","nSubseccion"])->toArray();
		$admDiagnostico = $this->admDiagnostico->select("*")->relations(["nPaso","nSeccion","nSubseccion"])->toArray();
		$response = new stdClass();
        $response->page     = $_POST["page"];
        $response->total    = ceil( count($admDiagnostico)/$_POST["rows"] );
        $response->records  = count($admDiagnostico);
        $i=0;

        if(count($admDiagnostico) != 0){
            foreach ($admDiagnostico AS $i => $row){
				
                $hidden_options = '<a href="'.$this->UrlBase().'AdmDiagnosticoSG_SST/Editar/'.$row['idx_encode'].'" id="btnEditar" class="btn btn-block btn-outline btn-primary" >Editar</a>';
                $hidden_options .= '<a href="#" class="btn btn-block btn-outline btn-danger" data-id="'.$row['id'].'">Eliminar</a>';

                $link_option = '<button class="viewOptions btn btn-success btn-sm" type="button" data-id="'.$row['id'].'" ><i class="fa fa-cog"></i> <span class="hidden-xs hidden-sm hidden-md">Opciones</span></button>';
				
				if( strlen($row['criterio']) > 200 ){
					$criterio = substr($row['criterio'],0,200)."...";
				}else{
					$criterio = $row['criterio'];
				}
				
				if( strlen($row['modo_verificacion']) > 200 ){
					$modo_verificacion = substr($row['modo_verificacion'],0,200)."...";
				}else{
					$modo_verificacion = $row['modo_verificacion'];
				}
				
                $response->rows[$i]["id"] = $row['id'];
                $response->rows[$i]["cell"] = array(
                    $row['nPaso']["texto"],
                    $row['nSeccion']["texto"],
                    $row['nSubseccion']["texto"],
                    $row['numeral'],
                    $row['marco_legal'],
                    $criterio,
                    $modo_verificacion,
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
		$tipoUsuario->update(["estado" => 2]);
		
		$response->finish = 1;
		$response->status = "success";
		$response->message = "Pregunta eliminada correctamente";
		$response->title = "<b>Eliminacion</b>";
		
		echo json_encode($response);
		exit;		
	}
	
}

?>