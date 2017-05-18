<?php

use Phinx\Migration\AbstractMigration;

class TablaTiposUsuario extends AbstractMigration
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
        $tabla = $this->table('usuarios_tipos', array('id' => true, 'primary_key' => 'id'));
        $tabla->addColumn('nombre_tipo', 'string', array('limit' => 40))
              ->addColumn('estado', 'integer')
              ->addColumn('created', 'datetime')
              ->addColumn('updated', 'datetime', array('null' => true))
              ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
		$this->execute("drop table usuarios_tipos;");
    }
}
