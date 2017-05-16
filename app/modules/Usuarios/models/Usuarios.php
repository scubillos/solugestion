<?php

use Base\Model as Model;

class UsuariosModel Extends Model{
	protected $table = "usuarios";
	
	protected $fields = ["id","tipo_empresa","nombre","nit","direccion","telefono","responsable","numero_responsable","celular","correo"];
}
?>