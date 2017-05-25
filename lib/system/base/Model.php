<?php

/***
 Clase Base para los modelos, contendra funciones fundamentales para el uso del mismo tales como:
	- Conexion a base de datos
 Las siguientes constantes ya se encuentran presentes en este paso:
	 - APP_PATH = Path del aplicativo (Controladores, Vistas, Modelos)
	 - SYS_PATH = Path del sistema
***/

namespace Base;

class Model{
	// Variables necesarias para realizar consultas y operaciones con la tabla
	protected $table = "";
	protected $primaryKey = "id";
	protected $fields = [];
	protected $rows = [];
	protected $onlyOne = false;
	protected $executing = 0;
	protected $sqlSelect = [];
	protected $relationsSelect = [];
	protected $currentRelation = "";
	
	// Escribir una consulta completa
	public static function rawQuery($sql){
		$model = new static();
		
		$result = DB::query($sql);
		foreach($result as $key => $value){
			if(in_array($key,$model->fields)){
				$model->$key = $value;
			}
		}
		return $model;
	}
	
	// Consultas
	public static function find($keyValue){
		$model = new static();
		
		$result = $model->select("*")->where([$model->primaryKey => $keyValue])->get();
		$result->onlyOne = true;
		return $result;
	}
	public static function findByIdx($keyValue){
		$model = new static();
		
		$result = $model->select("*")->where(["idx_encode" => $keyValue])->get();
		$result->onlyOne = true;
		return $result;
	}
	public static function select($data){
		$model = new static();
		$model->executing = 1;
		$model->sqlSelect = [ "fields" => [], "where" => [], "params" => [], "additional" => [ "groupBy" => [], "orderBy" => [], "limit" => 0, "offset" => 0 ] ];
		
		if(!is_array($data)){
			$model->sqlSelect["fields"][] = $data;
		}else{
			foreach($data as $field){
				$model->sqlSelect["fields"][] = $field;
			}
		}
		return $model;
	}
	public function where($fieldC,$operation = "",$val = ""){
		
		if(isset($this) AND $this->executing == 1){
			$model = $this;
		}else{
			$model = new static();
			$model->executing = 1;
			$model->sqlSelect = [ "fields" => [ "*" ], "where" => [], "params" => [], "additional" => [ "groupBy" => [], "orderBy" => [], "limit" => 0, "offset" => 0 ] ];
		}
		
		$params = $model->sqlSelect["params"];
		if(is_array($fieldC)){
			$data = $fieldC;
			foreach($data as $field => $value){
				if(is_array($value)){
					$model->sqlSelect["where"][$field] = " ".$value[0]." :".$field." ";
					$params[":".$field] = $value[1];
				}else{
					$model->sqlSelect["where"][$field] = " = :".$field." ";
					$params[":".$field] = $value;
				}
			}
		}else{
			// solo se iguala
			if($val == ""){
				$model->sqlSelect["where"][$fieldC] = " = :".$fieldC." ";
				$params[":".$fieldC] = $operation;
			}else{
				$model->sqlSelect["where"][$fieldC] = " ".$operation." :".$fieldC." ";
				$params[":".$fieldC] = $val;
			}
		}
		$model->sqlSelect["params"] = $params;
		
		return $model;
	}
	public function groupBy($data){
		if(!isset($this)){
			throw new \Exception("Error group by clause!!!. Uninitialized query");
		}
		if($this->executing != 1){
			throw new \Exception("Error group by clause!!!. First run a query");
		}
		
		$model = $this;
		if(!is_array($data)){
			$model->sqlSelect["additional"]["groupBy"][] = $data;
		}else{
			foreach($data as $field){
				$model->sqlSelect["additional"]["groupBy"][] = $field;
			}
		}
		return $model;
	}
	public function orderBy($data){
		if(!isset($this)){
			throw new \Exception("Error order by clause!!!. Uninitialized query");
		}
		if($this->executing != 1){
			throw new \Exception("Error order by clause!!!. First run a query");
		}
		
		$model = $this;
		if(!is_array($data)){
			$model->sqlSelect["additional"]["groupBy"][] = $data;
		}else{
			foreach($data as $field){
				$model->sqlSelect["additional"]["groupBy"][] = $field;
			}
		}
		return $model;
	}
	public function limit($limit){
		if(!isset($this)){
			throw new \Exception("Error limit clause!!!. Uninitialized query");
		}
		if($this->executing != 1){
			throw new \Exception("Error limit clause!!!. First run a query");
		}
		
		$model = $this;
		$model->sqlSelect["additional"]["limit"][] = $limit;
		
		return $model;
	}
	public function offset($offset){
		if(!isset($this)){
			throw new \Exception("Error offset clause!!!. Uninitialized query");
		}
		if($this->executing != 1){
			throw new \Exception("Error offset clause!!!. First run a query");
		}
		
		$model = $this;
		$model->sqlSelect["additional"]["offset"][] = $offset;
		
		return $model;
	}
	//Relaciones
	public function relations($data){
		if(!isset($this)){
			throw new \Exception("Error getting relations!!!. Uninitialized query");
		}
		if($this->executing != 1){
			throw new \Exception("Error getting relations!!!. First run a query");
		}
		
		$model = $this;
		$model->relationsSelect = [];
		if(!is_array($data)){
			$model->relationsSelect[] = $data;
		}else{
			foreach($data as $relation){
				$model->relationsSelect[] = $relation;
			}
		}
		return $model;
	}
	public function get(){
		if(!isset($this)){
			throw new \Exception("Error offset clause!!!. Uninitialized query");
		}
		if($this->executing != 1){
			throw new \Exception("Error offset clause!!!. First run a query");
		}
		$model = $this;
		
		$sqlSelect = $model->sqlSelect;
		$sql = "";
		
		//Campos seleccionados
		$fields = implode(",",$sqlSelect["fields"]);
		
		//Se arma el query base
		$sql = "SELECT ".$fields." FROM ".$model->table;
		
		// condiciones where
		if(count($sqlSelect["where"]) != 0){
			$where = "where ";
			$count = 0;
			foreach($sqlSelect["where"] as $field => $value ){
				if($count != 0){
					$where .= " AND ";
				}
				$where .= $field." ".$value;
				$count++;
			}
			$sql .= " ".$where;
		}
		
		// additionals
		$additional = $sqlSelect["additional"];
		// group by
		if(count($additional["groupBy"]) != 0){
			$groupBy = implode(",",$additional["groupBy"]);
			
			$sql .= " GROUP BY ".$groupBy;
		}
		// order by
		if(count($additional["orderBy"]) != 0){
			$orderBy = implode(",",$additional["orderBy"]);
			
			$sql .= " ORDER BY ".$orderBy;
		}
		// limit
		if($additional["limit"] != 0){
			$limit = $additional["limit"];
			$sql .= " LIMIT ".$limit;
		}
		// offset
		if($additional["offset"] != 0){
			$offset = $additional["offset"];
			$sql .= " OFFSET ".$offset;
		}
		// parametros
		$params = $sqlSelect["params"];

		// Se ejecuta el query
		$result = DB::query($sql,$params);
		
		if(!in_array("created",$model->fields)){
			$model->fields[] = "created";
		}
		if(!in_array("updated",$model->fields)){
			$model->fields[] = "updated";
		}
		if(!in_array("idx_encode",$model->fields)){
			$model->fields[] = "idx_encode";
		}
		
		//Se obtiene la info para el atributo rows
		if(is_object($result)){
			$model->rows[0] = (object)[];
			foreach($result as $key => $value){
				if(in_array($key,$model->fields)){
					$model->$key = $value;
					$model->rows[0]->$key = $value;
				}
			}
		}else if(is_array($result)){
			$k = 0;
			foreach($result as $row){
				foreach($row as $key => $value){
					if(in_array($key,$model->fields) AND $key!="0"){
						if(!isset($model->rows[$k]) OR !is_object($model->rows[$k])){
							$model->rows[$k] = (object)[];
						}
						$model->rows[$k]->$key = $value;
					}
				}
				$k++;
			}
		}
		
		//Se obtienen las relaciones
		$relations = $model->relationsSelect;
		if(count($relations) != 0){
			foreach($relations as $relation){
				if( method_exists($model,$relation) ){
					$model->currentRelation = $relation;
					$model->$relation();
				}
			}
		}
		
		$model->executing = 2;
		unset($model->sqlSelect);
		return $model;
	}
	
