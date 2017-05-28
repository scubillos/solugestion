<?php

use Base\Model as Model;

class DiagnosticoCatalogosModel Extends Model{
	protected $table = "diag_catalogos";
	
	protected $fields = ["id","texto","tipo","id_padre","estado"];
	
	public function secciones(){
		return $this->oneMany("diag_catalogos","id_padre","id", ["id","texto"],["estado"=>1]);
	}
	
	public function parametros(){
		return $this->oneMany("diag_parametros","subseccion","id", ["id","numeral","marco_legal","criterio"],["estado"=>1]);
	}
}
?>