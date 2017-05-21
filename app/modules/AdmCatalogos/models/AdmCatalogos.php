<?php

use Base\Model as Model;

class AdmCatalogosModel Extends Model{
	protected $table = "gen_catalogos";
	
	protected $fields = ["id","modulo","tipo","valor","texto","orden","oculto","observaciones"];
}
?>