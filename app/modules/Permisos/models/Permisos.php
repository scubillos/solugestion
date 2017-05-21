<?php

use Base\Model as Model;

class PermisosModel Extends Model{
	protected $table = "adm_permisos";
	
	protected $fields = ["id","nombre","modulo","accion","icono","menu_padre","id_padre","orden","estado","observaciones"];
}
?>