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



$mr_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM mana
	WHERE id=256
");
echo '$mr_man = $GLOBALS["mysql"]'."->query('SELECT * FROM mana WHERE id=256')\n";

echo "\n";



\Report\Data::set(["Člověk s","id=1"]);
$mysql_rep = \Report\Mysql::start();
echo '$success = $GLOBALS["mysql"]->insert("man", ["id" => 1, "name" => "Karel", "age" => "54"])'."\n";
echo '$success => '.$GLOBALS["mysql"]->insert("man", [
	"id"	=> 1,
	"name"	=> "Karel",
	"age"	=> "54"
])."\n";
echo \Report\Mysql::get(-1)->msg;



echo "<br>---------------------------------------------<br><br>";


\Report\Data::set(["Člověk","id=2"]);
$mr_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
	WHERE id=2
");
echo '$mr_man = $GLOBALS["mysql"]'."->query('SELECT * FROM mana WHERE id=2')\n";

echo "\n";

\Report\Data::set(["Člověk","Karel"]);
echo '$success = $GLOBALS["mysql"]->insert("man", ["name" => "Karel", "age" => "54"])'."\n";
echo '$success => '.$GLOBALS["mysql"]->insert("man", [
	"name"	=> "Karel",
	"age"	=> "54"
])."\n";

echo "\n";

$mysql_rep->end();
foreach($mysql_rep->data as $rep){
	echo "[".$rep->state."] ".$rep->msg."\n";
}
echo "<br>---------------------------------------------<br><br>";
\Report\Data::set(["Člověk s","id=9"]);
echo '$success = $GLOBALS["mysql"]->delete("man", "id=\'9\'")'."\n";
echo '$success => '.$GLOBALS["mysql"]->delete("man", "id='9'")."\n";

echo "<br>---------------------------------------------<br><br>";

\Report\Data::set(["Člověk s","id=9"]);
echo '$success = $GLOBALS["mysql"]->delete("mana", "id=\'9\'")'."\n";
echo '$success => '.$GLOBALS["mysql"]->delete("mana", "id='9'")."\n";

echo "<br>---------------------------------------------<br><br>";





/*
echo "\n";
$mr_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");
echo '$mr_man = $GLOBALS["mysql"]'."->query('SELECT * FROM man')"."\n";
echo '$mr_man->get_objects() => ['."\n";
foreach($mr_man->get_objects() as $man){
	echo "	[$man->id] [$man->name] [$man->age]\n";
}
echo "]\n";
*/