	public function toSql(){
		if(!isset($this)){
			throw new \Exception("Error offset clause!!!. Uninitialized query");
		}
		if($this->executing != 1){
			throw new \Exception("Error offset clause!!!. First run a query");
		}
		$model = $this;
		
		$sqlSelect = $model->sqlSelect;
		$sql = "";
		
		//Campos seleccionados
		$fields = implode(",",$sqlSelect["fields"]);
		
		//Se arma el query base
		$sql = "SELECT ".$fields." FROM ".$model->table;
		
		// condiciones where
		if(count($sqlSelect["where"]) != 0){
			$where = "where ";
			$count = 0;
			foreach($sqlSelect["where"] as $field => $value ){
				if($count != 0){
					$where .= " AND ";
				}
				$where .= $field." ".$value;
				$count++;
			}
			$sql .= " ".$where;
		}
		
		// additionals
		$additional = $sqlSelect["additional"];
		// group by
		if(count($additional["groupBy"]) != 0){
			$groupBy = implode(",",$additional["groupBy"]);
			
			$sql .= " GROUP BY ".$groupBy;
		}
		// order by
		if(count($additional["orderBy"]) != 0){
			$orderBy = implode(",",$additional["orderBy"]);
			
			$sql .= " ORDER BY ".$orderBy;
		}
		// limit
		if($additional["limit"] != 0){
			$limit = $additional["limit"];
			$sql .= " LIMIT ".$limit;
		}
		// offset
		if($additional["offset"] != 0){
			$offset = $additional["offset"];
			$sql .= " OFFSET ".$offset;
		}
		
		die($sql);
	}
	
