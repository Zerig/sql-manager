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

This method takes SQL command and send it to DB.
```php
$data = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
	WHERE id = 1
");
```
