<?php

/**
 * Controller para el manejo de GeoNames
 */
class GeonamesController extends RestController {
	protected $publicView = true;
	public function getAll() {
		$this->data = GeoNames::GetGeoNames ();
	}
	public function get($id) {
		$this->data = GeoNames::SearchFor ( $id );
	}
}