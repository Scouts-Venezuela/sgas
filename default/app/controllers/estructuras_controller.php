<?php
class EstructurasController extends RestController {
	protected $publicView = true;
	public function getAll() {
		$this->data = Load::model ( "region" )->fill ();
	}
	public function get($model, $id = null, $parentid = null) {
		if ($id == 'parent') {
			$this->data = Load::model ( $model )->fillbyowner ( $parentid );
		} elseif (! empty ( $id )) {
			$this->data = Load::model ( $model )->fillby ( $id );
		} else {
			$this->data = Load::model ( $model )->fill ();
		}
	}
}