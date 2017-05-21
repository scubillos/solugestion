<?php

use Phinx\Migration\AbstractMigration;

class CrearTablaUsuarios extends AbstractMigration
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
        $this->CambioTablaUsuario();
    }

    public function CambioTablaUsuario() {

        $tablau = $this->table('usuarios');
        $tablau->addColumn('created', 'datetime', array('after'=>'id'))
               ->addColumn('updated', 'datetime', array('null' => true,'after' => 'created'))
               ->addColumn('idx_encode','string', array('limit'=>200,'after'=>'updated'))
               ->addIndex(array('idx_encode'))
               ->renameColumn('tipo_empresa','tipo_usuario')
               ->changeColumn('tipo_usuario','string', array('limit'=>100))
               ->renameColumn('responsable','persona_contacto')
               ->renameColumn('numero_responsable','num_percontacto')
               ->renameColumn('celular','responsable')
               ->changeColumn('responsable','string', array('limit'=>100))
               ->renameColumn('correo','num_movil')
               ->changeColumn('num_movil','integer')
               ->addColumn('correo','string', array('limit'=>100))
               ->addColumn('pass','string', array('limit'=>100))
               ->addColumn('estado','integer')
              
               ->save();
    }
}
