<?php

use Phinx\Migration\AbstractMigration;

class ModeloDiagnosticoEic extends AbstractMigration
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
        $tabla = $this->table('diag_diagnostico',array('id' => true, 'primary_key' => 'id'));
        $tabla  ->addColumn('idx_encode', 'string', array('limit' => 200))
                ->addColumn('created', 'datetime')
                ->addColumn('updated', 'datetime', array("null" => true))
                ->addColumn('fecha_diagnostico', 'date', array("null" => true))
                ->addColumn('estado', 'integer')
                ->addColumn('observaciones_diagnostico', 'string', array('limit' => 200))
                ->addColumn('id_usuario', 'integer')
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->execute("drop table modelo_diagnostico_eic;");
    }
}
