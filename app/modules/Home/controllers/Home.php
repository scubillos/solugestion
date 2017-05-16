<?php
use Base\Controller as Controller;

class Home Extends Controller{
	public $titlePage = "Login"; //Para el titulo de la pagina
	
	public function __construct(){
		parent::__construct();
	}
	
	public function Index(){
		$this->RenderView("Home/Index");
	}
	
	public function Info(){
		$this->AddJS('modules/Login/assets/js/prueba.js');
		
		$this->RenderView();
	}
	
}

?>