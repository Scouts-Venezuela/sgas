<?php

/**
 * Controller para el manejo de GeoNames
 */
class GeonamesController extends RestController 
{
	function __construct() {
		$this->publicView = true;
	}
	public function getAll() {
		$this->data = GeoNames::getGeoNames ();
	}
}