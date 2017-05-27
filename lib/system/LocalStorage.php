<?php
namespace Base;

class LocalStorage{
	
	public $items = [];
	
	public function setItem($name,$value){
		
		$this->items[$name] = $value;
		
		$HTML = '<script type="text/javascript" >';		
		$HTML .= 'localStorage.setItem("'.$name.'","'.$value.'");';
		$HTML .= '</script>';
		echo $HTML;
	}
	
}
?>