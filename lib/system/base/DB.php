<?php
namespace Base;

class DB{
	private function __construct(){}
	
	private static function connection(){
		require(APP_PATH."/config/database.php");
		
		$connection = null;
		try{
			$connection = new \PDO("mysql:host=".$database["HOST"].";dbname=".$database["DB_NAME"],$database["USER"],$database["PASSWORD"]);
		}catch(\PDOException $e){
			die($e->getMessage());
		}
		
		return $connection;
	}
	
	public static function query($sql,$params = []){
		$statement = static::connection();
		try{
			$prepareStatement = $statement->prepare($sql);
			
			$statement->beginTransaction();
			
			$prepareStatement->execute($params);
			$result = [];
			if(static::verifyStatusExecute($prepareStatement)){				
				$result = $prepareStatement->fetchAll();
			}
			$statement->commit();
		}catch(\PDOException $e){
			$statement->rollback();
			die($e->getMessage());
		}
		return $result;
	}
	
	public static function insert($sql,$params = []){
		$lastInsertId = 0;
		$statement = static::connection();
		try{
			$prepareStatement = $statement->prepare($sql);
			$statement->beginTransaction();
			$prepareStatement->execute($params);
			
			if(static::verifyStatusExecute($prepareStatement)){
				$lastInsertId = $statement->lastInsertId();
			}
			$statement->commit();
		}catch(\PDOException $e){
			$statement->rollback();
			die($e->getMessage());
		}
		return $lastInsertId;
	}
	
	public static function update($sql,$params = []){
		$statement = static::connection();
		try{
			$prepareStatement = $statement->prepare($sql);
			$statement->beginTransaction();
			$prepareStatement->execute($params);
			
			if(static::verifyStatusExecute($prepareStatement)){
				$lastInsertId = $statement->lastInsertId();
			}
			$statement->commit();
		}catch(\PDOException $e){
			$statement->rollback();
			die($e->getMessage());
		}
		return $lastInsertId;
	}
	
	/*
	Verificaciones
	*/
	
	
	public static function verifyStatusExecute($prepareStatement){
		$status = $prepareStatement->errorInfo();
		if(is_array($status) AND count($status)!=0){
			if($status[0]!="00000"){
				throw new \Exception("Error #".$status[0]." => ".$status[2]);
			}
		}
		return true;
	}
}
?>