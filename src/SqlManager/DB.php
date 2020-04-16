<?php
namespace SqlManager;

class DB{

	// generate class from arrays values
	public function __construct(Array $properties=array()){
		foreach($properties as $key => $value){
			$this->{$key} = $value;
		}
	}

	public function one(){}
	public function groupedBy(){}


}
