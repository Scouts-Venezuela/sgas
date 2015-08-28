<?php
class geoname {
	public function __construct(array $arguments = array()) {
		if (! empty ( $arguments )) {
			foreach ( $arguments as $property => $argument ) {
				$this->{$property} = $argument;
			}
		}
	}
	public function __call($method, $arguments) {
		$arguments = array_merge ( array (
				"stdObject" => $this 
		), $arguments ); // Note: method argument 0 will always referred to the main class ($this).
		if (isset ( $this->{$method} ) && is_callable ( $this->{$method} )) {
			return call_user_func_array ( $this->{$method}, $arguments );
		} else {
			throw new Exception ( "Fatal error: Call to undefined method stdObject::{$method}()" );
		}
	}
}

/*
 * GeoNames Helper - collection of methods for working with GeoNames
 *
 * @author Enner Pérez - ennerperez@gmail.com
 * @version 1.2
 * @date 2015-08-27
 */
class GeoNames {
	
	// Function to convert CSV into associative array
	private static function csvToArray($data) {
		$array = array ();
		
		$lineArray = preg_split ( "/[\r\n]+/", $data );
		for($j = 0; $j < count ( $lineArray ); $j ++) {
			$subarray = preg_split ( "/[\t]/", $lineArray [$j] );
			
			$array [$j] = new geoname ();
			
			$array [$j]->geonameid = $subarray [0];
			$array [$j]->name = $subarray [1];
			$array [$j]->asciiname = $subarray [2];
			$array [$j]->alternatenames = $subarray [3];
			$array [$j]->latitude = $subarray [4];
			$array [$j]->longitude = $subarray [5];
			$array [$j]->feature_class = $subarray [6];
			$array [$j]->feature_code = $subarray [7];
			$array [$j]->country_code = $subarray [8];
			$array [$j]->cc2 = $subarray [9];
			$array [$j]->admin1 = $subarray [10];
			$array [$j]->admin2 = $subarray [11];
			$array [$j]->admin3 = $subarray [12];
			$array [$j]->admin4 = $subarray [13];
			$array [$j]->population = $subarray [14];
			$array [$j]->elevation = $subarray [15];
			$array [$j]->dem = $subarray [16];
			$array [$j]->timezone = $subarray [17];
			$array [$j]->modification = $subarray [18];
		}
		
		return $array;
	}
	private static $ID_ARRAY_FILTER = null;
	public static function SearchFor($criteria, $id = NULL) {
		$file = COUNTRY_CODE . '.txt';
		$array = null;
		$result = null;
		
		GeoNames::$ID_ARRAY_FILTER = $id;
		
		if (! empty ( $criteria )) {
			
			$contents = file_get_contents ( __DIR__ . DIRECTORY_SEPARATOR . 'GeoNames' . DIRECTORY_SEPARATOR . $file );
			
			$pattern = preg_quote ( $criteria, '/' );
			$pattern = "/^.*$pattern.*\$/m";
			
			if (preg_match_all ( $pattern, $contents, $matches )) {
				$data = implode ( "\n", $matches [0] );
				$array = GeoNames::csvToArray ( $data );
			}
		}
		
		if (! is_null ( $id )) {
			switch ($criteria) {
				case "ADM2" :
					$result = array_filter ( $array, function ($k) {
						return ($k->admin1 == GeoNames::$ID_ARRAY_FILTER);
					} );
					break;
				case "ADM3" :
					$result = array_filter ( $array, function ($k) {
						return ($k->admin2 == GeoNames::$ID_ARRAY_FILTER);
					} );
					break;
				default :
					$result = array_filter ( $array, function ($k) {
						return ($k->geonameid == GeoNames::$ID_ARRAY_FILTER);
					} );
					break;
			}
		} else {
			$result = $array;
		}
		
		if (sizeof ( $result ) > 0) {
			return $result;
		}
	}
}
