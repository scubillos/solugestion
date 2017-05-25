<?php

use Phinx\Migration\AbstractMigration;

class InsertCatalogosDiag extends AbstractMigration
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
		$this->InsertCatalogos();
    }
	
	public function InsertCatalogos(){
		$rows = [
			[ "idx_encode" => "111AAAA", "texto" => "I PLANEAR", "id_padre" => 0, "tipo" => 0, "estado" => 1 ],
			[ "idx_encode" => "222AAAA", "texto" => "II HACER", "id_padre" => 0, "tipo" => 0, "estado" => 1 ],
			[ "idx_encode" => "333AAAA", "texto" => "III VERIFICAR", "id_padre" => 0, "tipo" => 0, "estado" => 1 ],
			[ "idx_encode" => "444AAAA", "texto" => "IV ACTUAR", "id_padre" => 0, "tipo" => 0, "estado" => 1 ],
			
			//Tipo1
			[ "idx_encode" => "111BBBB", "texto" => "ESTANDAR 1 RECURSOS (10%)", "id_padre" => 1, "tipo" => 1, "estado" => 1 ],
			[ "idx_encode" => "222BBBB", "texto" => "ESTANDAR 2 – GESTION INTEGRAL DEL SISTEMA DE LA SEGURIDAD Y SALUD EN EL TRABAJO (15%)", "id_padre" => 1, "tipo" => 1, "estado" => 1 ],
			
			[ "idx_encode" => "333BBBB", "texto" => "ESTANDAR 3 – GESTION DE LA SALUD (20%)", "id_padre" => 2, "tipo" => 1, "estado" => 1 ],
			[ "idx_encode" => "444BBBB", "texto" => "ESTANDAR 4. GESTION DE PELIGROS Y RIESGOS (30%)", "id_padre" => 2, "tipo" => 1, "estado" => 1 ],
			[ "idx_encode" => "555BBBB", "texto" => "ESTANDAR 5. GESTION DE AMENAZAS (10%)", "id_padre" => 2, "tipo" => 1, "estado" => 1 ],
			
			[ "idx_encode" => "666BBBB", "texto" => "ESTANDAR 6. VERIFICACION DEL SISTEMA DE GESTION EN SEGURIDAD Y SALUD EN EL TRABAJO (5%)", "id_padre" => 3, "tipo" => 1, "estado" => 1 ],
			
			[ "idx_encode" => "666BBBB", "texto" => "ESTANDAR  7. MEJORAMIENTO (10%)", "id_padre" => 4, "tipo" => 1, "estado" => 1 ],
			
			//Tipo2
			[ "idx_encode" => "111CCCC", "texto" => "E1.1 Estándar: Recursos financieros, técnicos humanos y de otra índole (4 %)", "id_padre" => 5, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "222CCCC", "texto" => "E1.2 Estándar: Capacitación en el Sistema de Gestión de Seguridad y Salud en el Trabajo (6 %)", "id_padre" => 5, "tipo" => 2, "estado" => 1 ],
			////////////////////
			[ "idx_encode" => "333CCCC", "texto" => "E2.1 Estándar: Política de Seguridad y Salud en el Trabajo (1 %)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "444CCCC", "texto" => "E2.2 Estándar: Objetivos del Sistema de Gestión de Seguridad y Salud en el Trabajo SG-SST (1%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "555CCCC", "texto" => "E2.3 Estándar: Evaluación inicial del Sistema de Gestión – Seguridad y Salud en el Trabajo (1%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "666CCCC", "texto" => "E2.4 Estándar: Plan Anual de Trabajo (2%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "777CCCC", "texto" => "E2.5 Estándar: Conservación de la documentación (2%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "888CCCC", "texto" => "E2.6 Estándar: Rendición de cuentas (1%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "999CCCC", "texto" => "E2.7 Estándar: Normativa nacional vigente y aplicable en materia de Seguridad y Salud en el Trabajo. (2%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "1111CCC", "texto" => "E2.8 Estándar: Mecanismos de Comunicación. (1%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "2222CCC", "texto" => "E2.9 Estándar: Adquisiciones (1%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "3333CCC", "texto" => "E2.10 Estándar: Contratación (2%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "4444CCC", "texto" => "E2.11 Estándar: Gestión del cambio (1%)", "id_padre" => 6, "tipo" => 2, "estado" => 1 ],
			///////////////////
			[ "idx_encode" => "5555CCC", "texto" => "E3.1 Estándar: Condiciones de salud en el trabajo (9 %)", "id_padre" => 7, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "6666CCC", "texto" => "E3.2 Estándar: Registro, reporte e investigación de las enfermedades laborales, incidentes y accidentes del trabajo (5%)", "id_padre" => 7, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "7777CCC", "texto" => "E3.3 Estándar: Mecanismos de vigilancia de las condiciones de salud de los trabajadores (6%)", "id_padre" => 7, "tipo" => 2, "estado" => 1 ],
			///////////////////
			[ "idx_encode" => "8888CCC", "texto" => "E4.1 Estándar: Identificación de peligros, evaluación y valoración de los riesgos (15%)", "id_padre" => 8, "tipo" => 2, "estado" => 1 ],
			[ "idx_encode" => "9999CCC", "texto" => "E4.2 Estándar: Medidas de prevención y control para intervenir los peligros/riesgos (15%)", "id_padre" => 8, "tipo" => 2, "estado" => 1 ],
			///////////////////
			
			// Estandar 5 no tiene subsecciones
			
			/////////////////
			[ "idx_encode" => "11111CC", "texto" => "E6.1 Estándar: Gestión y resultados del Sistema de Gestión de Seguridad y Salud en el Trabajo (5%)", "id_padre" => 10, "tipo" => 2, "estado" => 1 ],
			/////////////////
			[ "idx_encode" => "22222CC", "texto" => "E7.1 Estándar: Acciones preventivas y correctivas con base en los resultados del Sistema de Gestión de Seguridad y Salud en el Trabajo. (10%)", "id_padre" => 11, "tipo" => 2, "estado" => 1 ]
		];
		
		$this->execute("TRUNCATE TABLE diag_catalogos;");
		
		$this->insert('diag_catalogos', $rows);
	}
}