	// Funcion ToArray para convertir el objeto en un arreglo
	public function toArray(){
		
		
		if(!isset($this)){
			throw new \Exception("Error array coversion!!!. Uninitialized query");
		}
		if($this->executing == 0){
			throw new \Exception("Error array coversion!!!. First run a query");
		}
		if($this->executing == 1){
			$this->get();
		}
		if(count($this->rows)==0){
			return NULL;
		}
		if($this->onlyOne == false){
			return json_decode(json_encode($this->rows), true);
		}else{
			return json_decode(json_encode($this->rows[0]), true);
		}
	}
	
	// Insert
	public static function insert($data = []){
		$model = new static();
		
		$fields = [];
		foreach($data as $field => $value){
			$fields[] = $field;
		}
		
		//created
		if(!in_array("created",$fields)){
			$fields[] = "created";
			$data["created"] = date("Y-m-d H:i:s");
		}
		//Id unico para toda la base de datos codificado
		$id_unique_db = static::increment_counter();
		$fields[] = "idx_encode";
		$data["idx_encode"] = md5($id_unique_db);
		
		$stringFields = implode(",",$fields);
		$stringHidden = implode(",:",$fields);
		
		$sql = "insert into ".$model->table." (".$stringFields.") values (:".$stringHidden.") ";
		//die($sql);
		
		$lastInsertId = DB::insert($sql,$data);
		
		$result = $model->find($lastInsertId);
		return $result;
	}
	
	// Update
	public function update($data = []){
		if(count($this->rows) == 1){
			$fieldUpdated = 0;
			$fields = [];
			foreach($data as $field => $value){
				$fields[] = $field." = :".$field." ";
				if($field == "updated"){
					$fieldUpdated++;
				}
			}
			
			//updated
			if($fieldUpdated == 0){
				$fields[] = "updated = :updated";
				$data["updated"] = date("Y-m-d H:i:s");
			}
			
			$stringUpdates = implode(",",$fields);
			
			$sql = "update ".$this->table." set ".$stringUpdates." where ".$this->primaryKey." = :".$this->primaryKey." ";
			
			$row = json_decode(json_encode($this->rows[0]), true);
			
			$data[$this->primaryKey] = $row[$this->primaryKey];
			$lastInsertId = DB::update($sql,$data);
			
			$result = $this->find($row[$this->primaryKey]);
		}
		return $result;
	}
	
