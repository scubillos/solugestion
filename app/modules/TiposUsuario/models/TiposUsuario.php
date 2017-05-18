<?php

use Base\Model as Model;

class TiposUsuarioModel Extends Model{
	protected $table = "usuarios_tipos";
	
	protected $fields = ["id","nombre_tipo","estado"];
}
?>