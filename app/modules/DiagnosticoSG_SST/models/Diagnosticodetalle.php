<?php

use Base\Model as Model;

class DiagnosticodetalleModel Extends Model{
	protected $table = "diag_diagnostico_detalle";
	
	protected $fields = ["id","id_diagnostico","id_parametro","respuesta"];
}
?>