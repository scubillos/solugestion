<?php
namespace Base;

class Session{
	public function __construct(){}
	
	public function verifySession(){
		session_start();
		if(!isset($_SESSION["idbin"])){
			session_destroy();
			return false;
		}
		return true;
	}
	
	public function destroySession(){
		session_start();
		
		session_destroy();
		return true;
	}
	
	public function varSession_set($nameVar,$valueVar){
		session_start();
		$_SESSION[$nameVar] = $valueVar;
	}
	
	public function varSession_get($nameVar){
		session_start();
		return $_SESSION[$nameVar];
	}
	
	public function getVarsSession(){
		@session_start();
		$varsSession = [];
		foreach($_SESSION as $key => $value){
				$varsSession[$key] = $value;
		}
		return $varsSession;
	}
}
?>