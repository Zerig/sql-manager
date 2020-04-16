<code style="white-space: pre;">
<?php
include_once "../src/SqlManager/Mysql.php";
include_once "../src/SqlManager/RS.php";

include_once "../src/FCE/Str.php";
include_once "../src/FCE/Date.php";


// Create connection
$GLOBALS["mysql"] = new \SqlManager\Mysql([
	"server_name"	=> "localhost",
	"db_user"		=> "root",
	"db_pass"		=> "",
	"db_name"		=> "test"
]);


$msg = $GLOBALS["mysql"]->multi_query("
	-- Adminer 4.6.2 MySQL dump

	SET NAMES utf8;
	SET time_zone = '+00:00';
	SET foreign_key_checks = 0;
	SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

	DROP TABLE IF EXISTS `man`;
	CREATE TABLE `man` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(150) COLLATE utf8_czech_ci NOT NULL,
	  `age` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

	INSERT INTO `man` (`id`, `name`, `age`) VALUES
	(1,	'Jeroným',	28),
	(2,	'Ráchel',	17),
	(3,	'Benjamin',	13),
	(4,	'Ludmila',	48),
	(5,	'Josef',	52);

	-- 2020-04-16 07:06:49
");
echo "RESET DB MAN: ".$msg."<br>";





echo "<br>---------------------------------------------<br><br>";

echo "::query('SELECT * FROM man')<br>";
$array_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");

foreach($array_man as $man){
	echo $man->name." [".$man->age."]<br>";
}


echo "<br>---------------------------------------------<br><br>";

echo "::query_('SELECT * FROM man')<br>";
$_man = $GLOBALS["mysql"]->query_("
	SELECT *
	FROM man
");
echo $_man->name." [".$_man->age."]<br>";

echo "<br>---------------------------------------------<br><br>";
echo "::insert('man', ['name' => 'Karel', 'age' => '54'])<br>";
$GLOBALS["mysql"]->insert("man", [
	"name"	=> "Karel",
	"age"	=> "54"
]);
echo "::query(\"INSERT INTO man (name, age) VALUES ('Nym', '28')\")<br>";
$data = $GLOBALS["mysql"]->query("
	INSERT INTO man (name, age)
	VALUES ('Nym', '28');
");
echo "<br>---------------------------------------------<br><br>";



echo "<br>---------------------------------------------<br><br>";
echo "::update('man', ['name' => 'Karlíček', 'age' => '69'], 'name = Karel')<br>";
$GLOBALS["mysql"]->update("man", [
	"name"	=> "Karlíček",
	"age"	=> "69"
], "name = 'Karel'");
$array_man = $GLOBALS["mysql"]->query("SELECT * FROM man WHERE name = 'karlíček'");
$man = $array_man[0];
echo $man->name." [".$man->age."]<br>";



echo "<br>---------------------------------------------<br><br>";
echo "::delete('man', 'name = Nym')<br>";
$GLOBALS["mysql"]->delete("man", "name = 'Nym'");
echo "EXIST: ".$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Nym'");


echo "<br>---------------------------------------------<br><br>";
$GLOBALS["mysql"]->insert("man", ["name"=> "Smazat", "age" => "54"]);
echo '::insert("man", ["name"=> "Smazat", "age" => "54"])<br>';
echo "EXIST: ".$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Smazat'")."<br>";
echo "::deleteLast('man')<br>";
$GLOBALS["mysql"]->deleteLast("man");
echo "EXIST: ".$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Smazat'")."<br>";





echo "<br>---------------------------------------------<br><br>";
echo "EXIST: ".$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Nýmeček'")."<br>";
echo "::upsert('man', ['name' => 'Nýmeček', 'age' => '99'], 'name = Nýmeček')<br>";
$GLOBALS["mysql"]->upsert('man', ['name' => 'Nýmeček', 'age' => '99'], 'name = "Nýmeček"');

$array_man = $GLOBALS["mysql"]->query("SELECT * FROM man WHERE name = 'Nýmeček'");
$man = $array_man[0];
echo $man->name." [".$man->age."]<br>";

echo "<br>";

echo "EXIST: ".$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Nýmeček'")."<br>";
echo "::upsert('man', ['age' => '120'], 'name = Nýmeček')<br>";
$GLOBALS["mysql"]->upsert('man', ['age' => '120'], 'name = "Nýmeček"');

$array_man = $GLOBALS["mysql"]->query("SELECT * FROM man WHERE name = 'Nýmeček'");
$man = $array_man[0];
echo $man->name." [".$man->age."]<br>";


echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";
echo "AUTO INCREMENT of MAN: ".$GLOBALS["mysql"]->nextID("man")."<br>";
echo "LAST ID of MAN: ".$GLOBALS["mysql"]->lastID("man")."<br>";
