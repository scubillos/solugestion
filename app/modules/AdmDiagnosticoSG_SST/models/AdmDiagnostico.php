<?php

use Base\Model as Model;

class AdmDiagnosticoModel Extends Model{
	protected $table = "diag_parametros";
	
	protected $fields = ["id","numeral","marco_legal","criterio","modo_verificacion","paso","seccion","subseccion","orden","estado"];
}
?>