/*

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

echo "\n";
echo '$success = $GLOBALS["mysql"]->query'."(\"INSERT INTO man (name, age) VALUES ('Nym', '28')\")"."\n";
echo '$success => '.$GLOBALS["mysql"]->query("
	INSERT INTO man (name, age)
	VALUES ('Nym', '28')
")."\n";

echo "<br>---------------------------------------------<br><br>";


echo '$success = $GLOBALS["mysql"]'."->update('man', ['name' => 'Karlíček', 'age' => '69'], 'name = Karel')"."\n";
echo '$success => '.$GLOBALS["mysql"]->update("man", [
	"name"	=> "Karlíček",
	"age"	=> "69"
], "name = 'Karel'")."\n";
$_man = $GLOBALS["mysql"]->query_("SELECT * FROM man WHERE name = 'Karlíček'");
echo '$GLOBALS["mysql"]->query_("SELECT * FROM man WHERE name = \'Karlíček\'") => '."[$_man->id] [$_man->name] [$_man->age]\n";


echo "<br>---------------------------------------------<br><br>";


echo '$success = $GLOBALS["mysql"]'."->delete('man', 'name = Nym')        => ".$GLOBALS["mysql"]->delete("man", "name = 'Nym'")."\n";
echo '$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = \'Nym\'") => '.$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Nym'");



echo "<br>---------------------------------------------<br><br>";


;
echo '$GLOBALS["mysql"]->insert("man", ["name"=> "Smazat", "age" => "54"]) => '.$GLOBALS["mysql"]->insert("man", ["name"=> "Smazat", "age" => "54"])."\n";
echo '$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = \'Smazat\'")  => '.$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Smazat'")."\n";
echo "\n";
echo '$GLOBALS["mysql"]->'."deleteLast('man') => ".$GLOBALS["mysql"]->deleteLast("man")."\n";
echo '$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = \'Smazat\'") => '.$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Smazat'")."\n";





echo "<br>---------------------------------------------<br><br>";


echo '$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = \'Nýmeček\'") => '.$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Nýmeček'")."\n";
echo '$GLOBALS["mysql"]->upsert'."('man', ['name' => 'Nýmeček', 'age' => '99'], 'name = Nýmeček') => ".$GLOBALS["mysql"]->upsert('man', ['name' => 'Nýmeček', 'age' => '99'], 'name = "Nýmeček"')."\n";
$_man = $GLOBALS["mysql"]->query_("SELECT * FROM man WHERE name = 'Nýmeček'");
echo '$GLOBALS["mysql"]->query_("SELECT * FROM man WHERE name = \'Nýmeček\'") => '."[$_man->id] [$_man->name] [$_man->age]\n";

echo "\n";


echo '$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = \'Nýmeček\'") => '.$GLOBALS["mysql"]->exist("SELECT * FROM man WHERE name = 'Nýmeček'")."\n";
echo '$GLOBALS["mysql"]->upsert'."('man', ['name' => 'Nýmeček', 'age' => '150'], 'name = Nýmeček') => ".$GLOBALS["mysql"]->upsert('man', ['name' => 'Nýmeček', 'age' => '150'], 'name = "Nýmeček"')."\n";
$_man = $GLOBALS["mysql"]->query_("SELECT * FROM man WHERE name = 'Nýmeček'");
echo '$GLOBALS["mysql"]->query_("SELECT * FROM man WHERE name = \'Nýmeček\'") => '."[$_man->id] [$_man->name] [$_man->age]\n";


echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";

echo '$GLOBALS["mysql"]->nextID("man") => '.$GLOBALS["mysql"]->nextID("man")."<br>";
echo '$GLOBALS["mysql"]->lastID("man") => '.$GLOBALS["mysql"]->lastID("man")."<br>";
*/
?>
</div>












<div>
<?php
echo "<h2>MYSQL LOG</h2>";
echo "<hr>";
foreach(\Console\Log::getMysql() as $log_data){
	//echo $log_data->file.' on line '.$log_data->line."\n";
	echo $log_data->sql."\n";
	echo "<br>---------------------------------------<br><br>";
}


?>
<?php
echo "<h2>REPORT LOG</h2>";
echo "<hr>";
echo '<table style="width:100%; text-align:left;">';
//foreach(\Report\Mysql::get() as $report_data){
foreach(\Report\Mysql::get() as $report_data){
	echo '<tr>';
		echo '<td>['.$report_data->state.']</td>';
		echo '<td>['.$report_data->errno.']</td>';
		echo '<td>['.$report_data->rows.']</td>';
		echo '<td>'.$report_data->msg.'</td>';

		//echo "[".$report_data->state."]	".$report_data->msg."\n";
	echo '</tr>';
}
echo '</table>';


?>
</div>









<div>
<?php
echo "<h2>SELECT * FROM MAN</h2>";
echo "<hr>";
$mr_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");


echo '<table style="width:100%; text-align:left;">';
echo '<tr>';
	foreach($mr_man->key as $key){
		echo '<th>'.$key.'</th>';
	}
echo '</tr>';
foreach($mr_man->get_objects() as $man){
	echo '<tr>';
		foreach($mr_man->key as $key){
			echo '<td>'.$man->{$key}.'</td>';
		}
	echo '</tr>';
}
echo '</table>';
?>
</div>










<div>
<?php


?>
</div>








</div>
