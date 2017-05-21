<?php

use Phinx\Migration\AbstractMigration;

class TablaPermisos extends AbstractMigration
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
        $tabla = $this->table('adm_permisos',array('id' => true, 'primary_key' => 'id'));
        $tabla	->addColumn('idx_encode', 'string', array('limit' => 200))
				->addColumn('created', 'datetime')
				->addColumn('updated', 'datetime', array("null" => true))
				->addColumn('nombre', 'string', array("limit" => 100))
				->addColumn('modulo', 'string', array("limit" => 100))
				->addColumn('accion', 'string', array("limit" => 100))
				->addColumn('icono', 'string', array("limit" => 100))
				->addColumn('menu_padre', 'integer', array("default" => 0))
				->addColumn('id_padre', 'integer',array("default" => 0))
				->addColumn('orden', 'integer')
				->addColumn('estado', 'integer')
				->addColumn('observaciones', 'string', array("limit" => 200))
				->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
		$this->execute("drop table adm_permisos;");
    }
}
