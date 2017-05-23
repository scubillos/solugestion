<?php

use Phinx\Migration\AbstractMigration;

class RegistrosTablasInicial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
		$this->execute("
		
			truncate table `adm_permisos`;
			insert into `adm_permisos` (`idx_encode`, `created`, `updated`, `nombre`, `modulo`, `accion`, `icono`, `menu_padre`, `id_padre`, `orden`, `estado`, `observaciones`) values('444AAAA','2017-05-21 03:27:52',NULL,'Diagnostico SG','Diagnostico','','glyphicon glyphicon-signal','0','0','1','1','');
			insert into `adm_permisos` (`idx_encode`, `created`, `updated`, `nombre`, `modulo`, `accion`, `icono`, `menu_padre`, `id_padre`, `orden`, `estado`, `observaciones`) values('555AAAA','2017-05-21 03:35:42',NULL,'Plan','Plan','','glyphicon glyphicon-search','0','0','2','1','');
			insert into `adm_permisos` (`idx_encode`, `created`, `updated`, `nombre`, `modulo`, `accion`, `icono`, `menu_padre`, `id_padre`, `orden`, `estado`, `observaciones`) values('666AAAA','2017-05-21 03:36:38',NULL,'Administrador','','','glyphicon glyphicon-eye-open','1','0','3','1','');
			insert into `adm_permisos` (`idx_encode`, `created`, `updated`, `nombre`, `modulo`, `accion`, `icono`, `menu_padre`, `id_padre`, `orden`, `estado`, `observaciones`) values('777AAAA','2017-05-21 19:39:59',NULL,'Tipos de Usuario','TiposUsuario','','glyphicon glyphicon-list','0','3','1','1','');
			insert into `adm_permisos` (`idx_encode`, `created`, `updated`, `nombre`, `modulo`, `accion`, `icono`, `menu_padre`, `id_padre`, `orden`, `estado`, `observaciones`) values('888AAAA','0000-00-00 00:00:00',NULL,'Usuarios','Usuarios','','glyphicon glyphicon-user','0','3','2','1','');
			
			truncate table `gen_catalogos`;
			insert into `gen_catalogos` (`idx_encode`, `created`, `updated`, `modulo`, `tipo`, `valor`, `texto`, `orden`, `oculto`, `observaciones`) values('sadasdasdas','0000-00-00 00:00:00','2017-05-20 03:29:34','TiposUsuario','Estado','1','Activo','1','1','Pruebas para cat');
			insert into `gen_catalogos` (`idx_encode`, `created`, `updated`, `modulo`, `tipo`, `valor`, `texto`, `orden`, `oculto`, `observaciones`) values('8f14e45fceea167a5a36dedd4bea2543','2017-05-20 03:57:19',NULL,'TiposUsuario','Estado','0','Inactivo','0','0','Pruebas 222');
			insert into `gen_catalogos` (`idx_encode`, `created`, `updated`, `modulo`, `tipo`, `valor`, `texto`, `orden`, `oculto`, `observaciones`) values('c9f0f895fb98ab9159f51fd0297e236d','2017-05-21 02:53:11',NULL,'TiposUsuario','Estado','3','Eliminado','0','1','Para los tipos de usuario eliminados');
			
			truncate table `usuarios_tipos_permisos`;
			insert into `usuarios_tipos_permisos` (`idx_encode`, `created`, `updated`, `id_tipo_usuario`, `id_permiso`) values('a5771bce93e200c36f7cd9dfd0e5deaa','2017-05-22 07:45:23',NULL,'1','1');
			insert into `usuarios_tipos_permisos` (`idx_encode`, `created`, `updated`, `id_tipo_usuario`, `id_permiso`) values('d67d8ab4f4c10bf22aa353e27879133c','2017-05-22 07:45:23',NULL,'1','2');
			insert into `usuarios_tipos_permisos` (`idx_encode`, `created`, `updated`, `id_tipo_usuario`, `id_permiso`) values('d645920e395fedad7bbbed0eca3fe2e0','2017-05-22 07:45:24',NULL,'1','3');
			insert into `usuarios_tipos_permisos` (`idx_encode`, `created`, `updated`, `id_tipo_usuario`, `id_permiso`) values('3416a75f4cea9109507cacd8e2f2aefc','2017-05-22 07:45:24',NULL,'1','4');
			insert into `usuarios_tipos_permisos` (`idx_encode`, `created`, `updated`, `id_tipo_usuario`, `id_permiso`) values('a1d0c6e83f027327d8461063f4ac58a6','2017-05-22 07:45:24',NULL,'1','5');

		");
    }
}
