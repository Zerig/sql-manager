## SQL MANAGER \ MR
- extends [**\mysqli_result**](https://www.php.net/manual/en/class.mysqli-result.php)

This class works with **MYSQL RESULT** data. Usually from SELECT. Contains result data.
```php
public $key = [];			// array of all columns from query result
public $array_data = [];	// array of stdClass
```
You dont create MR on your own. Class [SqlManager\Mysql](https://github.com/Zerig/sql-manager/blob/master/MYSQL.md#querysql) create it when *sql query* returns results => db rows.
```php
$array_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");

// RESULTS ↓
$array_man->key => [
	[0] => "id",
	[1] => "name",
	[2] => "age"
]
$array_man->get_objects() => [
	[0] => stdClass [
			[id]   => 1,
			[name] => "Jeronym",
			[age]  => 28
	],
	[1] => stdClass [
			[id]   => 2,
			[name] => "Rachel",
			[age]  => 17
	],
	[2] => stdClass [
			[id]   => 3,
			[name] => "Benjamin",
			[age]  => 13
	]
]


// IF YOU WANT GET SELECTED QUERY DATA USE THIS:
foreach($array_man->get_objects() as $man){
	echo $man->name." - ".$man->age."\n";
}

```
