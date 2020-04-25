<?php
namespace SqlManager;

class Mysql extends \Mysqli{
	public $mysqli;			// class Mysqli

	public $server_name;		// server name
	public $db_user;			// DB user
	public $db_pass;			// DB password
	public $db_name;			// DB name

	public $sql;			// array of all mysql sql call;
	public $data;			// array of all get data from DB


	public function __construct($serverData, $localData = null){
		$localData = (is_array($localData))? $localData : $serverData;

		if($_SERVER['REMOTE_ADDR']=='::1')	self::setData($localData);
		else								self::setData($serverData);

		self::connect();
		parent::set_charset("utf8");

		return parent::ping();
	}

	public function connect(){
		$this->mysqli = parent::__construct($this->server_name, $this->db_user, $this->db_pass, $this->db_name);
	}

	private function setData(Array $properties){
		foreach($properties as $key => $value){
			$this->{$key} = $value;
		}
	}


	public function multi_query($multi_sql){
		$return = parent::multi_query($multi_sql);
		while (parent::next_result()) {;} // flush multi_queries

		return $return;
	}



	public function query($sql){
		$db_data = parent::query($sql);
		\Console\Log::mysql($sql);
		self::activity($sql);

		// SELECT RETURNS object of rows //
		if(is_a($db_data, "mysqli_result")){
			$this->real_query($sql);
			$mr = new MR($this);	// create my own class which extends "mysql_result"
			$mr->setData();			// set data to be permanent. NOT for one use

        	return $mr;
		}else{
			// For every cases which are NOT SELECT
			return $db_data;
		}
	}


	public function query_($sql){
		$mr_data = self::query($sql);

		if($mr_data->get_object()) 	return $mr_data->get_object();	// return SqlManager\MR
		else 						return null;
	}


	private function activity($sql){
		$GLOBALS["query"][] = $sql;

		$sql = str_replace("'", "&apos;", $sql);

		parent::query("
			DELETE FROM _activity
			ORDER BY datetime LIMIT 1;
		");

		parent::query("
			INSERT INTO _activity
			(query)
			VALUES ('".$sql."')
		");



	}



	/* MYSQL INSERT
	 * inster item into mysql DB
	 * "INSERT INTO menu ( rank, link ) VALUES ( '10', 'kontakt' )";
	 * insert("menu", array("rank"=>"10", "link"=>"llink2"))

	 * @table [string]					name of DB "menu"
	 * @array_items [key array]			values for input "array( 'rank'=>'10', 'link'=>'kontakt' )"

	 * @return [ obj Status ]			null if no problem / string if there is an error
	 */
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

		$sql .= "\r\nVALUES ";

		// VALUES: ( val1, val2, val3 )
		$sql .= "( ";
		$i = 0;
		foreach($array_items as $k => $v){
			$sql .= ($i != 0) ? ', ' : '' ;
			$sql .= "'".$v."'";
			$i++;
		}
		$sql .= " );";


		return self::query($sql);
	}



	/* MYSQL UPDATE
	 * insert item into mysql DB
	 * "UPDATE menu SET rank = '10', link = 'kontakt' WHERE id=21 AND link='info'";
	 * update("menu", array(
		 "rank" => "888",
		 "link" => "www"
	 ), "id=29");

	 * @db [string]						name of DB "menu"
	 * @array_items [array of pairs]	values for update "array( 'rank'=>'10', 'link'=>'kontakt' )"
	 * @where [string]					"id=21 AND link='info'"

	 * @return [ null / string]			null if no problem / string if there is an error
	 */
	public function update($db, $array_items, $where){
		$sql = "UPDATE ".$db." SET ";
		$array_items = \FCE\Str::apostrophe_replacer($array_items);	// sort problem with apostrophes

		$i = 0;
		foreach($array_items as $k => $v){
			//$v = str_replace(array("'", '"'), array("&apos;", "&quot;"), $v);
			// IF key doesn´t start on "!"
			if($k[0] != "!"){
				$sql .= ($i != 0) ? ', ' : '' ;

				if($v == "NULL"){
					$sql .= $k." = ".$v."";
				}else{
					$sql .= $k." = '".$v."'";
				}

				$i++;
			}
		}

		$sql .= "\r\nWHERE ".$where;

		return self::query($sql);
	}




	/* MYSQL UPSERT
	 * Update if exist / Insert if not
	 * upsert("menu", array("rank"=>"111", "id"=>"15"), "id=15");

	 * @db [string]						name of DB "menu"
	 * @array_items [array of pairs]	values for update "array( 'rank'=>'10', 'link'=>'kontakt' )"
	 * @where [string]					"id=21 AND link='info'"

	 * @return [ null / string]			null if no problem / string if there is an error
	 */
	public function upsert($db, $array_items, $where){
		if( self::exist("SELECT *	FROM ".$db." WHERE ".$where."") )	return self::update($db, $array_items, $where);
		else   															return self::insert($db, $array_items);
	}




	/* MYSQL DELETE
	 * inster item into mysql DB
	 * "INSERT INTO menu ( rank, link ) VALUES ( '10', 'kontakt' )";
	 * delete("menu", "id=36");

	 * @table [string]					name of DB "menu"
	 * @where [string]					"id=21 AND link='info'"

	 * @return [ obj Status ]			object which says what happened
	 */
	public function delete($table, $where){
		$sql = "DELETE FROM ".$table." ";
		$sql .= " WHERE ".$where;

		return self::query($sql);
	}


	public function deleteLast($table){
		$sql = "
			DELETE FROM ".$table."
			WHERE id = '".self::lastID($table)."'
		";

		return self::query($sql);
	}




	public function nextID($table){
		$sql = "
			SELECT  AUTO_INCREMENT
			FROM    information_schema.TABLES
			WHERE   (TABLE_NAME = '".$table."')
		";
		if(!self::exist($sql))	return null;

		$table = self::query_($sql);
		return $table->AUTO_INCREMENT;
	}


	public function lastID($table){
		$sql = "SELECT MAX(id) as last_id FROM ".$table."";
		if(!self::exist($sql))	return null;

		$table = self::query_($sql);
		return $table->last_id;
	}



	public function exist($sql){
		$response = parent::query($sql);

		return $response->num_rows > 0;
	}

}