	// Borrar datos
	public function delete($fieldC,$operation = "",$val = ""){
		$model = new static();
		
		$fields = [];
		$params = [];
		if(is_array($fieldC)){
			$data = $fieldC;
			foreach($data as $field => $value){
				if(is_array($value)){
					$fields[$field] = " ".$value[0]." :".$field." ";
					$params[":".$field] = $value[1];
				}else{
					$fields[$field] = " = :".$field." ";
					$params[":".$field] = $value;
				}
			}
		}else{
			// solo se iguala
			if($val == ""){
				$fields[$fieldC] = " = :".$fieldC." ";
				$params[":".$fieldC] = $operation;
			}else{
				$fields[$fieldC] = " ".$operation." :".$fieldC." ";
				$params[":".$fieldC] = $val;
			}
		}
		
		$sql = "DELETE FROM ".$model->table." ";
		
		// condiciones where
		if(count($fields) != 0){
			$where = "WHERE ";
			$count = 0;
			foreach($fields as $field => $value ){
				if($count != 0){
					$where .= " AND ";
				}
				$where .= $field." ".$value;
				$count++;
			}
			$sql .= " ".$where;
		}
		
		$result = DB::query($sql,$params);
		
		return $result;
	}
	
	// Relaciones
	// Uno a muchos
	public function oneMany($tableRelation,$tableField,$relField){
		$model = $this;
		$nameRel = $this->currentRelation;
		for($i=0; $i < count($model->rows); $i++){
			$modelRel = new static();
			$modelRel->table = $tableRelation;
			$modelRel->executing = 1;
			$modelRel->sqlSelect = [ "fields" => [ "*" ], "where" => [], "params" => [] ];
			
			$row = $model->rows[$i];
			
			$valLocal = $row->$relField;
			$oneManyRes = $modelRel->where($tableField,$valLocal)->getRel()->toArray();
			if(count($modelRel->rows)!=0){				
				$model->rows[$i]->$nameRel = $oneManyRes;
			}
		}
		
		return $model;
	}
	public function getRel(){
		if(!isset($this)){
			throw new \Exception("Error offset clause!!!. Uninitialized query");
		}
		if($this->executing != 1){
			throw new \Exception("Error offset clause!!!. First run a query");
		}
		$model = $this;
		
		$sqlSelect = $model->sqlSelect;
		$sql = "";
		
		//Campos seleccionados
		$fields = implode(",",$sqlSelect["fields"]);
		
		//Se arma el query base
		$sql = "SELECT ".$fields." FROM ".$model->table;
		
		// condiciones where
		if(count($sqlSelect["where"]) != 0){
			$where = "where ";
			$count = 0;
			foreach($sqlSelect["where"] as $field => $value ){
				if($count != 0){
					$where .= " AND ";
				}
				$where .= $field." ".$value;
				$count++;
			}
			$sql .= " ".$where;
		}
		// parametros
		$params = $sqlSelect["params"];
		
		// Se ejecuta el query
		$result = DB::query($sql,$params);
		
		//Se obtiene la info para el atributo rows
		if(is_object($result)){
			$model->rows[0] = (object)[];
			foreach($result as $key => $value){
				$model->$key = $value;
				$model->rows[0]->$key = $value;
			}
		}else if(is_array($result)){
			$k = 0;
			foreach($result as $row){
				foreach($row as $key => $value){
					if(!isset($model->rows[$k]) OR !is_object($model->rows[$k])){
						$model->rows[$k] = (object)[];
					}
					$model->rows[$k]->$key = $value;
				}
				$k++;
			}
		}
		
		$model->executing = 2;
		unset($model->sqlSelect);
		return $model;
	}
	
	/* 
	Incrementador de id, contador general de todos los registros de la base de datos. 
	Cada registro en toda la base de datos contiene este id encriptado en md5 para el campo idx_encode
	*/
	static function increment_counter(){
		
		$data["created"] = date("Y-m-d H:i:s");
		
		$sql = "insert into ac_counter (created) values (:created) ";
		
		$last = DB::insert($sql,$data);
		$dataDel["id"] = $last;
		DB::query("delete from ac_counter where id < :id ",$dataDel);
		
		return $last;
	}
}

?>