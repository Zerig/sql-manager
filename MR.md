## SQL MANAGER \ MR
- extends [**\mysqli_result**](https://www.php.net/manual/en/class.mysqli-result.php)

This class works with **MYSQL RESULT** data. Usually from SELECT. Contains result data.
```php
public $key = [];          // array of all columns from query result
public $array_data = [];   // array of stdClass
```
\n
You usually don´t create MR on your own. Class [SqlManager\Mysql](https://github.com/Zerig/sql-manager/blob/master/MYSQL.md#querysql) create it when *sql query* returns results => db rows.
```php
$mr_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");

// RESULTS ↓
$mr_man->key => [
	[0] => "id",
	[1] => "name",
	[2] => "age"
]
$mr_man->array_data => [
	[0] => stdClass(
			[id]   => 1,
			[name] => "Jeronym",
			[age]  => 28
	),
	[1] => stdClass(
			[id]   => 2,
			[name] => "Rachel",
			[age]  => 17
	),
	[2] => stdClass(
			[id]   => 3,
			[name] => "Benjamin",
			[age]  => 13
	)
]
```
<br>
<hr>
<br>

## get_objects()
- @return [array of stdClass]

This method return data as array of stdClass.
```php
$mr_man->get_objects() => [
	[0] => stdClass(
			[id]   => 1,
			[name] => "Jeronym",
			[age]  => 28
	),
	[1] => stdClass(
			[id]   => 2,
			[name] => "Rachel",
			[age]  => 17
	),
	[2] => stdClass(
			[id]   => 3,
			[name] => "Benjamin",
			[age]  => 13
	)
]

// IF YOU WANT GET SELECTED QUERY DATA USE THIS:
foreach($mr_man->get_objects() as $man){
	echo $man->name." - ".$man->age."\n";
}
```


## get_arrays()
- @return [array of stdClass]

This method return data as array of stdClass.
```php
$mr_man->get_arrays() => [
	[0] => [
			[id]   => 1,
			[name] => "Jeronym",
			[age]  => 28
	],
	[1] => [
			[id]   => 2,
			[name] => "Rachel",
			[age]  => 17
	],
	[2] => [
			[id]   => 3,
			[name] => "Benjamin",
			[age]  => 13
	]
]

// IF YOU WANT GET SELECTED QUERY DATA USE THIS:
foreach($mr_man->get_arrays() as $man){
	echo $man["name"]." - ".$man["age"]."\n";
}
```

<hr>

## get_object($i = 0)
- **$i [num]** which object in order of array you get
- @return [stdClass]

This method return one sql row in instance of *stdClass*. You can choose which one you want from result.
- **$i = 0** returns first
- **$i = 1** returns second
- **$i = -1** returns last
- **$i = -2** returns item before the last
```php
$mr_man->get_object(0) => stdClass(
		[id]   => 1,
		[name] => "Jeronym",
		[age]  => 28
)

$mr_man->get_object(1) => stdClass(
		[id]   => 2,
		[name] => "Rachel",
		[age]  => 17
)

$mr_man->get_object(-1) => stdClass(
		[id]   => 3,
		[name] => "Benjamin",
		[age]  => 13
)

$mr_man->get_object(-2) => stdClass(
		[id]   => 2,
		[name] => "Rachel",
		[age]  => 17
)

```

## get_array($i = 0)
- **$i [num]** which object in order of array you get
- @return [array]

This method return one sql row in *array*. You can choose which one you want from result.
- **$i = 0** returns first
- **$i = 1** returns second
- **$i = -1** returns last
- **$i = -2** returns item before the last
```php
$mr_man->get_arrayt(0) => [
		[id]   => 1,
		[name] => "Jeronym",
		[age]  => 28
]

$mr_man->get_arrayt(1) => [
		[id]   => 2,
		[name] => "Rachel",
		[age]  => 17
]

$mr_man->get_arrayt(-1) => [
		[id]   => 3,
		[name] => "Benjamin",
		[age]  => 13
]

$mr_man->get_arrayt(-2) => [
		[id]   => 2,
		[name] => "Rachel",
		[age]  => 17
]

```
