<?php
namespace SqlManager;

class MR extends \mysqli_result{
	public $current_field;
	public $field_count;
	public $lengths;
	public $num_rows;

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
