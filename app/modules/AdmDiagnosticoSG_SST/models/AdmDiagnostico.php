<?php

use Base\Model as Model;

class AdmDiagnosticoModel Extends Model{
	protected $table = "diag_parametros";
	
	protected $fields = ["id","numeral","marco_legal","criterio","modo_verificacion","paso","seccion","subseccion","orden","estado"];
	
	public function nPaso(){
		return $this->oneOne("diag_catalogos","id","paso", ["texto"]);
	}
	public function nSeccion(){
		return $this->oneOne("diag_catalogos","id","seccion", ["texto"]);
	}
	public function nSubseccion(){
		return $this->oneOne("diag_catalogos","id","subseccion", ["texto"]);
	}
}
?>