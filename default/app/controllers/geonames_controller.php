<?php

/**
 * Controller para el manejo de GeoNames
 */
class GeonamesController extends RestController
{
	protected $publicView = true;

	public function getAll() {
		$this->data = GeoNames::getGeoNames ();
	}
}