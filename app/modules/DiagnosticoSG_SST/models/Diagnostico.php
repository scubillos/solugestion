<?php

use Base\Model as Model;

class DiagnosticoModel Extends Model{
	protected $table = "diag_diagnostico";
	
	protected $fields = ["id","fecha_diagnostico","estado","observaciones_diagnostico","id_usuario"];
}
?>