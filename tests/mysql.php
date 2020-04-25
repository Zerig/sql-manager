<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing
?>

<div style="display:flex;justify-content:space-around">
<div>
<?php
echo "<h2>SQL MANAGER \ MYSQL</h2>";
echo "<hr>";



$array_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
	WHERE id=256
");
echo '$GLOBALS["mysql"]'."->query('SELECT * FROM man WHERE id=256') => [\n";
foreach($array_man->get_objects() as $man){
	echo "	[$man->id] [$man->name] [$man->age]\n";
}
echo "]\n";


echo "\n";
$array_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");
echo '$array_man = $GLOBALS["mysql"]'."->query('SELECT * FROM man') => [\n";
foreach($array_man->get_objects() as $man){
	echo "	[$man->id] [$man->name] [$man->age]\n";
}
echo "]\n";


echo "<br>---------------------------------------------<br><br>";

$_man = $GLOBALS["mysql"]->query_("
	SELECT *
	FROM man
");
echo '$_man = $GLOBALS["mysql"]'."->query('SELECT * FROM man') => ".((!is_null($_man))? "[$_man->id] [$_man->name] [$_man->age]" : "NULL")."\n";;



$_man = $GLOBALS["mysql"]->query_("
	SELECT *
	FROM man
	WHERE id=256
");
echo '$_man = $GLOBALS["mysql"]'."->query('SELECT * FROM man WHERE id=256') => ".((!is_null($_man))? "[$_man->id] [$_man->name] [$_man->age]" : "NULL")."\n";;



















echo "<br>---------------------------------------------<br><br>";
echo '$success = $GLOBALS["mysql"]->insert("man", ["id" => 1, "name" => "Karel", "age" => "54"])'."\n";
echo '$success => '.$GLOBALS["mysql"]->insert("man", [
	"id"	=> 1,
	"name"	=> "Karel",
	"age"	=> "54"
])."\n";

echo "\n";
echo '$success = $GLOBALS["mysql"]->insert("man", ["name" => "Karel", "age" => "54"])'."\n";
echo '$success => '.$GLOBALS["mysql"]->insert("man", [
	"name"	=> "Karel",
	"age"	=> "54"
])."\n";

/*
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
*/
