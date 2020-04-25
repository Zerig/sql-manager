<?php
namespace SqlManager;

class MR extends \mysqli_result{
	public $key = [];

	public $array_data = [];


	// IT SET PARENT CLASS RIGHT
	public function fetch_objects()
    {
        $rows = array();
        while($row = $this->fetch_object())
        {
            $rows[$row->id] = $row;

        }
        return $rows;
    }

	public function setData(){
		while($db=parent::fetch_object()){
			$this->array_data[] = $db;
		}
		// get keys
		$this->key = array_keys( (array) end($this->array_data) );

		return $this->array_data;
	}






	public function get_objects(){
		return $this->array_data;
	}

	public function get_arrays(){
		$array_data = [];
		foreach($this->array_data as $obj){
			$array_data[] = (array) $obj;
		}
		return $array_data;
	}






	public function get_array($i = 0){
		$i = ($i < 0)? $this->num_rows + $i : $i;
		return (empty($this->array_data))? NULL : (array) $this->array_data[$i];
	}

	public function get_object($i = 0){
		$i = ($i < 0)? $this->num_rows + $i : $i;
		return (empty($this->array_data))? NULL : $this->array_data[$i];
	}



	/*public function __construct(Array $properties=array()){
		foreach($properties as $key => $value){
			if(!is_numeric($key)){
				$this->{$key} = $value;

				$this->key[] = $key;
				$this->val[] = $value;
			}
		}
	}*/

}
