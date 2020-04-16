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
- @return [boolean / array of \SqlManager\DB]

This method takes SQL command and send it to DB. It is possible to use it for any SQL command for example:<br>
SELECT / INSERT / UPDATE / DELETE / CREATE<br>
```php
$GLOBALS["mysql"]->query(" INSERT INTO man (name, age) VALUES ('John', '28'); ");
```
But **SELECT** is special! because this method can work with data from DB. Load them like array of obj DB.
```php
$array_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");

foreach($array_man as $man){
	$array->namespace	=> "John"
	$array->age 		=> "28"
}

```


## insert($table, $array_items)
- $table [string]
- $array_items [key array]
- @return [boolean]

INSERT new row in $table created from data in $array_item.

```php
$GLOBALS["mysql"]->insert("man", [
	"name"	=> "Karel",
	"age"	=> "54"
]);


$GLOBALS["mysql"]->insert("man", $_POST["man"]);
```
