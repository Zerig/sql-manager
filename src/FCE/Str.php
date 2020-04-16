<?php
namespace FCE;

class Str{
	/* APOSTROPHE REPLACE
	 * take apostrophe in text and transform them into "&apos;"
	 * Str::apostrophe_replacer($text);
	 * Str::apostrophe_replacer($array_text);

	 * @text [string / array of string]			text/s with possible apostrophes
	 * @return [ string / array of string]		transfrom text/s
	 */
	public function apostrophe_replacer($text){
		$from = array("'", '"');
		$to = array("&apos;", "&quot;");

		// WHEN WE GET ARRAY of STRING
		if(is_array($text)){
			$array = array();
			// Copy old array to new one with transform text
			foreach($text as $key => $val){
				 $array[$key] = str_replace($from, $to, $val);
			}
			return $array;

		// WHEN WE GET STRING
		}else{
			return str_replace($from, $to, $text);
		}


	}





	/* APOSTROPHE REMOVE
	 * take apostrophe in text and remove them from text
	 * Str::apostrophe_remove($text);
	 * Str::apostrophe_remove($array_text);

	 * @text [string / array of string]			text/s with possible apostrophes
	 * @return [ string / array of string]		text without aposthropes
	 */
	public function apostrophe_remove($text){
		$from = array("'", '"');
		$to = array("", "");

		// WHEN WE GET ARRAY of STRING
		if(is_array($text)){
			$array = array();
			// Copy old array to new one with transform text
			foreach($text as $key => $val){
				 $array[$key] = str_replace($from, $to, $val);
			}
			return $array;

		// WHEN WE GET STRING
		}else{
			return str_replace($from, $to, $text);
		}


	}





	/* STR::NAME2URL
	 * parse name into url right form
	 * Str::name2url("Název jakéhokoliv obrázku");
	 * => "nazev-jakehokoliv-obrazku"

	 * @name [string]		"Název jakéhokoliv obrázku"
	 * @return [ string ]	"nazev-jakehokoliv-obrazku"
	 */
	 function name2url($name){

		 $prevodni_tabulka = Array(
			  'ä'=>'a',
			  'Ä'=>'A',
			  'á'=>'a',
			  'Á'=>'A',
			  'à'=>'a',
			  'À'=>'A',
			  'ã'=>'a',
			  'Ã'=>'A',
			  'â'=>'a',
			  'Â'=>'A',
			  'č'=>'c',
			  'Č'=>'C',
			  'ć'=>'c',
			  'Ć'=>'C',
			  'ď'=>'d',
			  'Ď'=>'D',
			  'ě'=>'e',
			  'Ě'=>'E',
			  'é'=>'e',
			  'É'=>'E',
			  'ë'=>'e',
			  'Ë'=>'E',
			  'è'=>'e',
			  'È'=>'E',
			  'ê'=>'e',
			  'Ê'=>'E',
			  'í'=>'i',
			  'Í'=>'I',
			  'ï'=>'i',
			  'Ï'=>'I',
			  'ì'=>'i',
			  'Ì'=>'I',
			  'î'=>'i',
			  'Î'=>'I',
			  'ľ'=>'l',
			  'Ľ'=>'L',
			  'ĺ'=>'l',
			  'Ĺ'=>'L',
			  'ń'=>'n',
			  'Ń'=>'N',
			  'ň'=>'n',
			  'Ň'=>'N',
			  'ñ'=>'n',
			  'Ñ'=>'N',
			  'ó'=>'o',
			  'Ó'=>'O',
			  'ö'=>'o',
			  'Ö'=>'O',
			  'ô'=>'o',
			  'Ô'=>'O',
			  'ò'=>'o',
			  'Ò'=>'O',
			  'õ'=>'o',
			  'Õ'=>'O',
			  'ő'=>'o',
			  'Ő'=>'O',
			  'ř'=>'r',
			  'Ř'=>'R',
			  'ŕ'=>'r',
			  'Ŕ'=>'R',
			  'š'=>'s',
			  'Š'=>'S',
			  'ś'=>'s',
			  'Ś'=>'S',
			  'ť'=>'t',
			  'Ť'=>'T',
			  'ú'=>'u',
			  'Ú'=>'U',
			  'ů'=>'u',
			  'Ů'=>'U',
			  'ü'=>'u',
			  'Ü'=>'U',
			  'ù'=>'u',
			  'Ù'=>'U',
			  'ũ'=>'u',
			  'Ũ'=>'U',
			  'û'=>'u',
			  'Û'=>'U',
			  'ý'=>'y',
			  'Ý'=>'Y',
			  'ž'=>'z',
			  'Ž'=>'Z',
			  'ź'=>'z',
			  'Ź'=>'Z'
			);

		$url = strtr($name, $prevodni_tabulka);

 		$from = array(", "," ",",","+");
 		$to = 	array("_","-","-","-");
		$url = str_replace($from, $to, $url);


		// All to LOWERCASE :D
		$url = strtolower($url);


		// ALL unwanted chars tranform into "_" => only list below is allowed chars
		$len = strlen($url);
		for($i=0; $i < $len; $i++){
			$cond  = ($url[$i] == "a") || ($url[$i] == "b") || ($url[$i] == "c") || ($url[$i] == "d") || ($url[$i] == "e");
			$cond |= ($url[$i] == "f") || ($url[$i] == "g") || ($url[$i] == "h") || ($url[$i] == "i") || ($url[$i] == "j");
			$cond |= ($url[$i] == "k") || ($url[$i] == "l") || ($url[$i] == "m") || ($url[$i] == "n") || ($url[$i] == "o");
			$cond |= ($url[$i] == "p") || ($url[$i] == "q") || ($url[$i] == "r") || ($url[$i] == "s") || ($url[$i] == "t");
			$cond |= ($url[$i] == "u") || ($url[$i] == "v") || ($url[$i] == "w") || ($url[$i] == "x") || ($url[$i] == "y");
			$cond |= ($url[$i] == "z");
			$cond |= ($url[$i] == "0") || ($url[$i] == "1") || ($url[$i] == "2") || ($url[$i] == "3") || ($url[$i] == "4");
			$cond |= ($url[$i] == "5") || ($url[$i] == "6") || ($url[$i] == "7") || ($url[$i] == "8") || ($url[$i] == "9");
			$cond |= ($url[$i] == "-") || ($url[$i] == "_") || ($url[$i] == ".");

			if(!$cond){
				$url[$i] = "_";
			}
		}









 		//$url = urlencode($url);

 		return $url;
 	}
}
