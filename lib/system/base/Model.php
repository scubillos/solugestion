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
	
	// Consultas
	public static function find($keyValue){
		$model = new static();
		
		$sql = "select * from ".$model->table." where ".$model->primaryKey." = :key ";
		$params = [":key" => $keyValue ];
		$result = DB::query($sql,$params);
		foreach($result as $key => $value){
			if(in_array($key,$model->fields)){
				$model->$key = $value;
			}
		}
		return $model;
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
				/*foreach($value as $operator => $val){
					$where .= "(".$field." ".$operator." :".$field.")";
					$params[$field] = $val;
				}*/
			}else{
				$where .= "(".$field." = :".$field.")";
				$params[$field] = $value;
			}
		}
		
		$sql = "select * from ".$model->table." where ".$where;
		
		$result = DB::query($sql,$params);
		
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
		
		$stringFields = implode(",",$fields);
		$stringHidden = implode(",:",$fields);
		
		$sql = "insert into ".$model->table." (".$stringFields.") values (:".$stringHidden.") ";
		//die($sql);
		$lastInsertId = DB::insert($sql,$data);
		
		$result = $model->find($lastInsertId);
		return $result;
	}
	
	// Update
	public static function update($data = []){
		$model = new static();
		
		$fieldUpdated = 0;
		$updates = [];
		foreach($data as $field => $value){
			$fields[] = $field."=':".$field."'";
			if($field == "updated"){
				$fieldUpdated++;
			}
		}
		
		//updated
		if($fieldUpdated == 0){
			$fields[] = "updated = :updated";
			$data["updated"] = date("Y-m-d H:i:s");
		}
		
		$stringUpdates = implode(",",$updates);
		
		$sql = "update ".$model->table." set ".$stringUpdates." where ".$model->primaryKey." = ':".$model->primaryKey."' ";
		var_dump($model);die;
		$modelArray = (array)$model;
		var_dump($modelArray);die;
		$data[$model->primaryKey] = $modelArray[$model->primaryKey];
		die($sql);
		$lastInsertId = DB::update($sql,$data);
		
		$result = $model->find($model[$model->primaryKey]);
		return $result;
	}
	
	// Funcion ToArray para convertir el objeto en un arreglo
	public function toArray(){
		return json_decode(json_encode($this->rows), true);
	}
}

?>