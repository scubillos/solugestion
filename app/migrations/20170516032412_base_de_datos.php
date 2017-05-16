<?php

use Phinx\Migration\AbstractMigration;

class BaseDeDatos extends AbstractMigration
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
		$this->crearTablaUsuarios();
    }
	
	public function crearTablaUsuarios(){
		$this->execute("
			CREATE TABLE `usuarios` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`tipo_empresa` int(11) NOT NULL,
				`nombre` varchar(100) NOT NULL,
				`nit` varchar(20) NOT NULL,
				`direccion` varchar(100) NOT NULL,
				`telefono` varchar(50) NOT NULL,
				`responsable` varchar(100) NOT NULL,
				`numero_responsable` varchar(50) NOT NULL,
				`celular` varchar(100) NOT NULL,
				`correo` varchar(100) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1
		");
	}
}
