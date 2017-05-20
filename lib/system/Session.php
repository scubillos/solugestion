<?php
namespace Base;

class Session{
	public function __construct(){
		session_start();
	}
	
	public function verifySession(){
		if(!isset($_SESSION["idhex"])){
			session_destroy();
			return false;
		}
		return true;
	}
	
	public function destroySession(){
		
		session_destroy();
		return true;
	}
	
	public function varSession_set($nameVar,$valueVar){
		$_SESSION[$nameVar] = $valueVar;
	}
	
	public function varSession_get($nameVar){
		return $_SESSION[$nameVar];
	}
	
	public function getVarsSession(){
		$varsSession = [];
		foreach($_SESSION as $key => $value){
				$varsSession[$key] = $value;
		}
		return $varsSession;
	}
}
?>