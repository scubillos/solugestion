<?php

use Base\Model as Model;

class UsuariosTiposPermisosModel Extends Model{
	protected $table = "usuarios_tipos_permisos";
	
	protected $fields = ["id","id_tipo_usuario","id_permiso"];
}
?>