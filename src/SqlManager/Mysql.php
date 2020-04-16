<?php
namespace SqlManager;

class Mysql extends \Mysqli{
	public $localData;		// array of data for local Mysqli connection
	public $serverData;		// array of data for server Mysqli connection
	public $mysqli;			// class Mysqli

	public $sql;			// array of all mysql sql call;
	public $data;			// array of all get data from DB


	public function __construct($serverData, $localData = null){
		$this->serverData = $serverData;
		$this->localData = (is_array($localData))? $localData : $serverData;

		self::connect();
		parent::set_charset("utf8");

		return parent::ping();
	}

	public function connect(){
		if($_SERVER['REMOTE_ADDR']=='::1'){
			$this->mysqli = parent::__construct($this->localData['server_name'], $this->localData['db_user'], $this->localData['db_pass'], $this->localData['db_name']);
		}else{
			$this->mysqli = parent::__construct($this->serverData['server_name'], $this->serverData['db_user'], $this->serverData['db_pass'], $this->serverData['db_name']);
		}
	}



	public function query($sql){
		$db_data = parent::query($sql);

		$array_data = array();

		// SELECT RETURNS object of rows //
		if(is_object($db_data)){
	 		while($db=mysqli_fetch_array($db_data)){
	 			array_push($array_data, new DB($db));
	 		}
			return $array_data;

		// OTHER commands RETURN BOOLEAN //
	 	}else{
			return $db_data;
		}
	}




	public function insert($table, $array_items){
		$sql = "INSERT INTO ".$table." ";
		$array_items = \FCE\Str::apostrophe_replacer($array_items);	// sort problem with apostrophes

		// KEYS: ( key1, key2, key3 )
		$sql .= "( ";
		$i = 0;
		foreach($array_items as $k => $v){
			$sql .= ($i != 0) ? ', ' : '' ;
			$sql .= $k;
			$i++;
		}
		$sql .= " )";

		$sql .= " VALUES ";

		// VALUES: ( val1, val2, val3 )
		$sql .= "( ";
		$i = 0;
		foreach($array_items as $k => $v){
			$sql .= ($i != 0) ? ', ' : '' ;
			$sql .= "'".$v."'";
			$i++;
		}
		$sql .= " );";

		parent::query($sql);
	}
	public function update(){}
	public function upsert(){}
	public function delete(){}

	public function increment(){

	}




}
