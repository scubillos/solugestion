<?php

use Base\Model as Model;

class DiagFormsModel Extends Model{
	protected $table = "diag_formularios";
	
	protected $fields = ["id","id_tipo_usuario","id_parametro"];
	
}
?>