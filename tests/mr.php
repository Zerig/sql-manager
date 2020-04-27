<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing
?>

<div style="display:flex;justify-content:space-around">
<div>
<?php
echo "<h2>SQL MANAGER \ MR</h2>";
echo "<hr>";



$mr_man_empty = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
	WHERE id=256
");
echo '$mr_man_empty = $GLOBALS["mysql"]'."->query('SELECT * FROM man WHERE id=256')\n";


$mr_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");
echo '$mr_man = $GLOBALS["mysql"]'."->query('SELECT * FROM man')"."\n";


echo "<br>---------------------------------------";
echo "<br>---------------------------------------<br><br>";

echo '$mr_man_empty->get_objects() => ['."\n";
foreach($mr_man_empty->get_objects() as $man){
	echo "	[$man->id] [$man->name] [$man->age]\n";
}
echo "]\n";

echo '$mr_man->get_objects() => ['."\n";
foreach($mr_man->get_objects() as $man){
	echo "	[$man->id] [$man->name] [$man->age]\n";
}
echo "]\n";

echo "<br>---------------------------------------<br><br>";

echo '$mr_man_empty->get_arrays() => ['."\n";
foreach($mr_man_empty->get_arrays() as $man){
	echo "	[".$man['id']."] [".$man['name']."] [".$man['age']."]\n";
}
echo "]\n";

echo '$mr_man->get_arrays() => ['."\n";
foreach($mr_man->get_arrays() as $man){
	echo "	[".$man['id']."] [".$man['name']."] [".$man['age']."]"."\n";
}
echo "]\n";




echo "<br>---------------------------------------";
echo "<br>---------------------------------------<br><br>";

echo 'is_null( $mr_man_empty->get_object() ) => '.is_null( $mr_man_empty->get_object())." \n";
echo "\n";
echo 'is_null( $mr_man->get_object() )       => '.is_null( $mr_man->get_object())." \n";
echo '$mr_man->get_object()->name   => '.$mr_man->get_object()->name."\n";
echo '$mr_man->get_object(0)->name  => '.$mr_man->get_object(0)->name."\n";
echo '$mr_man->get_object(1)->name  => '.$mr_man->get_object(1)->name."\n";
echo '$mr_man->get_object(-1)->name => '.$mr_man->get_object(-1)->name."\n";
echo '$mr_man->get_object(-2)->name => '.$mr_man->get_object(-2)->name."\n";

echo "<br>---------------------------------------<br><br>";

echo 'is_null( $mr_man_empty->get_array() ) => '.is_null( $mr_man_empty->get_array())." \n";
echo "\n";
echo 'is_null( $mr_man->get_array() )       => '.is_null( $mr_man->get_array())." \n";
echo '$mr_man->get_array()["name"]   => '.$mr_man->get_array()["name"]."\n";
echo '$mr_man->get_array(0)["name"]  => '.$mr_man->get_array(0)["name"]."\n";
echo '$mr_man->get_array(1)["name"]  => '.$mr_man->get_array(1)["name"]."\n";
echo '$mr_man->get_array(-1)["name"] => '.$mr_man->get_array(-1)["name"]."\n";
echo '$mr_man->get_array(-2)["name"] => '.$mr_man->get_array(-2)["name"]."\n";

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
