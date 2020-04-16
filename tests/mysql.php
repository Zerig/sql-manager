<code style="white-space: pre;">
<?php
include_once "../src/SqlManager/Mysql.php";
include_once "../src/SqlManager/DB.php";

include_once "../src/FCE/Str.php";
include_once "../src/FCE/Date.php";


// Create connection
$GLOBALS["mysql"] = new \SqlManager\Mysql([
	"server_name"	=> "localhost",
	"db_user"		=> "root",
	"db_pass"		=> "",
	"db_name"		=> "test"
]);


$data = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
	WHERE id = 1
");

echo print_r($data);


$GLOBALS["mysql"]->insert("man", [
	"name"	=> "Karel",
	"age"	=> "54"
]);
