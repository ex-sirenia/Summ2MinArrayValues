<?php

ini_set("display_errors", true);
error_reporting(E_ALL);

function Summ2MinArrayValues ($input_Array, $limit_summArray = 2) {
	
	$summArray = [];
	$limit = 10000; // Максимальное кол-во элементов в массиве
	
	if (!count($input_Array) || !is_array($input_Array) || $input_Array === null) {
		throw new Exception("Where array?");
	}
	
	if (count($input_Array) > $limit) {
		throw new Exception("Limit of array");
	}

	foreach ($input_Array as &$e) {
		if (!is_numeric($e)) {
			unset($e);
		}
	}

	if ($limit_summArray >= count($input_Array)) {
		return array_sum($input_Array);
	}
	for ($k = 0; $k < $limit_summArray; $k++) {
		$first_key = array_keys($input_Array)[0];
		$min = $input_Array[$first_key];
		$position = 0;
		foreach ($input_Array as $p => $elem) {
			if ($elem < $min) {
				$min = $elem;
				$position = $p;
			}
		}
		
		$summArray[] = $min;
		unset($input_Array[$position]);
	}
	return array_sum($summArray);
}

// First Test
$array = [4, 0, 3, 19, 492, -10, 1];

echo Summ2MinArrayValues($array);

// Second test
echo Summ2MinArrayValues(null); // Exception

// Third test
echo Summ2MinArrayValues(range(1, 100000));
?>