<?php
namespace SqlManager;

class RS{
	public $key = [];
	public $val = [];

	// generate class from arrays values
	public function __construct(Array $properties=array()){
		foreach($properties as $key => $value){
			if(!is_numeric($key)){
				$this->{$key} = $value;

				$this->key[] = $key;
				$this->val[] = $value;
			}
		}
	}

}
