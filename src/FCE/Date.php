<?php
namespace FCE;

class Date{
	/*
	 * DATE CZ MONTH
	 * transform DateTime or month_num to CZECH format of MONTH
	 */
	function cz_month($date, $f){
		$m = ($date instanceof DateTime)? (int) $date->format("m") : (int) $date;

		$month = array(
			1 => array(
				0 => "led",
				1 => "leden",
				2 => "ledna",
				3 => "lednu",
				4 => "leden",
				5 => "ledne",
				6 => "lednu",
				7 => "lednem"
			),
			2 => array(
				0 => "úno",
				1 => "únor",
				2 => "února",
				3 => "únoru",
				4 => "únor",
				5 => "únore",
				6 => "únoru",
				7 => "únorem"
			),
			3 => array(
				0 => "bře",
				1 => "březen",
				2 => "března",
				3 => "březnu",
				4 => "březen",
				5 => "březne",
				6 => "březnu",
				7 => "březnem"
			),
			4 => array(
				0 => "dub",
				1 => "duben",
				2 => "dubna",
				3 => "dubnu",
				4 => "duben",
				5 => "dubne",
				6 => "dubnu",
				7 => "dubnem"
			),
			5 => array(
				0 => "kvě",
				1 => "květen",
				2 => "květne",
				3 => "květnu",
				4 => "květen",
				5 => "květne",
				6 => "květnu",
				7 => "květnem"
			),
			6 => array(
				0 => "čvn",
				1 => "červen",
				2 => "června",
				3 => "červnu",
				4 => "červen",
				5 => "červne",
				6 => "červnu",
				7 => "červnem"
			),
			7 => array(
				0 => "čvc",
				1 => "červenec",
				2 => "července",
				3 => "červenci",
				4 => "červenec",
				5 => "červenci",
				6 => "červenci",
				7 => "červencem"
			),
			8 => array(
				0 => "srp",
				1 => "srpen",
				2 => "srpna",
				3 => "srpnu",
				4 => "srpen",
				5 => "srpne",
				6 => "srpnu",
				7 => "srpnem"
			),
			9 => array(
				1 => "září",
				2 => "září",
				3 => "září",
				4 => "září",
				5 => "září",
				6 => "září",
				7 => "zářím"
			),
			10 => array(
				0 => "říj",
				1 => "říjen",
				2 => "října",
				3 => "říjnu",
				4 => "říjen",
				5 => "říjne",
				6 => "říjnu",
				7 => "říjnem"
			),
			11 => array(
				0 => "lis",
				1 => "listopad",
				2 => "listopadu",
				3 => "listopadu",
				4 => "listopad",
				5 => "listopade",
				6 => "listopadu",
				7 => "listopadem"
			),
			12 => array(
				0 => "pros",
				1 => "prosinec",
				2 => "prosinece",
				3 => "prosineci",
				4 => "prosinec",
				5 => "prosineci",
				6 => "prosineci",
				7 => "prosinecem"
			),
		);


		return (isset($month[$m][$f])? $month[$m][$f] : null);
	}








	/*
	 * DATE CZ WEEKDAY
	 * transform DateTime or weekday_num to CZECH format of WEEK DAY
	 */
	function cz_weekday($date, $f){
		$num = ($date instanceof DateTime)? (int) $date->format("N") : (int) $date;

		if($f == 0){
			switch($num){
				case 1:	return "PO"; break;
				case 2:	return "ÚT"; break;
				case 3:	return "ST"; break;
				case 4:	return "ČT"; break;
				case 5:	return "PÁ"; break;
				case 6:	return "SO"; break;
				case 7:	return "NE"; break;
			}
		}else{
			switch($num){
				case 1:	return "Pondělí"; break;
				case 2:	return "Úterý"; break;
				case 3:	return "Středa"; break;
				case 4:	return "Čtvrtek"; break;
				case 5:	return "Pátek"; break;
				case 6:	return "Sobota"; break;
				case 7:	return "Neděle"; break;
			}
		}

		return null;
	}








	/*
	 * DATE SQL TO obj
	 * Transform SQl string form date into PHP OBJ form

	 * date__sql2php("2019-08-15 18:30:05")->format('d. m. Y');

	 * @sql_date [string]	SQL FORM of DATE
	 * @return [obj Date]	Date in form php object DATE
	 */
	 function date__sql2obj($sql_date){
	 	return new DateTime($sql_date);
	 }


}
