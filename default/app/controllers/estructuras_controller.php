<?php
class EstructurasController extends RestController {
	protected $publicView = true;
	public function getAll() {
		$this->data = Load::model ( "region" )->fill ();
	}
	public function get($model, $id = null, $parentid = null) {
		if (!empty($id)) {
			$this->data = Load::model ( $model )->fillby ($id);
		} elseif (!empty($parentid)) {
			$this->data = Load::model ( $model )->fillbyowner ($parentid);
		} else {
			$this->data = Load::model ( $model )->fill ();
		}
	}
}