## SQL MANAGER \ MR
- extends [**\mysqli_result**](https://www.php.net/manual/en/class.mysqli-result.php)

This class works with **MYSQL RESULT** data. Usually from SELECT. Contains result data.

```php
$array_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");

$array_man->get_objects() => [
	[0] => stdClass [
			[id]   => 1,
			[name] => "Jeroným",
			[age]  => 28
	],
	[1] => stdClass [
			[id]   => 2,
			[name] => "Ráchel",
			[age]  => 17
	],
	[2] => stdClass [
			[id]   => 3,
			[name] => "Benjamin",
			[age]  => 13
	]
]

foreach($array_man->get_objects() as $man){
	echo $man->name."\n";
}

```
