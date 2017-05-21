<?php

use Base\Model as Model;

class UsuariosModel Extends Model{
	protected $table = "usuarios";
	
	protected $fields = ["id","tipo_usuario","nombre","nit","direccion","telefono","persona_contacto","num_percontacto","responsable",
	                     "correo", "num_movil","correo","pass","estado"];
}
?>