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
	
	// Consultas
	/*public static function find($keyValue){
		$model = new static();
		
		$sql = "select * from ".$model->table." where ".$model->primaryKey." = :key ";
		$params = [":key" => $keyValue ];
		$result = DB::query($sql,$params);
		foreach($result as $key => $value){
			if(in_array($key,$model->fields)){
				$model->$key = $value;
				$model->rows[0][$key] = $value;
			}
		}
		return $model;
	}
	// Consultas por idx_encode
	public static function findByIdx($keyValue){
		$model = new static();
		
		$sql = "select * from ".$model->table." where idx_encode = :key ";		
		$params = [":key" => $keyValue ];
		$result = DB::query($sql,$params);
		foreach($result as $key => $value){
			if(in_array($key,$model->fields)){
				$model->$key = $value;
				$model->rows[0][$key] = $value;
			}
		}
		return $model;
	}*/
	public static function find($keyValue){
		$model = new static();
		
		$result = $model->where([$model->primaryKey => $keyValue]);
		$result->onlyOne = true;
		return $result;
	}
	public static function findByIdx($keyValue){
		$model = new static();
		
		$result = $model->where(["idx_encode" => $keyValue]);
		$result->onlyOne = true;
		return $result;
	}
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
	public static function where($data = []){
		$model = new static();
		
		$params = [];
		$where = "";
		foreach($data as $field => $value){
			if($where!=""){
				$where .= " AND ";
			}
			
			if(is_array($value)){
				$where .= "(".$field." ".$value[0]." :".$field.")";
				$params[$field] = $value[1];
			}else{
				$where .= "(".$field." = :".$field.")";
				$params[$field] = $value;
			}
		}
		
		$sql = "select * from ".$model->table." where ".$where;
		
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
		
		return $model;
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
	
	// Funcion ToArray para convertir el objeto en un arreglo
	public function toArray(){
		if($this->onlyOne == false){
			return json_decode(json_encode($this->rows), true);
		}else{
			return json_decode(json_encode($this->rows[0]), true);
		}
	}
	
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