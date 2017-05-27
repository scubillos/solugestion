<?php

use Base\Model as Model;

class DiagnosticoCatalogosModel Extends Model{
	protected $table = "diag_catalogos";
	
	protected $fields = ["id","texto","tipo","id_padre","estado"];
}
?>