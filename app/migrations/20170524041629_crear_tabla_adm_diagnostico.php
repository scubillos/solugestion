<?php

use Phinx\Migration\AbstractMigration;

class CrearTablaAdmDiagnostico extends AbstractMigration
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
    public function up()
    {
        $tabla = $this->table('diag_parametros',array('id' => true, 'primary_key' => 'id'));
        $tabla	->addColumn('idx_encode', 'string', array('limit' => 200))
				->addColumn('created', 'datetime')
				->addColumn('updated', 'datetime', array("null" => true))
				->addColumn('numeral', 'string', array('limit' => 10))
				->addColumn('marco_legal', 'string', array('limit' => 200))
				->addColumn('criterio', 'text')
				->addColumn('modo_verificacion', 'text')
				->addColumn('orden', 'integer')
				->addColumn('estado', 'integer')
				->save();
		
		//Creacion de opcion en el menu
		$this->execute("insert into `adm_permisos` (`idx_encode`, `created`, `updated`, `nombre`, `modulo`, `accion`, `icono`, `menu_padre`, `id_padre`, `orden`, `estado`, `observaciones`) values('999AAAA','0000-00-00 00:00:00',NULL,'Diagnostico SG-SST','AdmDiagnosticoSG_SST','','glyphicon glyphicon-pencil','0','3','3','1','');");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
		$this->execute("drop table diag_parametros;");
    }
}
