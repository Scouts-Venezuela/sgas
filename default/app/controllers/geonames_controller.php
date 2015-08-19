<?php
class GeonamesController extends RestController {
	public function getAll() {
		$this->data = GeoNames::getGeoNames ();
	}
}

?>