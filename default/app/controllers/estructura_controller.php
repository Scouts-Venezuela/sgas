<?php
class EstructuraController extends RestController {
	protected $publicView = true;
	
	public function getAll() {
		$this->data = Load::model('region')->fill();
	}
}