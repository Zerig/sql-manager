## SQL MANAGER \ MYSQL
- needs **\FCE\Str** class

This class connets to DB and work with it.<br>

First array is for connection on SERVER. The second one is use in LOCALHOST.
```php
$GLOBALS["mysql"] = new \SqlManager\Mysql([
	"server_name"	=> "sql.server.cz",
	"db_user"	=> "server_user",
	"db_pass"	=> "123456",
	"db_name"	=> "my_server_db"
],[
	"server_name"	=> "localhost",
	"db_user"	=> "root",
	"db_pass"	=> "123456",
	"db_name"	=> "my_local_db"
]);
```

When you use just one array. It will use the same data for SERVER and LOCAL.
```php
$GLOBALS["mysql"] = new \SqlManager\Mysql([
	"server_name"	=> "localhost",
	"db_user"	=> "root",
	"db_pass"	=> "123456",
	"db_name"	=> "test"
]);
```

<hr>

## query($sql)
- $sql [string]
- @return [boolean / array of \SqlManager\MR]

This method takes SQL command and send it to DB. It is possible to use it for any SQL command for example:<br>
SELECT / INSERT / UPDATE / DELETE / CREATE<br>
```php
$success = $GLOBALS["mysql"]->query(" INSERT INTO man (name, age) VALUES ('John', '28'); ");
$success => true // when everything is OK
```
But **SELECT** is special! because this method can work with data from DB. Load them like array of MR obj.
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


## query_($sql)
- **$sql [string]**				SQL command
- **@return [\SqlManager\MR]**	Just one OBJ

No matter what, you get only **first row** or **NULL**. This row is not in array, it is just *\SqlManager\MR* object.

```php
$_man = $GLOBALS["mysql"]->query_("
	SELECT *
	FROM man
");

$_man->name => "John"

```






## multi_query($sql)
- $sql [string]
- @return [boolean]

This method can create multiple SQL commands in ONE. They must be divided by ";". SO i it usefull for loading DB.
```php
$success = $GLOBALS["mysql"]->multi_query("
	-- Adminer 4.6.2 MySQL dump

	SET NAMES utf8;
	SET time_zone = '+00:00';
	SET foreign_key_checks = 0;
	SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

	DROP TABLE IF EXISTS `man`;
	CREATE TABLE `man` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(150) NOT NULL,
	  `age` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	INSERT INTO `man` (`id`, `name`, `age`) VALUES
	(1,	'Jeroným',	28),
	(2,	'Ráchel',	17),
	(3,	'Benjamin',	13),
	(4,	'Ludmila',	48),
	(5,	'Josef',	52),
	(6,	'Karel',	54),
	(11,	'Nym',	28);

	-- 2020-04-16 07:06:49
");

$success	=> true // when everything is OK
```

<br>
<hr>
<br>

## IDEAL HTML FORM
If you use this type of **form elements** name you can use easier way to send data through INSERT / UPDATE / UPSERT
```html
<form method="POST" name="man">
	<label>Name: </label>
	<input type="text" name="man['name']" value="<?= $_POST['man']['name'] ?>">
	<label>Age: </label>
	<input type="text" name="man['age']" value="<?= $_POST['man']['age'] ?>">

	<input type="submit" name="submit['man']" value="SUBMIT">
</form>
```
```php
if(isset($_POST["submit"]["man"])){
	$success = $GLOBALS["mysql"]->insert("man", $_POST["man"]);
	echo ($success)? "DATA WERE SUCCESSFULY SEND" : "SENDING DATA FAILS";
}
```
<br>
<hr>
<br>

## insert($table, $array_items)
- **$table [string]**				name of DB table "man"
- **$array_items [key array]**		values for update "array( 'age'=>'10', 'name'=>'Karel' )"
- @return [boolean]

INSERT new row in *$table* created from data in *$array_item*.

```php
// Both variant are possible
$GLOBALS["mysql"]->insert("man", $_POST["man"]);

$GLOBALS["mysql"]->insert("man", [
	"name"	=> "Karel",
	"age"	=> "54"
]);
```


## update($table, $array_items, $where)
* **$db [string]**					name of DB table "man"
* **$array_items [key array]**		values for update "array( 'age'=>'10', 'name'=>'Karel' )"
* **$where [string]**				"age=28 AND name='Carl'"
- @return [boolean]

UPDATE specific columns in row/rows in *$table* and choose them by *$where* parameters

```php
// Both variant are possible
$GLOBALS["mysql"]->update("man", $_POST["man"], "name = 'Karel'");

$GLOBALS["mysql"]->update("man", [
	"name"	=> "Karel",
	"age"	=> "54"
], "name = 'Karel'");
```




## upsert($table, $array_items, $where)
* **$db [string]**					name of DB table "man"
* **$array_items [key array]**		values for update "array( 'age'=>'10', 'name'=>'Karel' )"
* **$where [string]**				"age=28 AND name='Carl'"
- @return [boolean]

**UPDATE** : when row with specification in *$where* **EXIST**<br>
**INSERT** : when row with specification in *$where* **NOT EXIST**<br>
In every case you dont care if row exist or not, but after you have what you wanted.

```php
// Both variant are possible
$GLOBALS["mysql"]->upsert("man", $_POST["man"], "name = 'Karel'");

$GLOBALS["mysql"]->upsert("man", [
	"name"	=> "Karel",
	"age"	=> "54"
], "name = 'Karel'");
```




## delete($table, $where)
* **$table [string]** 			name of DB table "man"
* **$where [string]**			"age=28 AND name='Carl'"
- @return [boolean]

DELETE specific row/rows in *$table* and choose them by *$where* parameters

```php
$GLOBALS["mysql"]->delete("man", "name = 'Karel'");
$GLOBALS["mysql"]->delete("man", "name = 'Karel' AND age = 28");
```


## deleteLast($table)
* **$table [string]** 			name of DB table "man"
- @return [boolean]

DELETE **last** row in *$table*

```php
$GLOBALS["mysql"]->deleteLast("man");
```

<hr>


## exist($sql)
- $sql [string]
- @return [boolean]

Check if SQL command return data. If YES return *1*. If NOT return *0*

```php
$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Karel'")	=> 0

$GLOBALS["mysql"]->insert("man", ["name" => "Karel", "age" => "54" ]);
$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Karel'")	=> 1

```


## nextID($table)
- **$table [string]**	name of table
- @return [void]

Return next automatic increment of specicic *$table*

```php
$GLOBALS["mysql"]->increment("man")	=> 126
```

## lastID($table)
- **$table [string]**	name of table
- @return [void]

Return last given increment of specicic *$table*

```php
$GLOBALS["mysql"]->increment("man")	=> 125
```
